<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_items', function (Blueprint $table) {
            $table->increments('id');
            $table-> decimal('precio',5,2);
            $table->integer('cantidad')->unsigned();
            $table->integer('producto_id')->unsigned();
            $table->foreign('producto_id')
                  ->references('id')
                  ->on('productos')
                  ->onDelete('cascade');
            $table->integer('pedido_id')->unsigned();
            $table->foreign('pedido_id')
                  ->references('id')
                  ->on('pedidos')
                  ->onDelete('cascade');
           // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedido_items');
    }
}
