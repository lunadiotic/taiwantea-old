<?php

use Illuminate\Database\Seeder;

class HotOffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hot_offer = [
            'image' => 'images/1/hot_offers/300x300.png',
            'status' => '1'
        ];

        DB::table('hot_offers')->insert($hot_offer);
    }
}
