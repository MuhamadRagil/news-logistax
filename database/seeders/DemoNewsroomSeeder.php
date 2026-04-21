<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class DemoNewsroomSeeder extends Seeder
{
    public function run(): void
    {
        $categories = collect([
            [
                'name' => 'Pajak',
                'slug' => 'pajak',
                'description' => 'Kanal pembaruan regulasi perpajakan, kepatuhan, dan panduan implementasi.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Akuntansi',
                'slug' => 'akuntansi',
                'description' => 'Kanal standar pelaporan keuangan, audit, dan praktik akuntansi korporasi.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Hukum',
                'slug' => 'hukum',
                'description' => 'Kanal perkembangan hukum bisnis, kontrak, dan kepatuhan korporasi.',
                'sort_order' => 3,
            ],
        ])->mapWithKeys(function (array $data) {
            $category = Category::updateOrCreate(
                ['slug' => $data['slug']],
                [
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'is_active' => true,
                    'sort_order' => $data['sort_order'],
                ]
            );

            return [$data['slug'] => $category->id];
        });

        $author = User::query()->firstOrCreate(
            ['email' => 'editorial@logistax.id'],
            ['name' => 'Editorial Logistax', 'password' => 'password', 'is_active' => true]
        );

        $publishedBase = Carbon::now()->subDays(2)->startOfDay();

        $articles = [
            ['title' => 'Pembaruan Tarif PPN Sektor Logistik 2026', 'category' => 'pajak', 'type' => 'news', 'featured' => true],
            ['title' => 'DJP Rilis Pedoman Kredit Pajak untuk UMKM Ekspor', 'category' => 'pajak', 'type' => 'announcement', 'featured' => false],
            ['title' => 'Opini: Menyusun Tax Risk Register yang Relevan', 'category' => 'pajak', 'type' => 'opinion', 'featured' => false],
            ['title' => 'Logistax Buka Klinik Kepatuhan Pajak Kuartal II', 'category' => 'pajak', 'type' => 'press_release', 'featured' => false],

            ['title' => 'PSAK Terkini dan Dampaknya pada Pelaporan Grup Usaha', 'category' => 'akuntansi', 'type' => 'news', 'featured' => false],
            ['title' => 'Pengumuman Jadwal Pelatihan Closing Bulanan 2026', 'category' => 'akuntansi', 'type' => 'announcement', 'featured' => false],
            ['title' => 'Opini: Checklist Kontrol Internal yang Sering Terlewat', 'category' => 'akuntansi', 'type' => 'opinion', 'featured' => false],
            ['title' => 'Press Release: Kolaborasi Logistax dengan Komunitas CFO', 'category' => 'akuntansi', 'type' => 'press_release', 'featured' => false],

            ['title' => 'Rangkuman Putusan Sengketa Kontrak Distribusi Semester I', 'category' => 'hukum', 'type' => 'news', 'featured' => false],
            ['title' => 'Pengumuman Layanan Konsultasi Legal Desk', 'category' => 'hukum', 'type' => 'announcement', 'featured' => false],
            ['title' => 'Opini: Klausul Force Majeure di Era Disrupsi Rantai Pasok', 'category' => 'hukum', 'type' => 'opinion', 'featured' => false],
            ['title' => 'Press Release: Logistax Perluas Dukungan Due Diligence', 'category' => 'hukum', 'type' => 'press_release', 'featured' => false],

            ['title' => 'Strategi Integrasi Data Pajak dan Akuntansi Tahunan', 'category' => 'akuntansi', 'type' => 'news', 'featured' => false],
            ['title' => 'Analisis Aturan Dokumentasi Transfer Pricing Terbaru', 'category' => 'pajak', 'type' => 'news', 'featured' => false],
            ['title' => 'Praktik Terbaik Penyusunan Kontrak Vendor Regional', 'category' => 'hukum', 'type' => 'news', 'featured' => false],
            ['title' => 'Panduan Editorial: Menilai Risiko Kepatuhan Lintas Fungsi', 'category' => 'pajak', 'type' => 'opinion', 'featured' => false],
        ];

        foreach ($articles as $index => $item) {
            $publishedAt = (clone $publishedBase)->addHours($index * 4);

            Article::query()->updateOrCreate(
                ['slug' => Str::slug($item['title'])],
                [
                    'title' => $item['title'],
                    'subtitle' => 'Ringkasan editorial untuk uji coba alur konten V1.',
                    'excerpt' => 'Artikel ini merangkum poin utama, implikasi praktis, dan langkah tindak lanjut untuk tim bisnis dan kepatuhan.',
                    'body' => "Paragraf 1: Konten simulasi untuk pengujian newsroom Logistax.\n\nParagraf 2: Fokus pembahasan mencakup konteks kebijakan, dampak operasional, dan rekomendasi implementasi.\n\nParagraf 3: Materi ini disediakan untuk kebutuhan demo internal pada lingkungan pengembangan.",
                    'status' => Article::STATUS_PUBLISHED,
                    'content_type' => $item['type'],
                    'category_id' => $categories[$item['category']],
                    'author_id' => $author->id,
                    'editor_id' => $author->id,
                    'publish_at' => $publishedAt,
                    'published_at' => $publishedAt,
                    'is_featured' => $item['featured'],
                    'is_indexable' => false,
                    'meta_title' => $item['title'].' | Logistax Demo',
                    'meta_description' => 'Konten demo untuk validasi tampilan dan alur editorial V1.',
                    'og_title' => $item['title'],
                    'og_description' => 'Demo newsroom Logistax untuk pengujian lokal.',
                    'review_notes' => 'Generated by DemoNewsroomSeeder for local/dev testing only.',
                ]
            );
        }
    }
}
