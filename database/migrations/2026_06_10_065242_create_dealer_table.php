<?php

use App\Models\City;
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
        Schema::create('dealers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(City::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('address');
            $table->double('latitude',8, 6);
            $table->double('longitude',8, 6);
            $table->string('name',50);
            $table->string('contact',50);
            $table->string('phone');
            $table->string('mail');
            $table->string('site',100)->nullable();
            $table->string('note',100)->nullable();
            $table->tinyInteger('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dealers');
    }
};
