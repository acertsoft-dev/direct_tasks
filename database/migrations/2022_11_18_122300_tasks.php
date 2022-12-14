<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function(Blueprint $table){
            $table->id('id');
            $table->string('status');
            $table->string('service');
            $table->date('date_registration');
            $table->date('date_start');
            $table->date('date_limit');
            $table->foreignId('id_user')->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('id_project')->constrained('projects')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('id_version')->constrained('versions_projects')->onUpdate('cascade')->onDelete('restrict');
            $table->text('description')->nullable();
            $table->text('solution')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
