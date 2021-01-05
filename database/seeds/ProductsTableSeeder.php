<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert([
            [
                'id' => 1,
                'title' => 'Volcanic Clay',
                'price'=> 299000,
                'image'=>'sap1.jpg'
            ],
            [
                'id' => 2,
                'title' => 'Osis+',
                'price'=> 350000,
                'image'=>'sap2.jpg'
            ],
            [
                'id' => 3,
                'title' => 'Hanz De Fuko Claymation',
                'price'=> 400000,
                'image'=>'sap3.jpg'
            ],
            [
                'id' => 4,
                'title' => 'Loreal',
                'price'=> 320000,
                'image'=>'sap4.jpg'
            ],
            [
                'id' => 5,
                'title' => 'Kevin Murphy',
                'price'=> 350000,
                'image'=>'sap5.png'
            ],
            [
                'id' => 6,
                'title' => 'Glanzen Clay Wax',
                'price'=> 370000,
                'image'=>'sap6.jpg'
            ],
            [
                'id' => 7,
                'title' => 'Cavalier',
                'price'=> 280000,
                'image'=>'sap7.jpg'
            ],
            [
                'id' => 8,
                'title' => 'Reuzel',
                'price'=> 290000,
                'image'=>'sap8.jpg'
            ],
            [
                'id' => 9,
                'title' => 'Romano Wax',
                'price'=> 480000,
                'image'=>'sap9.jpg'
            ],
        ]);
    }
}
