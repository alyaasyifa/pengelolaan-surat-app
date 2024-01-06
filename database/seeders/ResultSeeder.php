<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Result::create([
            'letter_id' => 1,
            'notes' => 'Apa aja oke oke oke oke kanjud',
            'presence_recipients' => 'Alisah'
        ]);
    }
}
