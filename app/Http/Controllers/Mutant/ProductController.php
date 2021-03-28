<?php

namespace App\Http\Controllers\Mutant;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    private function createProductValidator(Request $request)
    {
        $rules = [
            'images' => 'required',
            'name' => 'required',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|numeric|min:1',
            'description' => 'required',
            'product_origin' => 'required',
            'dimention' => 'required',
            'weight' => 'required|numeric|min:1'
        ];

        $messages = [
            'required' => 'The :attribute field is required.',
            'numeric' => 'The :attribute field must be numeric.',
            'min' => 'The minimum value of :attribute field is 1.',
        ];

        return Validator::make($request->all(), $rules, $messages);
    }

    public function storeMutant1(Request $request, $id)
    {
        // validate input request
        $validator = $this->createProductValidator($request);
        // mutant 1: add !
        // $validator->fails() returns false, then data are valid
        // but $validator->fails() returns true, then data are not valid
        if (!$validator->fails()) {
            // this block code will executed only if condition is `true`

            // $error = $validator->errors();
            // return $error;
            return null;
        }

        $product = new Product();
        // authorize user
        if (!Auth::check()) {
            // return new Error("Not authorized.");
            return null;
        }
        $product->user_id = Auth::user()->id;
        $product->color = $request->color;

        if ($id == 1) {
            $product->cat_product = "ulos";
            $product->specification = json_encode([
                'dimention' => $request->dimention,
                'weight' => $request->weight
            ]);
            $product->category = $request->category;
        } else if ($id == 2) {
            $product->cat_product = "pakaian";
            $product->specification = json_encode([
                'size' => $request->dimention,
                'weight' => $request->weight
            ]);
            $product->category = $request->category;
        } else if ($id == 3) {
            $product->cat_product = "makanan";
            $product->specification = json_encode([
                'size_pack' => $request->dimention,
                'weight' => $request->weight,
                'umur_simpan' => $request->color
            ]);
            $product->color = "-";
            $product->category = $request->category;
        } else if ($id == 4) {
            $product->cat_product = "aksesoris";
            $product->specification = json_encode([
                'size' => $request->dimention,
                'weight' => $request->weight
            ]);
            $product->category = $request->category;
        } else if ($id == 5) {
            $product->cat_product = "obat";
            $product->specification = json_encode([
                'jenis' => $request->dimention,
                'weight' => $request->weight
            ]);

            if ($request->dimention == "Padat") {
                $product->color = $request->color_1;
            } else if ($request->dimention == "Cair") {
                $product->color = $request->color;
            }

            $product->category = "-";
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->sold = 0;
        $product->description = $request->description;
        $product->images = json_encode($request->images);
        $product->asal = $request->product_origin;
        $product->save();

        return $product;
    }
}
