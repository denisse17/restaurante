<?php

use Illuminate\Database\Seeder;
//use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Producto;



class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        for ($i = 1; $i <= 10; $i++) {
            Producto::create([
                'nombre' => 'sandwich numero ' . $i,
                'ficha' => 'sandwich-' . $i,
                'precio' => rand(29, 49),
                'descripcion' => 'Lorem ' . $i . ' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
                'imagen' => 'http://bk-latam-prod.s3.amazonaws.com/sites/burgerking.com.pe/files/Crispy_300x270px.png',
                'created_at'=> new DateTime(),
                'updated_at'=> new DateTime(),
                ])->categorias()->attach(1);
        }
        $producto = Producto::find(1);
        $producto->categorias()->attach(2);

        for ($i = 1; $i <= 10; $i++) {
            Producto::create([
                'nombre' => 'bebida ' . $i,
                'ficha' => 'bebida-' . $i,
                'precio' => rand(24, 44),
                'descripcion' => 'Lorem ' . $i . ' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
                'imagen' => 'https://www.ecestaticos.com/imagestatic/clipping/705/3af/7053aff26af686108053e6b1957f22ca/las-bebidas-perfectas-para-tomar-por-la-noche.jpg',
                'created_at'=> new DateTime(),
                'updated_at'=> new DateTime(),
                ])->categorias()->attach(2);
        }
        for ($i = 1; $i <= 10; $i++) {
            Producto::create([
                'nombre' => 'postre numero ' . $i,
                'ficha' => 'postre-' . $i,
                'precio' => rand(19, 44),
                'descripcion' => 'Lorem ' . $i . ' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
                'imagen' => 'https://maquisur.net/tienda/wp-content/uploads/2018/01/helados.png',
                'created_at'=> new DateTime(),
                'updated_at'=> new DateTime(),
                ])->categorias()->attach(3);
        }


     /*   $data= array(
            [

            'nombre'=> 'sandwich de palta',
            'descripcion'=> str_random(50),
            'precio'=> 10.00,
            'imagen'=>'http://bk-latam-prod.s3.amazonaws.com/sites/burgerking.com.pe/files/Crispy_300x270px.png',
            'visible'=> 1,
            'categorias_id'=> 1,
            'created_at'=> new DateTime(),
            'updated_at'=> new DateTime(),

             ],
             [
                'nombre'=> 'sandwich de pollo',
            'descripcion'=> 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed aperiam unde dolorem, adipisci veritatis ipsa!',
            'precio'=> 12.00,
            'imagen'=>'http://bk-latam-prod.s3.amazonaws.com/sites/burgerking.com.pe/files/Crispy_300x270px.png',
            'visible'=> 1,
            'categorias_id'=> 1,
            'created_at'=> new DateTime(),
            'updated_at'=> new DateTime(),
            ]
        );*/

        //productos::insert($data);
       /* DB::table('users')->insert([
            'name' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
        ]);*/
    }
}