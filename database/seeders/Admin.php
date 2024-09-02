<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users=[ ['name'=>'Bappi_08',
                'email'=>'asifbappy.bd@gmail.com',
                'password'=>bcrypt('assassin08'),
                'user_type'=>'user'
    ],
            [   'name'=>'Admin',
                'email'=>'admin@gmail.com',
                'password'=>bcrypt('assassin08'),
                'user_type'=>'admin'
            ]
        ];
        foreach($users as $user){
            $aaa=new User;
            $aaa->name=$user['name'];
            $aaa->email=$user['email'];
            $aaa->password=$user['password'];
            $aaa->user_type=$user['user_type'];
            $aaa->save();
        }
    }
}
