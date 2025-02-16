<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Member;
use App\Models\Article;
use App\Models\Service;
use App\Models\Category;
use Database\Factories\ServiceFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'hossain',
            'email' => 'hossain@gmail.com',
            'password' => '1234'
        ]);

        Service::factory(10)->create();

        Member::factory(10)->create();

        Category::insert([
            [
                'category_name' => 'Frontend Development',
                'slug' => 'frontend-development',
                'status' => 1,
            ],
            [
                'category_name' => 'Backend Development',
                'slug' => 'backend-development',
                'status' => 1,
            ],
            [
                'category_name' => 'Full Stack Development',
                'slug' => 'full-stack-development',
                'status' => 1,
            ],
            [
                'category_name' => 'Web Design',
                'slug' => 'web-design',
                'status' => 1,
            ],
            [
                'category_name' => 'E-commerce Development',
                'slug' => 'e-commerce-development',
                'status' => 1,
            ],
            [
                'category_name' => 'Mobile Web Development',
                'slug' => 'mobile-web-development',
                'status' => 1,
            ],
            [
                'category_name' => 'UI/UX Design',
                'slug' => 'ui-ux-design',
                'status' => 1,
            ],
            [
                'category_name' => 'Content Management Systems',
                'slug' => 'cms',
                'status' => 1,
            ],
            [
                'category_name' => 'Web Application Development',
                'slug' => 'web-application-development',
                'status' => 1,
            ],
            [
                'category_name' => 'Web Security',
                'slug' => 'web-security',
                'status' => 1,
            ],
        ]);
        Article::factory(30)->create();
        Faq::factory(10)->create();

    }
}
