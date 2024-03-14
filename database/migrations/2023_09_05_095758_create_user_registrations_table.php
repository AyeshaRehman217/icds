<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('qualification');
            $table->string('title');
            $table->string('contact_no');
            $table->string('voucher_upload')->nullable();
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('session_id')->nullable();
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('payment_type_id')->nullable();
            $table->foreign('payment_type_id')->references('id')->on('payment_types')->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('submission_type_id')->nullable();
            $table->foreign('submission_type_id')->references('id')->on('onsite_submission_types')->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('registration_type_id')->nullable();
            $table->foreign('registration_type_id')->references('id')->on('registration_types')->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('registration_status_id')->nullable();
            $table->foreign('registration_status_id')->references('id')->on('registration_statuses')->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('deleted_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_registrations');
    }
};
