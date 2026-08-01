<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->index(['status', 'name'], 'categories_status_name_index');
        });

        Schema::table('providers', function (Blueprint $table) {
            $table->index(['status', 'created_at'], 'providers_status_created_at_index');
        });

        Schema::table('provider_services', function (Blueprint $table) {
            $table->index(['is_active', 'created_at'], 'provider_services_active_created_at_index');
            $table->index(['provider_id', 'is_active'], 'provider_services_provider_active_index');
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->index(['provider_id', 'status', 'created_at'], 'bookings_provider_status_created_at_index');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropIndex('bookings_provider_status_created_at_index');
        });

        Schema::table('provider_services', function (Blueprint $table) {
            $table->dropIndex('provider_services_active_created_at_index');
            $table->dropIndex('provider_services_provider_active_index');
        });

        Schema::table('providers', function (Blueprint $table) {
            $table->dropIndex('providers_status_created_at_index');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex('categories_status_name_index');
        });
    }
};
