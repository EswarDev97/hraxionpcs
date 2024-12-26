<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('financial_requests', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('requester_id');
        $table->unsignedBigInteger('approval_to_id');
        $table->string('request_name');
        $table->text('request_description');
        $table->string('priority');
        $table->string('status');
        $table->decimal('amount', 10, 2);
        $table->date('expected_date');
        $table->string('upload_document')->nullable();
        $table->decimal('paid_amount', 10, 2)->nullable();
        $table->date('paid_on_date')->nullable();
        $table->text('payment_details')->nullable();
        $table->timestamps();

        $table->foreign('requester_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('approval_to_id')->references('id')->on('users')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financial_requests');
    }
}
