<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    public function index()
    {
        $products=Product::latest()->paginate(5);
       return view('Products.index',['products'=>$products]);
    }

    public function create(){
        return view('Products.create');
    }

    public function store(Request $request){
        // dd($request->all());

        // Before uploading Everything we need to Validate the fields;

        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'image'=>'required|mimes:png,jpg,gif,jpeg|max:10000',
        ]);


        // Uploading the image file
        $imageName=time().'.'.$request->image->extension();
        $request->image->move(public_path('Products'),$imageName);

        // dd($imageName);
        // Storing the image in the database
        $product =new Product();
        $product->image=$imageName;
        $product->name=$request->name;
        $product->description=$request->description;

        $product->save();
        return back()->withSuccess('Product Created successfully');
    }
    public function edit($id){
        $product =Product::where('id',$id)->first();

        return view('Products.edit',['product'=>$product]);
    }
    public function update(Request $request,$id){
        // dd($id);
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'image'=>'nullable|mimes:png,jpg,gif,jpeg|max:10000',
        ]);

        $product =Product::where('id',$id)->first();
        if (isset($request->image)) {
            // Uploading the image file
            $imageName=time().'.'.$request->image->extension();
            $request->image->move(public_path('Products'),$imageName);
            $product->image=$imageName;
        }


        // dd($imageName);
        // Storing the image in the database
        // $product =new Product();
        // $product->image=$imageName;
        $product->name=$request->name;
        $product->description=$request->description;

        $product->save();
        return back()->withSuccess('Product Updated successfully');
    }
    public function destroy($id){
        $product=Product::where('id',$id)->first();
        $product->delete();
        return back()->withSuccess('Product Deleted successfully');
    }
    public function show($id){
        $product=Product::where('id',$id)->first();
        // $product->delete();
        return view('products.show',['product'=>$product]);
    }
    
}
