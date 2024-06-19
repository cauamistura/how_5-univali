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
    protected $produto, $current_user, $fileName;

    # Antes de toda a função é difinido quem é o current_user e antes todas as funções menos INDEX/CREATE é feito um find em Products 
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->current_user = Auth::user();
            if (!in_array($request->route()->getName(), ['product.index', 'product.create'])) {
                $this->produto = Product::find(request()->route('id'));
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        
        $produtos = Product::with('seller')->byActive(true)->get();
        return response()->json([
            "Products" => $produtos
        ]);
    }

    public function show()
    {
        try {
            return response()->json(["Products" => $this->produto]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getProductsByUser()
    {
        try {
            $produtos = Product::byUser($this->current_user->id)->get();
            return response()->json(["Products" => $produtos]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function create(Request $request)
    {
        // Valida os dados do formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',            
            'active' => 'required|boolean'
        ]);

        $this->updateFile($request->hasFile('image'));
  
        try {
            // Inicia uma transação
            DB::beginTransaction();
            
            // Insere o novo produto na tabela 'products' (não 'Products')
            DB::table('products')->insert([
                'name' => $request->name,
                'price' => $request->price,
                'src' => $this->fileName,
                'active' => $request->active,
                'seller' => $this->current_user->id,
                'created_at' => now(),
            ]);

            // Confirma a transação
            DB::commit();

            return response()->json(['message' => 'Produto foi cadastrado com sucesso'], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request)
    {
        // Valida os dados do formulário
        $request->validate([
            'name' => 'string|max:255',
            'price' => 'numeric',
            'active' => 'boolean',
        ]);

        $this->updateFile($request->hasFile('image'));

        try {
            // Verifica se o usuário autenticado corresponde ao usuário que está sendo atualizado
            if ($this->current_user->id != $this->produto->seller) {
                return response()->json(['error' => 'Você não tem permissão para atualizar este produto'], Response::HTTP_FORBIDDEN);
            }

            $this->produto->name = $request->name;
            $this->produto->price = $request->price;
            $this->produto->src = $this->fileName;
            $this->produto->active = $request->active;
            $this->produto->seller = $this->current_user->id;
            $this->produto->updated_at = now();
            $this->produto->save();


            return response()->json(['message' => 'Produto atualizado com sucesso'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete()
    {
        try {
            // Verifica se o usuário autenticado corresponde ao usuário que está sendo atualizado
            if ($this->current_user->id != $this->produto->seller) {
                return response()->json(['error' => 'Você não tem permissão para atualizar este produto'], Response::HTTP_FORBIDDEN);
            }

            $this->produto->delete();

            return response()->json(['message' => 'Produto deletado com sucesso'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function updateFile($image)
    {
        if ($image) {
            $file = $image;
            $this->fileName = md5(time()) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/images'), $this->fileName);
        } else {
            $this->fileName = 'default-image.png';
        }
    }
}
