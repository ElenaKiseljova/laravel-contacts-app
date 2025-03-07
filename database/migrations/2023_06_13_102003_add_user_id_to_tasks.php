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
    Schema::table('tasks', function (Blueprint $table) {
      // 1
      // $table->unsignedBigInteger('user_id')->after('id');
      // $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
      // ->onUpdate('cascade')->onDelete('cascade')
      // ->onUpdate('cascade')->onDelete('cascade')
      // ->onUpdate('restrict')->onDelete('restrict')
      // ->onUpdate('cascade')->onDelete('set null')

      // 2
      $table->foreignId('user_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('tasks', function (Blueprint $table) {
      // $table->dropForeign('tasks_user_id_foreign');
      $table->dropForeign(['user_id']);
      $table->dropColumn('user_id');
    });
  }
};
