<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::create([
            "name" => 'adit',
            'email' => 'alditsri1234@gmail.com',
            'business_unit_id' => 1,
            'role_id' => 1,
            'password' => bcrypt('password')
        ]);
        \App\Models\User::create([
            "name" => 'leo',
            'email' => 'lechan2001@gmail.com',
            'business_unit_id' => 1,
            'role_id' => 1,
            'password' => bcrypt('password')
        ]);
        \App\Models\User::create([
            "name" => 'ruben',
            'email' => 'rubbento88@gmail.com',
            'business_unit_id' => 1,
            'role_id' => 2,
            'password' => bcrypt('password')
        ]);
        \App\Models\User::create([
            "name" => 'foo',
            'email' => 'foo@gmail.com',
            'business_unit_id' => 1,
            'role_id' => 3,
            'password' => bcrypt('password')
        ]);
        \App\Models\User::create([
            "name" => 'fii',
            'email' => 'fii@gmail.com',
            'business_unit_id' => 2,
            'role_id' => 3,
            'password' => bcrypt('password')
        ]);

        \App\Models\BusinessUnit::create([
            'name'=>'DTR'
        ]);
        \App\Models\BusinessUnit::create([
            'name'=>'MTR'
        ]);
        \App\Models\BusinessUnit::create([
            'name'=>'ICT'
        ]);
        \App\Models\BusinessUnit::create([
            'name'=>'PTR'
        ]);
        \App\Models\BusinessUnit::create([
            'name'=>'MEC'
        ]);
        \App\Models\BusinessUnit::create([
            'name'=>'Insulation'
        ]);
        \App\Models\ApplicationType::create([
            'name'=>'Perluasan Type Test & SPM'
        ]);

        \App\Models\ApplicationType::create([
            'name'=>'Perpanjangan Type Test'
        ]);
        \App\Models\ApplicationType::create([
            'name'=>'Perpanjangan SPM'
        ]);

        \App\Models\ProductType::create([
            'name' => 'Distribution Transformer'
        ]);
        \App\Models\ProductType::create([
            'name' => 'Medium Transformer'
        ]);
        \App\Models\ProductType::create([
            'name' => 'Current Transformer'
        ]);
        \App\Models\ProductType::create([
            'name' => 'Voltage Transformer'
        ]);
        \App\Models\ProductType::create([
            'name' => 'Power Transformer'
        ]);
        \App\Models\ProductType::create([
            'name' => 'PHBTR'
        ]);
        \App\Models\ProductType::create([
            'name' => 'APP'
        ]);
        \App\Models\ProductType::create([
            'name' => 'SPKLU'
        ]);
        \App\Models\ProductType::create([
            'name' => 'OTHER'
        ]);

        \App\Models\ProductTypeCategory::create([
            'name' => 'Langsung',
        ]);
        \App\Models\ProductTypeCategory::create([
            'name' => 'Tidak Langsung',
        ]);
        \App\Models\ProductTypeCategory::create([
            'name' => 'Oil',
        ]);

        \App\Models\ProductTypeCategory::create([
            'name' => 'Dry Type',
        ]);

        \App\Models\ProductTypeCategory::create([
            'name' => 'Indoor',
        ]);

        \App\Models\ProductTypeCategory::create([
            'name' => 'Outdoor',
        ]);

        \App\Models\ProductTypeCategory::create([
            'name' => 'Ring',
        ]);

        \App\Models\Process::create([
            'name' => 'collecting document'
        ]);
        \App\Models\Process::create([
            'name' => 'submit document to pln'
        ]);
        \App\Models\Process::create([
            'name' => 'fullfillment incomplete document'
        ]);
        \App\Models\Process::create([
            'name' => 'assesment payment'
        ]);
        \App\Models\Process::create([
            'name' => 'assesment process'
        ]);
        \App\Models\Process::create([
            'name' => 'type test payment'
        ]);
        \App\Models\Process::create([
            'name' => 'type test released'
        ]);
        \App\Models\Process::create([
            'name' => 'spm payment'
        ]);
        \App\Models\Process::create([
            'name' => 'spm released'
        ]);

        
        \App\Models\Role::create([
            'name' => 'admin'
        ]);
        \App\Models\Role::create([
            'name' => 'pic_super'
        ]);
        \App\Models\Role::create([
            'name' => 'pic'
        ]);
        \App\Models\Role::create([
            'name' => 'user'
        ]);

        
        $app = \App\Models\ProductType::find(7);
        $distribution = \App\Models\ProductType::find(1);
        $medium = \App\Models\ProductType::find(2);
        $current = \App\Models\ProductType::find(3);
        $voltage = \App\Models\ProductType::find(4);

        $app->productTypeCategories()->attach([1,2]);
        $distribution->productTypeCategories()->attach([3,4]);
        $medium->productTypeCategories()->attach([3,4]);
        $current->productTypeCategories()->attach([5,6,7]);
        $voltage->productTypeCategories()->attach([5,6,7]);
    }
}
