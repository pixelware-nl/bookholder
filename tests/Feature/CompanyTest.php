<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_company_index_should_return_success(): void
    {
        // Arrange
        // Login as user with bearer token JWT
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a company
        $company = Company::factory()->create([
            'name' => 'Test Company',
            'kvk' => '12345678',
            'street_address' => '123 Test St',
            'postal_code' => '1234 AB',
            'city' => 'Test City',
            'country' => 'Test Country',
            'iban' => 'NL91ABNA0417164300',
        ]);

        // Act
        $response = $this->get(route('companies.index'));

        // Assert
        $response->assertStatus(200);
    }

    public function test_get_unauthenticated_user_should_redirect_to_login(): void
    {
        // Act
        $response = $this->get(route('companies.index'));

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }
}
