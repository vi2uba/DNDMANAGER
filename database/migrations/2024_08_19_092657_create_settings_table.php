<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->text('value');
            $table->timestamps();
        });

        //Insert default settings
        $settings = [
            ['key' => 'site_name', 'value' => 'Laravel Hotel'],
            ['key' => 'site_description', 'value' => 'Laravel Hotel - Best Hotel in Town'],
            ['key' => 'contact_email', 'value' => 'laravel@gmail.com'],
            ['key' => 'paypal_service_fee', 'value' => 5],
            ['key' => 'paymongo_service_fee', 'value' => 5],
        ];
        DB::table('settings')->insert($settings);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
