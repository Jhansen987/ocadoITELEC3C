<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    //
    public function index(){
        $categories = Category::all();
        return view('category', compact('categories'));
    }

    public function store(Request $request): RedirectResponse{
        
        $category = new Category;
        $category->category_name = $request->categoryName;
        $category->user_id = $request->userID;

        $category->save();
        return redirect('category');

    }
}
