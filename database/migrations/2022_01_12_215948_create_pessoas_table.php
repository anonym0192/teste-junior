<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePessoasTable.
 */
class CreatePessoasTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pessoas', function(Blueprint $table) {
            $table->increments('id');
            $table->text('nome');
            $table->text('sobrenome');
            $table->string('cpf', 11);
            $table->string('celular', 20);
            $table->longText('logradouro');
            $table->string('cep', 20);

            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pessoas');
	}
}
