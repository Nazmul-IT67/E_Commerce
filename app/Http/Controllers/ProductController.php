<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    function ProductAdd(){
        $last_value=collect(request()->segments())->last();
        $last=Str::of($last_value)->replace('-','');
        return view('Backend.Product.product-add',[
            'last'=>$last,
            'categorys'=>Category::orderBy('category_name','asc')->get(),
        ]);
    }

    function ProductPost(Request $request){
        $request->validate([
            'title'=>['required', 'unique:products'],
            'slug'=>['required'],
            'summery'=>['required'],
            'description'=>['required'],
            'price'=>['required'],
            'thumbnail'=>['required','image'],
        ]);

        $product=new Product;
        if($request->hasFile('thumbnail')){
            $image=$request->file('thumbnail');
            $ext=$request->title.'.'.$image->getClientOriginalExtension();
            Image::make($image)->save(public_path('Images/'.$ext));
            $product->thumbnail=$ext;
        }
        $product->title=$request->title;
        $product->slug=$request->slug;
        $product->category_id=$request->category_id;
        $product->subcategory_id=$request->subcategory_id;
        $product->summery=$request->summery;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->save();

        // if($request->hasFile('thumbnail')){
        //     $image=$request->file('thumbnail');
        //     $ext=$request->title.'.'.$image->getClientOriginalExtension();
        //     Image::make($image)->save(public_path('Images/'.$ext));
        //     $product->thumbnail=$ext;
        //     // $image=$request->file('thumbnail');
        //     // $ext=$request->title.'.'.$image->getClientOriginalExtension();
        //     // $new=Product::findOrFail($product->id);
        //     // $path=public_path('Images/'.$new->created_at->format('Y/m/').$new->id.'/');
        //     // File::makeDirectory($path, $mode=0777, true, true);
        //     // Image::make($image)->save($path.$ext);
        //     // $new->thumbnail=$ext;
        //     // $new->save();
        // }

        return redirect('product-list')->with('success', 'SubCategory Add Successfull');
    }

    function ProductList(){
        $last_value=collect(request()->segments())->last();
        $last=Str::of($last_value)->replace('-','');
        return view('Backend.Product.product-list',[
            'last'=>$last,
            'product'=>Product::orderBy('title','asc')->paginate(),
            'p_count'=>$p_count=Product::count(),
        ]);
    }

    // Product Subcategoey
    function SubCat($id){
        $sub_cat=SubCategory::where('category_id', $id)->get();
        return response()->json($sub_cat);
    }

    function ProductEdit(){
        return view('Backend.Product.product-edit',[
            'categorys'=>Category::orderBy('category_name','asc')->get(),
        ]);
    }
}
