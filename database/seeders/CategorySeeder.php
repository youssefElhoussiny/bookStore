<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name'=>"ريادة الاعمال"]);
        Category::create(['name'=>"العمل الحر"]);
        Category::create(['name'=>"التسويق و المبيعات"]);
        Category::create(['name'=>"التصميم"]);
        Category::create(['name'=>"البرمجة"]);
    }
}
