<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(20);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:products|min:3|max:255',
            'description' => 'required|min:30',
            'image' => 'required|mimes:jpg,jpeg,png'
        ]);

        $productImage = $request->file('image');
        $imagePath = 'image/product/' . hexdec(uniqid()) . '.' . strtolower($productImage->getClientOriginalExtension());
        Image::make($productImage)->resize(640, 480)->save($imagePath);

        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->image_path = $imagePath;
        $product->save();

        return redirect()->route('product.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $pharmacies = $product->pharmacies()->paginate(10);
        return view('admin.product.show', compact('product', 'pharmacies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => "required|unique:products,id,$product->id|min:3|max:255",
            'description' => 'required|min:30',
            'image' => 'mimes:jpg,jpeg,png'
        ]);

        $product->title = $request->title;
        $product->description = $request->description;
        if (isset($request->image) && !empty($request->image)) {
            $oldImage = $product->image_path;
            $productImage = $request->file('image');
            $imagePath = 'image/product/' . hexdec(uniqid()) . '.' . strtolower($productImage->getClientOriginalExtension());
            Image::make($productImage)->resize(640, 480)->save($imagePath);
            $product->image_path = $imagePath;
            if (File::exists($oldImage)) {
                File::delete($oldImage);
            }
        }
        $product->update();
        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if (File::exists($product->image_path)) {
            File::delete($product->image_path);
        }
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product deleted successfully');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $products = DB::table('products')->where('title', 'LIKE', '%' . $request->search . "%")->limit(5)->get();
            return $products;
        }
    }
}
