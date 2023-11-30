<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;

class CategoryController extends Controller
{
    //
    public function index(){
        $categories = Category::all();
        return view('category', compact('categories'));
    }

    public function store(Request $request){
        
        $validated = $request->validate([
            'categoryImage' => 'required|mimes:jpg,jpeg,png',
        ],[
            'categoryImage.mimes' => 'The only accepted image file extensions are: jpg, jpeg, or png'
        ]);

        $category_image = $request->file('categoryImage');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($category_image->getClientOriginalExtension());
        $image_name = $name_gen.'.'.$img_ext;
        $up_loc = 'image/category/';
        $last_img = $up_loc.$image_name;
        $category_image->move($up_loc,$image_name);

        Category::insert([
            'category_name' => $request->categoryName,
            'category_image_path' => $last_img,
            'created_at' => Carbon::now()

        ]);

        return Redirect()->route('AllCategory')->with('success','Category Inserted Successfully');
    }

    public function edit($id){
        $categories = Category::find($id);
        return view('editCategory',compact('categories'));
    }


    public function update(Request $request,$id){
        
        $validated = $request->validate([
            'categoryImage' => 'required|mimes:jpg,jpeg,png'
        ],[
            'categoryImage.mimes' => 'The only accepted image file extensions are: jpg, jpeg, or png'
        ]);

        $category_image = $request->file('categoryImage');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($category_image->getClientOriginalExtension());
        $image_name = $name_gen.'.'.$img_ext;
        $up_loc = 'image/category/';
        $last_img = $up_loc.$image_name;
        $category_image->move($up_loc,$image_name);

        Category::find($id)->update([
            'category_name' => $request->categoryName,
            'category_image_path' => $last_img,
            'updated_at' => Carbon::now()
        ]);

        return Redirect()->route('AllCategory')->with('success','Category Updated Successfully');
    }

    public function delete(Request $request, $id){
        $categoryData = Category::find($id);
        $categoryData->delete();
        return Redirect()->route('AllCategory')->with(['success'=>'Category Removed Successfully!']);
    }
}
