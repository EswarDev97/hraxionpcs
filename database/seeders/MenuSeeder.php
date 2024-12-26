<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = ['dashboard', 'data', 'performance', 'leave-request', 'attendances', 'announcements', 'recruitments', 'score-category', 'logs',  'accounts', 'user','tasks','financial-request'];

        foreach($menus as $menu) {
            Menu::firstOrCreate(['name' => $menu]);
        }
    }
} 
