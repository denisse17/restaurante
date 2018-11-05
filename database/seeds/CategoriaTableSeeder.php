<?php

use Illuminate\Database\Seeder;
//use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Categoria;



class CategoriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data= array(
            [
                'nombre'=> 'Hamburguesas',
                'ficha'=>'hamburguesas',
                'descripcion'=> str_random(50),
                'color'=> '#00ffff'
            ],
            [
                'nombre'=> 'Bebidas',
                'ficha'=>'bebidas',
                'descripcion'=> str_random(50),
                'color'=> '#00ffff'
            ],
            [
                'nombre'=> 'Postres',
                'ficha'=>'postres',
                'descripcion'=> str_random(50),
                'color'=> '#00ffff'
            ],
        );

        categoria::insert($data);
       /* DB::table('users')->insert([
            'name' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
        ]);*/
    }
}