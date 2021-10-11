<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Models\Pharmacy;
use App\Http\Resources\Pharmacy as PharmacyResource;

class PharmacyController extends BaseController
{

    public function index()
    {
        $pharmacies = Pharmacy::all();
        return $this->sendResponse(PharmacyResource::collection($pharmacies), 'Pharmacies fetched.');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|unique:pharmacies|min:3|max:255',
            'address' => 'required|min:10'
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        $pharmacy = new Pharmacy();
        $pharmacy->name = $request->name;
        $pharmacy->address = $request->address;
        $pharmacy->save();
        return $this->sendResponse(new PharmacyResource($pharmacy), 'Pharmacy created.');
    }


    public function show($id)
    {
        $pharmacy = Pharmacy::find($id);
        if (is_null($pharmacy)) {
            return $this->sendError('Pharmacy does not exist.');
        }
        return $this->sendResponse(new PharmacyResource($pharmacy), 'Pharmacy fetched.');
    }


    public function update(Request $request, Pharmacy $pharmacy)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => "required|unique:pharmacies,id,$pharmacy->id|min:3|max:255",
            'address' => 'required|min:10'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $pharmacy->name = $request->name;
        $pharmacy->address = $request->address;
        $pharmacy->update();

        return $this->sendResponse(new PharmacyResource($pharmacy), 'Pharmacy updated.');
    }

    public function destroy(Pharmacy $pharmacy)
    {
        $pharmacy->delete();
        return $this->sendResponse([], 'Pharmacy deleted.');
    }

    public function addProducts(Request $request, $pharmacyId)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'products' => "required|array"
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $products = $request->products;
        $pharmacy = Pharmacy::find($pharmacyId);
        foreach ($products as $product) {
            $attachProduct = Product::find($product["id"]);
            $pharmacy->products()->
            attach($attachProduct, ["product_price" => $product["price"], "product_quantity" => $product["quantity"]]);
        }

        return $this->sendResponse([], 'Products added to pharmacy successfully.');
    }
}
