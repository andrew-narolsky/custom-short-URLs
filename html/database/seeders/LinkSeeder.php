<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('links')->insert([
            [
                'link' => 'youtube.com/channel/UCHK4HD0ltu1-I212icLPt3g',
                'short_link' => 'https://rb.gy/hxgetw',
            ],
            [
                'link' => 'youtube.com/channel/UCAK4GdcCGHomctHedQNaYQw',
                'short_link' => 'https://rb.gy/3f0i4q',
            ],
        ]);
    }
}
