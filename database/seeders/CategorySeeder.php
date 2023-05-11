<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Category;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 20 parent categories (parent_id = null)
        $categories = Category::factory(20)->create();
        $totalCategoriesCount = 20;

        // Create a category tree based on the 20 created categories:
        // children count for 1 category = rand (1, 3)
        // max depth = 3
        foreach ($categories as $category) {
            $this->createChildCategories($category, 1, 3, $totalCategoriesCount);
        }

        // Fill in the banner_category table:
        // attach 6 to 10 random banners to each category
        $banners = Banner::all();
        Category::all()->each(function ($category) use ($banners) {
            $category->banners()->attach(
                $banners->random(rand(6,10))->pluck('id')->toArray()
            );
        });
    }

    public function createChildCategories(Category $category, $currentDepth, $maxDepth, &$totalCategoriesCount) {
        if ($currentDepth > $maxDepth) {
            return;
        }
        $childrenCount = rand(1, 3);
        for ($i = 0; $i < $childrenCount; $i++) {
            if ($totalCategoriesCount >= 100) {
                return;
            }
            $childCategory = Category::factory()->create(['parent_id' => $category->id]);
            $totalCategoriesCount++;
            $this->createChildCategories($childCategory, $currentDepth+1, $maxDepth, $totalCategoriesCount);
        }
    }
}
