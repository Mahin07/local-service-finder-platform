<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreignId('provider_service_id')
                ->nullable()
                ->after('provider_id')
                ->constrained('provider_services')
                ->nullOnDelete();
            $table->string('customer_phone')->nullable()->after('booking_date');
            $table->text('customer_address')->nullable()->after('customer_phone');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropConstrainedForeignId('provider_service_id');
            $table->dropColumn(['customer_phone', 'customer_address']);
        });
    }
};
