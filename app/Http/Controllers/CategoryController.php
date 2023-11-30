<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;

class CategoryController extends Controller
{
    //show all categories
    public function index(){
        $categories = Category::latest()->paginate(10);
        $trashcategories = Category::onlyTrashed()->latest()->paginate(10);
        return view('category', compact('categories','trashcategories'));
    }

    //add category
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

    //update category
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
    
    //soft delete
    public function remove($id){
        $categoryData = Category::find($id);
        $categoryData->delete();
        return Redirect()->route('AllCategory')->with(['success'=>'Category Removed Successfully!']);
    }

    //permanently delete
    public function delete($id){
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->route('AllCategory')->with(['success'=>'Category Permanently Deleted Successfully!']);
    }

    //restore
    public function restore($id){
        $restore = Category::withTrashed()->find($id)->restore();
        return Redirect()->route('AllCategory')->with(['success'=>'Category Restored Successfully!']);
    }
}
