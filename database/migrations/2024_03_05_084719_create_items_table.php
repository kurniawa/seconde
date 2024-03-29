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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null')->onUpdate('cascade'); // tiap item pasti dimiliki oleh satu user
            $table->string('nama',255);
            $table->string('deskripsi', 1000)->nullable(); // tiap item memiliki deskripsi dan dapat juga dikosongkan
            $table->bigInteger('harga')->default(0); // tiap item memiliki deskripsi dan dapat juga dikosongkan
            $table->string('status', 20)->default('ready'); // ready, open or sold
            $table->string('buyer', 50)->nullable(); // tiap item dapat diambil oleh satu orang
            $table->foreignId('buyer_id')->nullable()->references('id')->on('users')->constrained()->onDelete('set null'); // tiap item dapat diambil oleh satu orang
            $table->string('keterangan', 200)->nullable(); // semisal ada keterangan yang perlu di notice, maka dicatat pada kolom ini.
            $table->boolean('sold')->default(false); // sinonimnya jadi tinyint
            $table->boolean('hide')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
