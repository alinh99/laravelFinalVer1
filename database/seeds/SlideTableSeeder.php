<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SlideTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('slides')->insert([
            [
                'id' => 1,
                'name'=>'',
                'link' => '',
                'image' => 'slide1.jpg'
            ],
            [
                'id' => 2,
                'name'=>'',
                'link' => '',
                'image' => 'slide2.jpg'
            ],
            [
                'id' => 3,
                'name'=>'',
                'link' => '',
                'image' => 'slide3.jpg'
            ],
            [
                'id' => 4,
                'name'=>'',
                'link' => '',
                'image' => 'slide4.jpg'
            ],
            [
                'id' => 5,
                'name'=>'',
                'link' => '',
                'image' => 'slide5.jpg'
            ],
            [
                'id' => 6,
                'name' => 'Tạo kiểu tóc',
                'link' => '',
                'image' => 'slide6.jpg'
            ],
            [
                'id' => 7,
                'name' => 'Chăm sóc da',
                'link' => '',
                'image' => 'slide7.jpg'
            ],
            [
                'id' => 8,
                'name' => 'Chăm sóc râu',
                'link' => '',
                'image' => 'slide8.jpg'
            ],
            [
                'id' => 9,
                'name' => 'Chăm sóc cơ thể',
                'link' => '',
                'image' => 'slide9.jpg'
            ],
            [
                'id' => 10,
                'name' => 'Phụ kiện',
                'link' => '',
                'image' => 'slide10.jpg'
            ],
            [
                'id' => 11,
                'name' => 'Nước hoa',
                'link' => '',
                'image' => 'slide11.jpg'
            ],
            [
                'id' => 12,
                'name' => 'Quần lót và vớ',
                'link' => '',
                'image' => 'slide12.jpg'
            ],
        ]);
    }
}
