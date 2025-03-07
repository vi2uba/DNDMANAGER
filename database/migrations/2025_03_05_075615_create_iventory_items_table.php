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
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            // Item type (food, potion, weapon, armor, etc)
            $table->string('type');
            $table->string('image_path');
            $table->enum('rarity', ['Common', 'Uncommon', 'Rare', 'Very Rare', 'Legendary', 'Artifact']);
            $table->enum('tier', ['Tier 1', 'Tier 2', 'Tier 3', 'Tier 4']);
            $table->string('slot');
            $table->string('material');
            $table->string('weight');
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->integer('quantity');
            // Foreign key to the character that owns this item
            $table->foreignId('character_id')->constrained()->onDelete('cascade');
            $table->foreignId('campaign_id')->constrained()->onDelete('cascade');

            // What stats does this item modify?
            $table->integer('strength')->default(0);
            $table->integer('dexterity')->default(0);
            $table->integer('constitution')->default(0);
            $table->integer('intelligence')->default(0);
            $table->integer('wisdom')->default(0);
            $table->integer('charisma')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iventory_items');
    }
};
