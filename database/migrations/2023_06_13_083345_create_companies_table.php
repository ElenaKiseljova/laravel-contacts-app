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
    Schema::create('companies', function (Blueprint $table) {
      $table->id(); // id() is alias for unsignedBigInteger() or UNSIGNED BIG INTEGER PRIMARY KEY AUTO_INCREMENT
      $table->string('name');
      $table->string('address')->nullable();
      $table->string('website')->nullable();
      $table->string('email')->comment('Email of the company');
      $table->timestamps(); // created_at, updated_at or TIMESTAMP
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('companies');
  }
};
