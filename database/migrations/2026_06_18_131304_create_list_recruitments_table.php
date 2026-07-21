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
        Schema::create('list_recruitments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recruitments_id')->nullable()->constrained('recruitments')->cascadeOnUpdate()->nullOnDelete();
            $table->dateTime('day')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->date('birthday')->nullable();
            $table->unsignedTinyInteger('interview')->default(0)->comment('0:có , 1 :khong');
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();
            $table->unsignedTinyInteger('result')->default(0)->comment('0:đạt , 1:không đạt');
            $table->dateTime('day_work')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_recruitments');
    }
};
