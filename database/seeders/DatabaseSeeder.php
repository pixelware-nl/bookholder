<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Log;
use App\Models\User;
use App\Models\UserCompany;
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

        $friva = Company::create([
            'name' => 'Friva B.V.',
            'kvk' => '92892159',
            'street_address' => 'Vondellaan 22',
            'city' => 'Zandvoort',
            'postal_code' => '2041BD',
            'country' => 'Netherlands',
        ]);

        User::create([
            'company_id' => $pixelware->id,
            'full_name' => 'Test Account',
            'email' => 'test@pixelware.nl',
            'email_verified_at' => now(),
            'password' => Hash::make('secret!2024'),
            'remember_token' => null,
        ]);

        $user = User::create([
            'company_id' => $pixelware->id,
            'full_name' => 'Okan Ozbek',
            'email' => 'o.ozbek@pixelware.nl',
            'email_verified_at' => now(),
            'password' => Hash::make('qwedsazxc321'),
            'remember_token' => null,
        ]);

        UserCompany::create([
            'user_id' => $user->id,
            'company_id' => $pixelware->id,
        ]);

        UserCompany::create([
            'user_id' => $user->id,
            'company_id' => $friva->id,
        ]);

        Log::create([
            'user_id' => $user->id,
            'company_id' => $friva->id,
            'rate' => 60,
            'hours' => 6,
            'name' => 'Kolibri Mediapartners',
            'description' => 'Apart Laravel project met Kolibri Mediapartners integratie aangemaakt.',
        ]);
    }
}
