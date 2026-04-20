<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(
            ['key' => 'general'],
            ['value' => [
                'site_name' => 'Logistax News',
                'site_logo' => null,
                'footer_text' => '© '.date('Y').' Logistax. All rights reserved.',
            ]]
        );
    }
}
