<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendorData = [
            'banner' => 'admin_banner.jpeg',
            'phone' => '077367823',
            'email' => 'testemail@gmail.com',
            'status' => 1,
            'address' => 'address_value',
            'description' => 'description_value',
            'shop_name' => 'shop_name_value',
            'user_id' => 1,
            'fb_link' => 'http://localhost:8000/',
            'insta_link' => 'http://localhost:8000/',
            'tw_link' => 'http://localhost:8000/',
        ];
        Vendor::create($vendorData);
    }
}
