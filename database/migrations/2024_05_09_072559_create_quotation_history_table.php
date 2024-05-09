<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationHistoryTable extends Migration
{
    public function up()
    {
        Schema::create('quotation_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('action');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quotation_history');
    }
}
