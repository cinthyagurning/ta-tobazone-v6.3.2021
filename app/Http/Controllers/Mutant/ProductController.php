<?php

namespace App\Http\Controllers\Mutant;

use App\Http\Controllers\Controller;
use App\Product;
use Exception;
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
        // authorize user
        // mutant 1: remove ! symbol
        if (Auth::check()) {
            // user not authorized
            return null;
        }

        // validate input request
        $validator = $this->createProductValidator($request);
        if ($validator->fails()) {
            // $validator->fails() returns false, then data are valid
            // but $validator->fails() returns true, then data are not valid
            // this block code will executed only if condition is `true`
            return null;
        }

        $product = new Product();
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

        $product->user_id = Auth::user()->id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->sold = 0;
        $product->description = $request->description;
        $product->images = json_encode($request->images);
        $product->asal = $request->product_origin;

        try {
            $product->save();
        } catch (\Exception $e) {
            return null;
        }

        return $product;
    }

    public function storeMutant2(Request $request, $id)
    {
        // authorize user
        if (!Auth::check()) {
            // user not authorized
            return null;
        }

        // validate input request
        $validator = $this->createProductValidator($request);
        // mutant 2: add ! symbol
        if (!$validator->fails()) {
            // $validator->fails() returns false, then data are valid
            // but $validator->fails() returns true, then data are not valid
            // this block code will executed only if condition is `true`
            return null;
        }

        $product = new Product();
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

        $product->user_id = Auth::user()->id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->sold = 0;
        $product->description = $request->description;
        $product->images = json_encode($request->images);
        $product->asal = $request->product_origin;

        try {
            $product->save();
        } catch (\Exception $e) {
            return null;
        }

        return $product;
    }

    public function storeMutant3(Request $request, $id)
    {
        // authorize user
        if (!Auth::check()) {
            // user not authorized
            return null;
        }

        // validate input request
        $validator = $this->createProductValidator($request);
        if ($validator->fails()) {
            // $validator->fails() returns false, then data are valid
            // but $validator->fails() returns true, then data are not valid
            // this block code will executed only if condition is `true`
            return null;
        }

        $product = new Product();
        $product->color = $request->color;

        // mutant 3: '==' change to '!='
        if ($id != 1) {
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


        $product->user_id = Auth::user()->id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->sold = 0;
        $product->description = $request->description;
        $product->images = json_encode($request->images);
        $product->asal = $request->product_origin;

        try {
            $product->save();
        } catch (\Exception $e) {
            return null;
        }

        return $product;
    }

    public function storeMutant4(Request $request, $id)
    {
        // authorize user
        if (!Auth::check()) {
            // user not authorized
            return null;
        }

        // validate input request
        $validator = $this->createProductValidator($request);
        if ($validator->fails()) {
            // $validator->fails() returns false, then data are valid
            // but $validator->fails() returns true, then data are not valid
            // this block code will executed only if condition is `true`
            return null;
        }

        $product = new Product();
        $product->color = $request->color;

        if ($id == 1) {
            $product->cat_product = "ulos";
            $product->specification = json_encode([
                'dimention' => $request->dimention,
                'weight' => $request->weight
            ]);
            $product->category = $request->category;
            // mutant 4: '==' change to '!='
        } else if ($id != 2) {
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


        $product->user_id = Auth::user()->id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->sold = 0;
        $product->description = $request->description;
        $product->images = json_encode($request->images);
        $product->asal = $request->product_origin;

        try {
            $product->save();
        } catch (\Exception $e) {
            return null;
        }

        return $product;
    }

    public function storeMutant5(Request $request, $id)
    {
        // authorize user
        if (!Auth::check()) {
            // user not authorized
            return null;
        }

        // validate input request
        $validator = $this->createProductValidator($request);
        if ($validator->fails()) {
            // $validator->fails() returns false, then data are valid
            // but $validator->fails() returns true, then data are not valid
            // this block code will executed only if condition is `true`
            return null;
        }

        $product = new Product();
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
            // mutant 5: '==' change to '!='
        } else if ($id != 3) {
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


        $product->user_id = Auth::user()->id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->sold = 0;
        $product->description = $request->description;
        $product->images = json_encode($request->images);
        $product->asal = $request->product_origin;

        try {
            $product->save();
        } catch (\Exception $e) {
            return null;
        }

        return $product;
    }

    public function storeMutant6(Request $request, $id)
    {
        // authorize user
        if (!Auth::check()) {
            // user not authorized
            return null;
        }

        // validate input request
        $validator = $this->createProductValidator($request);
        if ($validator->fails()) {
            // $validator->fails() returns false, then data are valid
            // but $validator->fails() returns true, then data are not valid
            // this block code will executed only if condition is `true`
            return null;
        }

        $product = new Product();
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
            // mutant 6: '==' change to '!='
        } else if ($id != 4) {
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


        $product->user_id = Auth::user()->id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->sold = 0;
        $product->description = $request->description;
        $product->images = json_encode($request->images);
        $product->asal = $request->product_origin;

        try {
            $product->save();
        } catch (\Exception $e) {
            return null;
        }

        return $product;
    }

    public function storeMutant7(Request $request, $id)
    {
        // authorize user
        if (!Auth::check()) {
            // user not authorized
            return null;
        }

        // validate input request
        $validator = $this->createProductValidator($request);
        if ($validator->fails()) {
            // $validator->fails() returns false, then data are valid
            // but $validator->fails() returns true, then data are not valid
            // this block code will executed only if condition is `true`
            return null;
        }

        $product = new Product();
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
            // mutant 7: '==' change to '!='
        } else if ($id != 5) {
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


        $product->user_id = Auth::user()->id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->sold = 0;
        $product->description = $request->description;
        $product->images = json_encode($request->images);
        $product->asal = $request->product_origin;

        try {
            $product->save();
        } catch (\Exception $e) {
            return null;
        }

        return $product;
    }

    public function storeMutant8(Request $request, $id)
    {
        // authorize user
        if (!Auth::check()) {
            // user not authorized
            return null;
        }

        // validate input request
        $validator = $this->createProductValidator($request);
        if ($validator->fails()) {
            // $validator->fails() returns false, then data are valid
            // but $validator->fails() returns true, then data are not valid
            // this block code will executed only if condition is `true`
            return null;
        }

        $product = new Product();
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

            // mutant 8: '==' change to '!='
            if ($request->dimention != "Padat") {
                $product->color = $request->color_1;
            } else if ($request->dimention == "Cair") {
                $product->color = $request->color;
            }

            $product->category = "-";
        }


        $product->user_id = Auth::user()->id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->sold = 0;
        $product->description = $request->description;
        $product->images = json_encode($request->images);
        $product->asal = $request->product_origin;

        try {
            $product->save();
        } catch (\Exception $e) {
            return null;
        }

        return $product;
    }

    public function storeMutant9(Request $request, $id)
    {
        // authorize user
        if (!Auth::check()) {
            // user not authorized
            return null;
        }

        // validate input request
        $validator = $this->createProductValidator($request);
        if ($validator->fails()) {
            // $validator->fails() returns false, then data are valid
            // but $validator->fails() returns true, then data are not valid
            // this block code will executed only if condition is `true`
            return null;
        }

        $product = new Product();
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
                // mutant 9: '==' change to '!='
            } else if ($request->dimention != "Cair") {
                $product->color = $request->color;
            }

            $product->category = "-";
        }


        $product->user_id = Auth::user()->id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->sold = 0;
        $product->description = $request->description;
        $product->images = json_encode($request->images);
        $product->asal = $request->product_origin;

        try {
            $product->save();
        } catch (\Exception $e) {
            return null;
        }

        return $product;
    }
}
