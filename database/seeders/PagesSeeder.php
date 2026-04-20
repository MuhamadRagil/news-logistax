<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            ['title' => 'About', 'slug' => 'about'],
            ['title' => 'Contact', 'slug' => 'contact'],
            ['title' => 'Editorial Policy', 'slug' => 'editorial-policy'],
            ['title' => 'Privacy Policy', 'slug' => 'privacy-policy'],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(
                ['slug' => $page['slug']],
                [
                    'title' => $page['title'],
                    'body' => '<p>Update this page content from admin panel.</p>',
                    'status' => 'published',
                    'published_at' => now(),
                    'meta_title' => $page['title'].' - Logistax News',
                    'meta_description' => $page['title'].' page for Logistax News.',
                ]
            );
        }
    }
}
