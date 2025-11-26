<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductsController extends Controller
{
    public function create(CreateProductRequest $request) {

        Products::create($request->validated());

        Cache::forget('allProducts');

        return redirect()->back()->with('success','Product created successfully');
}
    public function index()
    {

        $products = Cache::Remember('allProducts',300,fn()

        => Products::latest()->take(9)->get());



            return view('welcome', [

                'products' => $products,
        ]);
    }
    public function flash()
    {

        Cache::forget('allProducts');
            return redirect()->route('home');
    }


}
