<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1494477814AppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('appointments')) {
            Schema::create('appointments', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('client_id')->unsigned()->nullable();
                $table->foreign('client_id', '35989_5913ebf64ed0b')->references('id')->on('clients')->onDelete('cascade');
                $table->integer('employee_id')->unsigned()->nullable();
                $table->foreign('employee_id', '35989_5913ebf652b9b')->references('id')->on('employees')->onDelete('cascade');
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '35787_5913ebf652b9b')->references('id')->on('users')->onDelete('cascade');
                $table->time('start_time')->nullable();
                $table->date('date')->nullable();
                $table->text('comments')->nullable();
                $table->integer('status')->unsigned()->nullable()->comment = "Default=0, Approve=1,Reject = 2 ";
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
