<?php

namespace Tests\Feature\Http\Controllers\Renewed;

use App\Http\Controllers\Renewed\TransactionController;
use App\Order;
use App\Product;
use App\Transaction;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

class TransactionControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    protected $mockMerchant;
    protected $mockCustomer;

    public function setUp()
    {
        parent::setUp();

        // store and initialize users mock
        $this->mockMerchant = factory(User::class)->create(['username' => 'merchant']);
        $this->mockCustomer = factory(User::class)->create(['username' => 'customer']);
    }

    public function test_updateStatus_successTerima()
    {
        // define mock data
        $mockTransaction = factory(Transaction::class)->create([
            'customer_id' => $this->mockCustomer->id,
            'merchant_id' => $this->mockMerchant->id,
            'status' => 'pending',
        ]);
        $mockProduct = factory(Product::class)->create([
            'user_id' => $this->mockMerchant->id,
            'name' => 'Tas Pakkat',
            'price' => '50000',
            'images' => 'image.jpeg',
            'category' => 'buatan tangan',
            'stock' => 2,
            'sold' => 0,
            'description' => 'Bahan dasar dari rotan dan bambu',
            'specification' => '{"size":"Sedang","weight":"1"}',
            'color' => 'Hitam',
            'cat_product' => 'aksesoris',
            'asal' => 'Toba Samosir',
        ]);

        // store a new order in database
        factory(Order::class)->create([
            'product_id' => $mockProduct->id,
            'transaction_id' => $mockTransaction->id,
            'quantity' => 1,
        ]);

        // define parameters
        $paramTransactionId = $mockTransaction->id;
        $paramRequest = new Request();
        $paramRequest->replace(['status' => 'acceptedByAdmin']);

        // define expected result
        $expectedResult = array(
            'updated_transaction' => 1,
            'updated_product' => 1,
        );

        $result = (new TransactionController())->updateStatus($paramRequest, $paramTransactionId);
        $this->assertEquals($expectedResult, $result);
    }

    public function test_updateStatus_successTolak()
    {
        // define mock data
        $mockTransaction = factory(Transaction::class)->create([
            'customer_id' => $this->mockCustomer->id,
            'merchant_id' => $this->mockMerchant->id,
            'status' => 'pending',
        ]);
        $mockProduct = factory(Product::class)->create([
            'user_id' => $this->mockMerchant->id,
            'name' => 'Tas Pakkat',
            'price' => '50000',
            'images' => 'image.jpeg',
            'category' => 'buatan tangan',
            'stock' => 2,
            'sold' => 0,
            'description' => 'Bahan dasar dari rotan dan bambu',
            'specification' => '{"size":"Sedang","weight":"1"}',
            'color' => 'Hitam',
            'cat_product' => 'aksesoris',
            'asal' => 'Toba Samosir',
        ]);

        // store a new order in database
        factory(Order::class)->create([
            'product_id' => $mockProduct->id,
            'transaction_id' => $mockTransaction->id,
            'quantity' => 1,
        ]);

        // define parameters
        $paramTransactionId = $mockTransaction->id;
        $paramRequest = new Request();
        $paramRequest->replace(['status' => 'rejectedByAdmin']);

        // define expected result
        $expectedResult = array(
            'updated_transaction' => 1,
            'updated_product' => 0,
        );

        $result = (new TransactionController())->updateStatus($paramRequest, $paramTransactionId);
        $this->assertEquals($expectedResult, $result);
    }
}
