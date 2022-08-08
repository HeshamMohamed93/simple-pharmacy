<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use App\Models\Product;
use App\Models\ProductPharmacy;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pharmacies = Pharmacy::latest()->paginate(20);
        return view('admin.pharmacy.index', compact('pharmacies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pharmacy.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:pharmacies|min:3|max:255',
            'address' => 'required|min:10'
        ]);

        $pharmacy = new Pharmacy();
        $pharmacy->name = $request->name;
        $pharmacy->address = $request->address;
        $pharmacy->save();

        return redirect()->route('pharmacy.index')->with('success', 'Pharmacy created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function show(Pharmacy $pharmacy)
    {
        $ownProducts = $pharmacy->products()->paginate(10);
        $exception = $pharmacy->products->pluck('id')->toArray();
        $products = new Product();
        $products = $products->whereNotIn('id',$exception)->paginate(10);
        return view('admin.pharmacy.show', compact('pharmacy', 'ownProducts', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function edit(Pharmacy $pharmacy)
    {
        return view('admin.pharmacy.edit', compact('pharmacy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pharmacy $pharmacy)
    {
        $request->validate([
            'name' => "required|unique:pharmacies,id,$pharmacy->id|min:3|max:255",
            'address' => 'required|min:10'
        ]);

        $pharmacy->name = $request->name;
        $pharmacy->address = $request->address;
        $pharmacy->update();
        return redirect()->route('pharmacy.index')->with('success', 'Pharmacy updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pharmacy $pharmacy)
    {
        $pharmacy->delete();
        return redirect()->route('pharmacy.index')->with('success', 'Pharmacy deleted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function listProducts(Pharmacy $pharmacy)
    {
        $exception = $pharmacy->products->pluck('id')->toArray();
        $products = new Product();
        $products = $products->whereNotIn('id',$exception)->paginate(10);
        return view('admin.pharmacy.add-product', compact('pharmacy', 'products'));
    }

    public function addProducts(Request $request, $pharmacyId)
    {
        $pharmacy = Pharmacy::find($pharmacyId);
        $newProductIds = $request->get('product');
        $prices = array_filter($request->get('prices'));
        $quantities = array_filter($request->get('quantities'));
        foreach ($newProductIds as $key => $newProductId) {
            $product = Product::find($newProductId);
            $pharmacy->products()->
            attach($product, ['product_price' => $prices[$key], 'product_quantity' => $quantities[$key]]);
        }
        return redirect()->route('pharmacy.show', $pharmacy)->with('success', 'Products added successfully');
    }
}
