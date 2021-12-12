<?php

namespace Database\Seeders;

use App\Models\ContactItem;
use Illuminate\Database\Seeder;

class ContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactItem::factory()->count(5)->create();
    }
}
