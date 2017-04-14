<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('addr_id');
            $table->string('addr_first_name', 50)->nullable();
            $table->string('addr_last_name', 50)->nullable();
            $table->string('addr_city', 50)->nullable();
            $table->string('addr_region', 50)->nullable();
            $table->string('addr_email_1', 128)->nullable();
            $table->string('addr_email_2', 128)->nullable();
            $table->string('addr_phone_1', 254)->nullable();
            $table->string('addr_phone_2', 254)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
