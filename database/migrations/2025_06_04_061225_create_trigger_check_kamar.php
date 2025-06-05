<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Contoh trigger: sebelum insert ke tabel reservasi, cek apakah kamar tersedia
        DB::unprepared('
            CREATE TRIGGER cek_status_kamar_sebelum_booking
            BEFORE INSERT ON reservasis
            FOR EACH ROW
            BEGIN
                DECLARE status_kamar VARCHAR(20);

                SELECT status INTO status_kamar FROM kamars WHERE id = NEW.kamar_id;

                IF status_kamar = "tidak tersedia" THEN
                    SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "Kamar tidak tersedia untuk dipesan.";
                END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trigger_check_kamar');
    }
};
