<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Initalization extends Migration
{
    public function up()
    {
        Schema ::create('clients', function (Blueprint $table) {
            $table ->increments('id');
            $table ->string('name');
            $table ->string('rut');
            $table ->string('correlative');
            $table ->string('reference');
            $table ->date('fecha');
            $table ->integer('costo');
            $table ->integer('area');
            $table ->integer('monto');
            $table ->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });

        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('iva', 10,2);
            $table->decimal('subTotal', 10,2);
            $table->decimal('total', 10,2);
            $table->timestamps();
        });

        Schema::create('invoice_items', function (Blueprint $table) {
            $table->decimal('quantity', 10,2);
            $table->decimal('unitPrice', 10,2);
            $table->decimal('total', 10,2);
            $table->timestamps();
        });

        // Foreign keys
        Schema::table('invoices', function ($table) {
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients');
        });

        Schema::table('invoice_items', function ($table) {
            $table->integer('invoice_id')->unsigned();
            $table->integer('product_id')->unsigned();

            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->foreign('product_id')->references('id')->on('products');
        });

        // Default data
        DB ::table('clients') -> insert([
            ['name' => 'Eduardo Rodriguez', 'rut' => '123-4', 'correlative' => '1', 'reference' => 'Caja Chica 1',
                'fecha' => '2019/7/11', 'costo' => '123', 'area' => '123', 'monto' => '123'],
            ['name' => 'Juan Perez', 'rut' => '234-5', 'correlative' => '2', 'reference' => 'Caja Chica 2',
                'fecha' => '2019/7/11', 'costo' => '123', 'area' => '123', 'monto' => '123'],
        ]);

        DB::table('products')->insert([
            ['name' => 'Guitarra eléctrica Fender', 'price' => 1000.50],
            ['name' => 'Amplicador Marshal JCM 2000', 'price' => 2000],
        ]);
    }

    public function down()
    {

    }
}
