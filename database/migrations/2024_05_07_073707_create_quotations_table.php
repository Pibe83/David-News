<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationsTable extends Migration
{
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->decimal('total_price', 7, 2);
            $table->decimal('taxable_price', 7, 2)->default(0);
            $table->decimal('tax_price', 7, 2)->default(0);
            $table->boolean('is_editable')->default(true);

            $table->foreignId('user_id')->default(0)->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quotations');
    }
}
