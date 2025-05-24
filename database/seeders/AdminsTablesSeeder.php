<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class AdminsTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->updateOrInsert(
            ['email' => 'admin@admin.com'], // Unique key
            [ // Updated data
                'name' => 'Laban',
                'mobile' => '0737955021',
                'status' => 1,
                'type' => 'superadmin',
                'vendor_id' => 0,
                'image' => '',
                'password' => bcrypt('1234'),
            ]
        );
        
    }
}
