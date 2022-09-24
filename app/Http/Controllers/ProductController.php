<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductGallery;
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

        // Inserting the image in this way should keep the database nullable
        if($request->hasFile('thumbnail')){
            $image=$request->file('thumbnail');
            $ext=$request->title.'.'.$image->getClientOriginalExtension();
            $new=Product::findOrFail($product->id);
            $path=public_path('Images/'.$new->created_at->format('Y/m/').$new->id.'/');
            File::makeDirectory($path, $mode=0777, true, true);
            Image::make($image)->save($path.$ext);
            $new->thumbnail=$ext;
            $new->save();
        }
        // Miltiple Images
        if($request->hasFile('image')){
            $images=$request->file('image');
            foreach($images as $image){
                $img_ext=$request->title.Str::random(3).'.'.$image->getClientOriginalExtension();
                $path=public_path('Images/Gallerys/'.$product->created_at->format('Y/m/').$product->id.'/');
                File::makeDirectory($path, $mode=0777, true, true);
                Image::make($image)->save($path.$img_ext);
                $img=new ProductGallery;
                $img->product_gallery=$img_ext;
                $img->product_id=$product->id;
                $img->save();
            }
        }
        return redirect('product-list')->with('success', 'Product Add Successfull');
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

    function ProductTrash(){
        $last_value=collect(request()->segments())->last();
        $last=Str::of($last_value)->replace('-','');
        return view('Backend.Product.product-trash',[
            'trashProduct'=>Product::onlyTrashed()->paginate(10),
            'p_count'=>$t_count=Product::onlyTrashed()->count(),
            'last'=>$last,
        ]);
    }

    // Product Subcategoey
    function SubCat($id){
        $sub_cat=SubCategory::where('category_id', $id)->get();
        return response()->json($sub_cat);
    }

    function ProductEdit($id){
        $product=Product::findOrfail($id);
        return view('Backend.Product.product-edit',[
            'categorys'=>Category::orderBy('category_name','asc')->get(),
            'subcategorys'=>SubCategory::where('category_id', $product->category_id)->orderBy('subcategory_name','asc')->get(),
            'product'=>$product,
        ]);
    }

    function ProductUpdate(Request $request){
        $request->validate([
            'title'=>['required'],
            'price'=>['required'],
            'thumbnail'=>['required','image'],
        ]);
        $product=Product::findOrFail($request->product_id);
        $product->title=$request->title;
        if($request->hasFile('thumbnail')){
            $image=$request->file('thumbnail');
            $ext=$request->title.'.'.$image->getClientOriginalExtension();
            $old=public_path('Images/'.$product->created_at->format('Y/m/').$product->id.'/'.$product->thumbnail);
            if(file_exists($old)){
                unlink($old);
            }
            $path=public_path('Images/'.$product->created_at->format('Y/m/').$product->id.'/');
            File::makeDirectory($path, $mode=0777, true, true);
            Image::make($image)->save($path . $ext);
            $product->thumbnail=$ext;
        }
        $product->category_id=$request->category_id;
        $product->subcategory_id=$request->subcategory_id;
        $product->brand_id=$request->brand_id;
        $product->price=$request->price;
        $product->save();
        return redirect('product-list')->with('success', 'Product Update Successfull');
    }

    function ProductDelete($id){
        Product::findOrfail($id)->delete();
        return redirect('product-list')->with('success', 'Product Delete Successfull');
    }

    function ProductRestor($id){
        Product::onlyTrashed()->findOrfail($id)->restore();
        return redirect('product-list')->with('success', 'Product Reset Successfull');
    }

    function ProductSoft($id){
        Product::onlyTrashed()->findOrfail($id)->forceDelete();
        return redirect('product-list')->with('success', 'Product Delete Successfull');
    }


    //-----Product Brands----//
    function AddBrand(){
        $last_value=collect(request()->segments())->last();
        $last=Str::of($last_value)->replace('-','');
        return view('Backend.Brand.brand',[
            'last'=>$last,
        ]);
    }

}
