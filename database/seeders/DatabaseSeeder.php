<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Throwable;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @throws Throwable
     */
    public function run(): void
    {
        try {
            \DB::transaction(static function () {
                $tenant = Tenant::create([
                    'name' => 'pixelware',
                    'slug' => 'pixelware',
                ]);

                User::create([
                    'name' => 'okan ozbek',
                    'email' => 'o.ozbek@pixelware.nl',
                    'password' => \Hash::make(\Str::random()),
                    'tenant_id' => $tenant->id,
                ]);
            });
            \DB::commit();
        } catch (Throwable $e) {
            \DB::rollBack();
            throw $e;
        }
    }
}
