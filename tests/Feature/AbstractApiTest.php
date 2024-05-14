<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class AbstractApiTest extends TestCase
{
    public const API_V1_PREFIX = '/api/v1';

    use RefreshDatabase;

    protected function actingAsUser(): void
    {
        $user = User::factory()->withToken()->create();

        Sanctum::actingAs($user, ['*']);
    }

    protected function assertUnauthenticated(string $endpoint): void
    {
        $response = $this->getJson($endpoint);

        $response->assertStatus(401);
    }
}

