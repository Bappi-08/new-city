<?php

namespace Database\Seeders;

use App\Models\Building_Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class building__categories_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[ ['building_type'=>'Mess'],
                ['building_type'=>'Resident']
        ];
        foreach($data as $d){
            $category=new Building_Category;
            $category->building_type=$d['building_type'];
            $category->save();
        }
    }
}
