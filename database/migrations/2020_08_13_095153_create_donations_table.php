<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->foreignId('service_id')->nullable()->constrained();
            $table->foreignId('location_id')->nullable()->constrained();

            $table->enum('status', ['initiated', 'incomplete', 'assigned', 'completed', 'done', 'pending'])->default('incomplete');
            $table->enum('type', ['blood', 'organ', 'funds']);
            $table->text('value');
            $table->text('value_type');
            $table->text('description')->nullable();
            $table->date('date_needed');
            $table->integer('cost')->nullable();
            $table->integer('quantity')->unsigned()->default(1);
            $table->enum('payment_status', ['free', 'charged']);
            $table->string('payment_method', 100)->nullable();
            $table->string('hospital_name', 255);
            $table->string('hospital_location', 255);
            $table->boolean('share_location')->nullable()->default(false);

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
        Schema::dropIfExists('donations');
    }
}
