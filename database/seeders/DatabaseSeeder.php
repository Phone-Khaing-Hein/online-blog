<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Phone Khaing Hein",
            'email' => "pkh2662003@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make(71720310),
            'remember_token' => Str::random(10),
        ]);

        User::factory(10)->create();
        Category::factory(7)->create();
        Post::factory(50)->create();
        Tag::factory(7)->create();

        Post::all()->each(function ($post){
            $tagIds = Tag::inRandomOrder()->limit(rand(1,3))->get()->pluck('id');
            $post->tags()->attach($tagIds);
        });
    }
}
