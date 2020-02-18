<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraineeInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainee_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('internship_status',['Fail','Stop','Continue']);
            $table->string('position');
            $table->string('address');
            $table->enum('sex',['Male','Female']);
            $table->enum('martial_status',['Single','Married']);
            $table->float('height');
            $table->string('nationality');
            $table->date('dob');
            $table->string('hobbies')->nullable();
            $table->string('place_of_birth');
            $table->string('reference_name');
            $table->string('reference_position');
            $table->string('reference_phone');
            $table->string('reference_email');
            $table->bigInteger('user_id');
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
        Schema::dropIfExists('trainee_infos');
    }
}
