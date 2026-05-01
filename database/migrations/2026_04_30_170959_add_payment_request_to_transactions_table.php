<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Track which inquiry originated the payment request
            $table->foreignId('inquiry_id')->nullable()->change();
            // Note sent by seller to buyer (e.g. "Here's your 10% discount!")
            $table->text('seller_note')->nullable()->after('amount');
            // Whether the buyer has confirmed the payment request
            // STATUS_PENDING = seller sent, buyer hasn't confirmed
            // STATUS_COMPLETED = buyer confirmed
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('seller_note');
        });
    }
};
