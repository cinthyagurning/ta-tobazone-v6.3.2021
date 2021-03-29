<?php

namespace Tests\Feature\Http\Controllers\Renewed;

use App\Http\Controllers\Renewed\ProductController;
use App\Product;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

class ProductControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function getTestCasesStore()
    {
        $path = __DIR__ . "/../TestCases/productController_store.json";
        $testCasesJSON = file_get_contents($path);
        $decodedTestCases = json_decode($testCasesJSON, true);

        $testCases = [];
        foreach ($decodedTestCases as $dtc) {
            $testName = $dtc['test_name'];
            $testData = $dtc['test_data'];
            $expectedResult = $dtc['test_expected_result'];
            $testCases[$testName] = [$testData, $expectedResult];
        }

        return $testCases;
    }

    /**
     * @test
     * @dataProvider getTestCasesStore
     */
    public function testStore($testData, $expectedResult)
    {
        if ($testData['merchant'] != null) {
            // define mock data
            // mock merchant
            $mockMerchant = factory(User::class)->create($testData['merchant']);
            // login as merchant
            $this->actingAs($mockMerchant);
        }

        // define parameters
        $paramRequest = new Request();
        $paramRequest->replace($testData['request']['product']);
        $paramId = $testData['request']['id_product_type'];

        // call function
        $storedProduct = (new ProductController())->store($paramRequest, $paramId);
        if (!$expectedResult['is_error']) {
            $this->assertNotEmpty($storedProduct);

            // define expected result
            $expectedProduct = new Product($expectedResult['product']);
            $expectedProduct->user_id = $mockMerchant->id;
            $expectedProduct->images = $expectedResult['product']['images'];
            $expectedProduct->asal = $expectedResult['product']['asal'];

            // assert value
            $this->assertEquals($expectedProduct->name, $storedProduct->name);
            $this->assertEquals($expectedProduct->price, $storedProduct->price);
            $this->assertEquals($expectedProduct->images, $storedProduct->images);
            $this->assertEquals($expectedProduct->stock, $storedProduct->stock);
            $this->assertEquals($expectedProduct->description, $storedProduct->description);
            $this->assertEquals($expectedProduct->specification, $storedProduct->specification);
            $this->assertEquals($expectedProduct->asal, $storedProduct->asal);
            $this->assertEquals($expectedProduct->color, $storedProduct->color);
            $this->assertEquals($expectedProduct->user_id, $storedProduct->user_id);
            $this->assertEquals($expectedProduct->sold, $storedProduct->sold);
        } else {
            $this->assertEmpty($storedProduct);
        }
    }
}
