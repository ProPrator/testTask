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
        Schema::create('prizes', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('status');
            $table->foreignIdFor(\App\Models\User::class);
            $table->foreignIdFor(\App\Models\Money::class)->nullable();
            $table->foreignIdFor(\App\Models\Bonus::class)->nullable();
            $table->foreignIdFor(\App\Models\Item::class)->nullable();
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
        Schema::dropIfExists('prizes');
    }
};
