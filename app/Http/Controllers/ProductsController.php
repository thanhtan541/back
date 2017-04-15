<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function index(){
        return Product::orderBy('created_at','desc')->get();
    }

    public function store(Request $request){
        $product = Product::create($request->all() + ['user_id' => Auth::id()]);
        return $request->all();
    }

    public function edit($id){
        return Product::where('id', $id)->first();
    }

    public function destroy($id) {
        try {
            Product::destroy($id);
            return response([], 204);
        } catch (\Exception $e) {
            return response(['Delete fail'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $product = Product::find($id);
        $product->update($input);
        return response()->json($product);
    }
}
