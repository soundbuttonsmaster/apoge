<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Ensure admin login credentials
        DB::table('admins')->updateOrInsert(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'phone' => null,
                'username' => 'admin@gmail.com',
                'password' => Hash::make('Qwertyuiop'),
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        $blogs = [
            [
                'title' => 'GNSS Land Leveller Improves Seed Placement Through Better Levelling',
                'short' => 'A GNSS Land Leveller flattens your field so seeds sit at the right depth in even moisture, lifting germination and yield.',
            ],
            [
                'title' => 'How Does a GNSS Land Leveller Deliver Consistent Field Levelling?',
                'short' => 'Discover how a GNSS Land Leveller uses satellite tech to deliver precise, consistent field levelling and cut water wastage.',
            ],
            [
                'title' => 'GNSS Land Leveller: Why Indian Farmers Are Switching to Smart Levelling',
                'short' => 'See why Indian farmers are switching to a GNSS Land Leveller: lower water and diesel bills, flatter fields, and steadier yields.',
            ],
            [
                'title' => 'How a GNSS Land Leveller Reduces Water Wastage',
                'short' => 'See how a GNSS Land Leveller cuts water wastage on Indian farms by stopping seepage, runoff and extra pump hours.',
            ],
            [
                'title' => 'How Laser Land Levelling Saves Water & Increases Crop Yield',
                'short' => 'Learn how Laser Land Leveller saves 25-40% water and increases crop yield by 10-20%. Complete guide for Indian farmers.',
            ],
            [
                'title' => 'Top 5 Benefits of Using a Laser Land Leveller for Uttar Pradesh',
                'short' => 'Discover the top 5 benefits of using a Laser Land Leveller for farmers in Uttar Pradesh. Save water and increase crop yield.',
            ],
            [
                'title' => 'Laser Land Leveller Subsidy in Uttar Pradesh',
                'short' => 'Learn about Laser Land Leveller subsidy in Uttar Pradesh. Check eligibility, subsidy amount, documents, and how to apply.',
            ],
            [
                'title' => 'Best Laser Land Leveller for Uttar Pradesh Farmers',
                'short' => 'Discover the best laser land leveller for UP farmers. Save up to 30% water, boost crop yield, and get subsidy benefits.',
            ],
        ];

        $day = 0;
        foreach ($blogs as $item) {
            $slug = Str::slug($item['title']);
            $exists = DB::table('blogs')->where('slug', $slug)->exists();
            if ($exists) {
                continue;
            }

            $created = Carbon::now()->subDays($day);
            DB::table('blogs')->insert([
                'title' => $item['title'],
                'slug' => $slug,
                'image' => 'default-featured.png',
                'short_description' => $item['short'],
                'full_description' => '<p>' . e($item['short']) . '</p><p>Apogee Agrotech provides precision land levelling solutions for Indian farmers, including Laser Land Leveller and GNSS Land Leveller systems designed to save water, improve irrigation, and increase crop productivity.</p>',
                'status' => '1',
                'created_at' => $created,
                'updated_at' => $created,
                'meta_title' => $item['title'] . ' | Apogee Agrotech',
                'meta_keywords' => 'laser land leveller, gnss land leveller, apogee agrotech, precision farming',
                'meta_description' => $item['short'],
                'head_content' => null,
            ]);
            $day += 2;
        }
    }
}
