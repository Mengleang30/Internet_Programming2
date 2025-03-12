<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //List all products /api/products
    public function getAll(){
        $products = Product::all();
        return response()->json($products);

    }

    // Create new products /api/products

    public function createProducts(Request $request){
       $request->validate([
            'name'=>'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'pricing' => 'required|numeric',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
        ]);

        $products = Product::create([
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'pricing'=>$request->pricing,
            'description'=>$request->description,
            'images'=>$request->images,
        ]);

        return response()->json([
            'message'=>'Product added successfully ! ',
            'products'=> $products
          ],201);

    }

    // get product by id  /api/product/{productId}

    public function findProductByID($productId){
        $product = Product::findOrFail($productId);

        if(!$product){
            return response()->json([
                'message' => 'Product not found ',
            ]);
        }
        else {
            return response()->json($product);
        }
    }

    public function deleteProducts($productId){

        $product = Product::findOrFail($productId);
        $product->delete();

        return response()->json([
            'message' => "Delete successful ! ",
            "id" => $productId
        ]);

    }

    public function updateProducts(Request $request, $productId){

        $products = Product::findOrFail($productId);

        $request->validate([
            'name'=>'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'pricing' => 'required|numeric',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
        ]);

        $products->update([
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'pricing'=>$request->pricing,
            'description'=>$request->description,
            'images'=>$request->images,
        ]);

        return response()->json([
            'message'=>'updated product successfully',
            'products'=> $products
          ]);


    }
}
