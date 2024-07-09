<?php

namespace Database\Seeders;

use App\Enums\ProductType;
use App\Models\Company;
use App\Models\FreelanceLogEntry;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\CompanyFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $pixelware = Company::create([
            'name' => 'Pixelware',
            'street_address' => 'Huidenclubplein 4C',
            'city' => 'Rotterdam',
            'province' => 'South-Holland',
            'postal_code' => '3029PB',
            'country' => 'Netherlands',
            'phone' => '0614412521',
            'email' => 'o.ozbek@pixelware.nl'
        ]);

        $inshared = Company::create([
            'name' => 'InShared',
            'street_address' => '56 Leusderend',
            'city' => 'Leusden',
            'province' => 'Utrecht',
            'postal_code' => '3832RC',
            'country' => 'Netherlands',
            'phone' => '0612345678',
            'email' => 'finance@inshared.nl'
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
            'product_id' => $productDevelopmentTeamFinance->id,
            'rate' => 80,
            'hours' => 88,
        ]);

        FreelanceLogEntry::create([
            'product_id' => $productDevelopmentAlgorithm->id,
            'rate' => 80,
            'hours' => 57,
        ]);

        FreelanceLogEntry::create([
            'product_id' => $productDocumentationAlgorithm->id,
            'rate' => 80,
            'hours' => 15,
        ]);
    }
}
