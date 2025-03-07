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
        Schema::create('characters', function (Blueprint $table) {
            //
            $table->id();
            $table->foreignId('campaign_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('race');
            $table->string('class');

            //Hit Points
            $table->integer('current_hit_points')->default(10);
            $table->integer('temporary_hit_points')->default(0);

            //Mana Points
            $table->integer('current_mana_points')->default(10);
            $table->integer('temporary_mana_points')->default(0);

            //Stamina Points
            $table->integer('current_stamina_points')->default(10);
            $table->integer('temporary_stamina_points')->default(0);


            //XP and Level
            $table->integer('experience_points')->default(0);
            $table->integer('level')->default(1);

            //Stats
            $table->integer('strength')->default(10);
            $table->integer('dexterity')->default(10);
            $table->integer('constitution')->default(10);
            $table->integer('intelligence')->default(10);
            $table->integer('wisdom')->default(10);
            $table->integer('charisma')->default(10);

            //Misc
            $table->integer('armor_class')->default(10);
            $table->integer('initiative')->default(0);
            $table->integer('speed')->default(30);
            $table->integer('hit_dice')->default(1);
            $table->integer('proficiency_bonus')->default(2);

            //User that created/owns this character
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
