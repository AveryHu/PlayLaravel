<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->delete();
        DB::table('categories')->insert([
            'name' => '新聞時事'
        ]);
        DB::table('categories')->insert([
            'name' => '旅遊美食'
        ]);
        DB::table('categories')->insert([
            'name' => '休閒娛樂'
        ]);
    }
}
