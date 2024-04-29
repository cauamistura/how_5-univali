<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index()
    {
        $produtos = Product::all();
        return response()->json([
            "Produto" => $produtos
        ]);
    }

    public function show($id)
    {
        try {
            $produto = Product::findOrFail($id);
            return response()->json(["Produto" => $produto]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getProductsByUser()
    {
        try {
            $user = Auth::user();
            $produtos = Product::where('vendedor_id', $user->id)->get();
            return response()->json(["Produto" => $produtos]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function create(Request $request)
    {
        // Valida os dados do formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'preco' => 'required|numeric', // Use 'numeric' em vez de 'float'
            'src' => 'required|string',
            'ativo' => 'required|boolean',            
        ]);

        try {
            $user = Auth::user();

            // Inicia uma transação
            DB::beginTransaction();

            // Insere o novo produto na tabela 'products' (não 'Products')
            DB::table('products')->insert([
                'name' => $request->name,
                'preco' => $request->preco,
                'src' => $request->src,
                'ativo' => $request->ativo,
                'vendedor_id' => $user->id,
                'created_at' => now(),
            ]);

            // Confirma a transação
            DB::commit();

            return response()->json(['message' => 'Produto foi cadastrado com sucesso'], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        // Valida os dados do formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'preco' => 'required|numeric',
            'src' => 'required|string|',
            'ativo' => 'required|boolean|',
            'vendedor_id' => 'required|integer|vendedor_id|unique:products|'
        ]);

        try {
            $product = Product::findOrFail($id);
            // Obtém o usuário autenticado
            $authenticatedUser = Auth::user();

            // Verifica se o usuário autenticado corresponde ao usuário que está sendo atualizado
            if ($authenticatedUser->id != $product->vendedor_id) {
                return response()->json(['error' => 'Você não tem permissão para atualizar este produto'], Response::HTTP_FORBIDDEN);
            }

            $product->name = $request->name;
            $product->preco = $request->preco;
            $product->src = $request->src;
            $product->ativo = $request->ativo;
            $product->vendedor_id = $authenticatedUser->id;
            $product->updated_a = now();
            $product->save();

            return response()->json(['message' => 'Produto atualizado com sucesso'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($id)
    {
        try {

            $produto = Product::findOrFail($id);

            $authenticatedUser = Auth::user();

            // Verifica se o usuário autenticado corresponde ao usuário que está sendo atualizado
            if ($authenticatedUser->id != $produto->vendedor_id) {
                return response()->json(['error' => 'Você não tem permissão para atualizar este produto'], Response::HTTP_FORBIDDEN);
            }

            $produto->delete();

            return response()->json(['message' => 'Produto deletado com sucesso'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
