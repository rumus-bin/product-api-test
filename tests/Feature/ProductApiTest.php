<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductApiTest extends AbstractApiTest
{
    private const PRODUCT_ENDPOINT = self::API_V1_PREFIX . '/products';

    use RefreshDatabase;

    /** @test */
    public function unauthenticated_users_cannot_access_products_endpoint(): void
    {
        $response = $this->getJson(self::PRODUCT_ENDPOINT);

        $this->assertUnauthenticated(self::PRODUCT_ENDPOINT);
    }

    /** @test */
    public function authenticated_users_can_access_products_endpoint(): void
    {
        Product::factory()->count(5)->create();
        $this->actingAsUser();

        $response = $this->getJson(self::PRODUCT_ENDPOINT);
        $data = $response->json();

        $response->assertStatus(200);
        $this->assertArrayHasKey('data', $data);
       $this->assertCount(5, $data['data']);
    }
}

