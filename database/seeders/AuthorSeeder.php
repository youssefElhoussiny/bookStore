<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create(['name'=>'فاطمة حبيشة']);
        Author::create(['name'=>'محمد عرابي']);
        Author::create(['name'=>'محمد الزاير']);
        Author::create(['name'=>'عمر النواوي']);
        Author::create(['name'=>'ماجد عطوي']);
        Author::create(['name'=>'رياض سامر']);
    }
}
