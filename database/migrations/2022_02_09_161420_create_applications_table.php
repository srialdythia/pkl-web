<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('application_no')->unique();
            $table->foreignId('product_type_id');
            $table->foreignId('application_type_id');
            $table->foreignId('product_type_category_id')->nullable();
            $table->foreignId('business_unit_id');
            $table->date('application_date_created');
            $table->string('requestor_name');
            $table->boolean('status')->default(1);
            $table->date('document_due_date')->nullable();
            $table->string('closed_by')->nullable();
            $table->timestamp('closed_date')->nullable();
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
        Schema::dropIfExists('applications');
    }
};
