<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\User;
use App\Order;
use App\Product;
use Exception;
use Illuminate\Http\Request;

class TATransactionController extends Controller
{
    public function updateStatus(Request $request, $id) {
        $transaction = Transaction::find($id);
        $transaction->status = $request->status;
        $transaction->update();

        $orders = Order::all()->where('transaction_id', $id);
        for ($i = 0; $i < count($orders); $i++) {
            try {
                $product = Product::find($orders[$i]['product_id']);
                $product->stock = $product->stock - $orders[$i]['quantity'];
                $product->sold =  $orders[$i]['quantity'];
                $product->update();
            } catch (Exception $e) {
                report($e);

                return false;
            }
        }

        return redirect('/admin/new-order');
    }

    public function updateStatusMutant(Request $request, $id) {
        $transaction = Transaction::find($id);
        $transaction->status = $request->status;
        $transaction->update();

        $orders = Order::all()->where('transaction_id', $id);
        for ($i = 0; $i > count($orders); $i++) {
            try {
                $product = Product::find($orders[$i]['product_id']);
                $product->stock = $product->stock - $orders[$i]['quantity'];
                $product->sold =  $orders[$i]['quantity'];
                $product->update();
            } catch (Exception $e) {
                report($e);

                return false;
            }
        }

        return redirect('/admin/new-order');
    }
}
