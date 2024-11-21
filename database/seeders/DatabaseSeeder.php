<?php

namespace Database\Seeders;

use App\Enums\ProductType;
use App\Models\Company;
use App\Models\FreelanceLogEntry;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $pixelware = Company::create([
            'name' => 'Pixelware',
            'kvk' => '94129770',
            'street_address' => 'Huidenclubplein 4C',
            'city' => 'Rotterdam',
            'postal_code' => '3029PB',
            'country' => 'Netherlands',
        ]);

        $inshared = Company::create([
            'name' => 'InShared',
            'kvk' => '08053410',
            'street_address' => '56 Leusderend',
            'city' => 'Leusden',
            'postal_code' => '3832RC',
            'country' => 'Netherlands',
        ]);

        $user = User::create([
            'company_id' => $pixelware->id,
            'full_name' => 'Test Account',
            'email' => 'test@pixelware.nl',
            'email_verified_at' => now(),
            'password' => Hash::make('secret!2024'),
            'remember_token' => null,
        ]);

        $productDevelopmentTeamFinance = Product::create([
            'company_id' => $inshared->id,
            'name' => 'Development Team Finance',
            'type' => ProductType::DEVELOPMENT
        ]);

        $productDevelopmentAlgorithm = Product::create([
            'company_id' => $inshared->id,
            'name' => 'Development algorithm',
            'type' => ProductType::DEVELOPMENT
        ]);

        $productDocumentationAlgorithm = Product::create([
            'company_id' => $inshared->id,
            'name' => 'Documentation algorithm',
            'type' => ProductType::DOCUMENTATION
        ]);

        FreelanceLogEntry::create([
            'user_id' => $user->id,
            'product_id' => $productDevelopmentTeamFinance->id,
            'rate' => 80,
            'hours' => 88,
        ]);

        FreelanceLogEntry::create([
            'user_id' => $user->id,
            'product_id' => $productDevelopmentAlgorithm->id,
            'rate' => 80,
            'hours' => 57,
        ]);

        FreelanceLogEntry::create([
            'user_id' => $user->id,
            'product_id' => $productDocumentationAlgorithm->id,
            'rate' => 80,
            'hours' => 15,
        ]);
    }
}
