<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;

class CategoryController extends Controller
{
    function AddCategory(){
        return view('Backend.Category.category-add');
    }

    function CategoryPost(Request $request){
        $request->validate([
            'category_name'=>['required', 'min:5', 'unique:categories'],
        ]);
        $category=new Category();
        $category->category_name=$request->category_name;
        $category->save();
        return redirect('category-list')->with('success', 'Category Add Successfull');
    }

    // function CategoryList(){
    //     $category=Category::paginate(5);
    //     $count=Category::count();
    //     return view('Backend.Category.category-list',compact('category','count'));
    // }

    function CategoryList(){
        $category=Category::paginate(5);
        $count=Category::count();
        return view('Backend.Category.category-list',[
            'category'=>Category::paginate(5),
            'count'=>$count=Category::count(),
        ]);
    }

    function CategoryEdit($id){
        return view('Backend.Category.category-edit',[
            'category'=>Category::findOrFail($id),
        ]);
    }

    function CategoryUpdate(Request $request){
        $request->validate([
            'category_name'=>['required', 'min:5', 'unique:categories'],
        ]);
        Category::findOrFail($request->category_id)->update([
            'category_name'=>$request->category_name,
            'updated_at'=>Carbon::now(),
        ]);
        return redirect('category-list')->with('success', 'Category Updated Successfull');
    }

    function CategoryTrash($id){
        Category::findOrfail($id)->delete();
        return redirect('category-list')->with('success', 'Category Delete Successfull');
    }

    function TrashList(){
        return view('Backend.Category.tras-list',[
            'trash'=>Category::onlyTrashed()->paginate(10),
            't_count'=>$t_count=Category::onlyTrashed()->count(),
        ]);
    }

    function CategoryReset($id){
        Category::onlyTrashed()->findOrFail($id)->restore();
        return redirect('trash-list')->with('success', 'Category Restore Successfull');
    }

    function CategorySofd($id){
        Category::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect('trash-list')->with('success', 'Category Permanent Delete Successfull');
    }
}
