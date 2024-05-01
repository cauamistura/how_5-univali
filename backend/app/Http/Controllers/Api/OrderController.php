<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        // Valida os dados do formulário
        $request->validate([
            'product_id' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);

        $user = Auth::user();
        $product = Product::find($request->product_id);

        try {
            // Inicia uma transação
            DB::beginTransaction();

            DB::table('orders')->insert([
                'seller_id' => $product->vendedor->id,
                'buyer_id' => $user->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'date' => now(),
                'created_at' => now(),
            ]);

            // Confirma a transação
            DB::commit();

            return response()->json(['message' => 'Pedido cadastrado com sucesso'], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function ordersByUser(Request $request, $user_id)
    {
        try {
            $result = Order::select('orders.date as coluna1', 'products.name as coluna2', DB::raw('SUM(orders.quantity) as coluna3'), DB::raw('SUM(orders.quantity * products.preco) as coluna4'))
                ->join('products', 'orders.product_id', '=', 'products.id')
                ->whereBetween('orders.date', [$request->start_date, $request->end_date])
                ->where('orders.buyer_id', $user_id)
                ->groupBy('products.name', 'orders.date')
                ->get();

            return response()->json(['dados' => $result], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function sallerByUser(Request $request,  $user_id)
    {
        try {
            $result = Order::select('users.name as coluna1', 'users.email as coluna2', 'users.description as coluna3', DB::raw('SUM(products.preco * orders.quantity) as coluna4'))
                ->join('users', 'orders.buyer_id', '=', 'users.id')
                ->join('products', 'orders.product_id', '=', 'products.id')
                ->whereBetween('orders.date', [$request->start_date, $request->end_date])
                ->where('orders.seller_id', $user_id)
                ->groupBy('users.name', 'users.email', 'users.description')
                ->get();

            return response()->json(['dados' => $result], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function balanco(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'option' => 'required|int'
        ]);

        $request->start_date = $request->start_date . ' 00:00:00';
        $request->end_date = $request->end_date . ' 23:59:59';

        $user = Auth::user();

        switch ($request->option) {
            case 1:
                return $this->ordersByUser($request, $user->id);
            case 0:
                return $this->sallerByUser($request, $user->id);
            default:
                return response()->json(['error' => 'Opção inválida'], Response::HTTP_BAD_REQUEST);
        }
    }
}
