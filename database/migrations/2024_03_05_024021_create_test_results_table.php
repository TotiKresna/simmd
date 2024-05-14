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
        Schema::table('test_results', function (Blueprint $table) {
            // $table->id();
            // $table->foreignId('student_id')->constrained()->onDelete('cascade');
            // $table->foreignId('student_nama')->constrained()->onDelete('cascade');
            // $table->foreignId('student_kelas')->constrained()->onDelete('cascade');
            // $table->integer('opm_tambah');
            // $table->integer('opm_kurang');
            // $table->integer('opm_kali');
            // $table->integer('opm_bagi');
            // $table->timestamps();
            $table->decimal('opm_total', 10, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_results');
    }
};
