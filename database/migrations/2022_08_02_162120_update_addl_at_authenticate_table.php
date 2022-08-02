<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAddlAtAuthenticateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('Authenticates');
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
       Schema::drop('Authenticates');
    
    }
}
