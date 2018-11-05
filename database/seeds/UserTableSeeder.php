<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=array(
            [
            'nombres'=> 'Denisse',
            'apellidos'=> 'Karen',
            'email'=> 'ejemplo@ejemplo.com',
            'user'=> 'admin',
            'password'=> \Hash::make('admin'),
            'type'=> 'admin',
            'active'=> 1,
            'direccion'=> 'Mariano Melgar',
            'created_at'=> new Datetime(),
            'updated_at'=> new Datetime()
            ],
            [
                'nombres'=> 'Maria',
                'apellidos'=> 'Barrios',
                'email'=> 'user@ejemplo.com',
                'user'=> 'user',
                'password'=> \Hash::make('user'),
                'type'=> 'user',
                'active'=> 1,
                'direccion'=> 'Socabaya',
                'created_at'=> new Datetime(),
                'updated_at'=> new Datetime()
    
            ]
            );
            User::insert($data);
    }
}
