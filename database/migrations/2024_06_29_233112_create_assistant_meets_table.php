<?php

use App\Models\Assistant;
use App\Models\Meet;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assistant_meets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Assistant::class);
            $table->foreignIdFor(Meet::class);
            $table->integer('slot_used');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assistant_meets');
    }
};
