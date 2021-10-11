<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Http\Resources\Product as ProductResource;

class ProductController extends BaseController
{

    public function index()
    {
        $products = Product::all();
        return $this->sendResponse(ProductResource::collection($products), 'Products fetched.');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required|unique:products|min:3|max:255',
            'description' => 'required|min:30',
            'image_path' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->image_path = $request->image_path;
        $product->save();
        return $this->sendResponse(new ProductResource($product), 'Product created.');
    }


    public function show($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return $this->sendError('Product does not exist.');
        }
        return $this->sendResponse(new ProductResource($product), 'Product fetched.');
    }


    public function update(Request $request, Product $product)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => "required|unique:products,id,$product->id|min:3|max:255",
            'description' => 'required|min:30',
            'image_path' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $product->title = $request->title;
        $product->description = $request->description;
        $product->image_path = $request->image_path;
        $product->save();

        return $this->sendResponse(new ProductResource($product), 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return $this->sendResponse([], 'Product deleted.');
    }

    public function search(Request $request)
    {
        $products = DB::table('products')->where('title', 'LIKE', '%' . $request->search . "%")->limit(5)->get();
        return $products;
    }
}
