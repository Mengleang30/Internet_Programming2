<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    // Get /api/categories
    public function getCategories(){
      return response()->json(Category::all());
        // return ['message' => "Getting list of categories"];
    }

    // Post /api/categories
    public function createCategory(Request $request){

      $request->validate([
          'name' => 'required|string|unique:categories',
      ]);

      $category = Category::create([
        'name' => $request-> name
      ]);

      return response()->json([
        'message'=>'Added successfully ! ',
        'category'=> $category
      ], 201);
        // return ['message' => "Creating new 1 of category"];

    }

      // Get /api/categories/{categoryId}
      public function getCategory($categoryId){
        $category = Category::findOrFail($categoryId);
        if (!$category){
          return response()->json([
            'message'=> 'Category not found !'
          ]);
        }
        return response()->json($category);


        // return ['message' => "Getting 1 category by Id"];

    }

      // Patch /api/categories/{categoryId}
      public function updateCategory(Request $request, $categoryId){

        $category = Category::findOrFail($categoryId);

        $request->validate([
          'name' => 'required|string|unique:categories,name,' . $categoryId
      ]);

        $category->update([ 'name'=> $request->name ]);

        return response()->json([
          'message'=>'updated successfully',
          'category'=>$category
        ]);
    }

        // return ['message' => "Updating 1 of category by Id"];


      // Delete /api/categories/{categoryId}
      public function deleteCategory($categoryId){

        $category = Category::findOrFail($categoryId);
        $category->delete();

        return response()->json(['message'=>'Deleted successfully !']);

        // return ['message' => "Deleting 1 of category by Id"];

    }


}
