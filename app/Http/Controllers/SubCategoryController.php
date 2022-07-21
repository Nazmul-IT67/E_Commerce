<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    function SubCategoryAdd(){
        return view('Backend.Subcategory.subcategory-add',[
            'categorys'=>Category::orderBy('category_name', 'asc')->get(),
        ]);
    }

    function SubCategoryPost(Request $request){
        $request->validate([
            'subcategory_name'=>['required', 'min:5', 'unique:sub_categories'],
            'category_id'=>['required'],
        ],[
            'category_id.required'=>'Please Select Your Category',
        ]);
        $subcategory=new SubCategory();
        $subcategory->subcategory_name=$request->subcategory_name;
        $subcategory->category_id=$request->category_id;
        $subcategory->slug=Str::slug($request->subcategory_name);
        $subcategory->save();
        return redirect('subcategory-list')->with('success', 'SubCategory Add Successfull');
    }


    function SubCategoryList(){
        return view('Backend.Subcategory.subcategory-list',[
            'subcategory'=>SubCategory::orderBy('subcategory_name','asc')->paginate(5),
            'sub_count'=>$sub_count=SubCategory::count(),
        ]);
    }

    function SubCategoryEdit(){
        return view('Backend.Subcategory.subcategory-edit');
    }
}
