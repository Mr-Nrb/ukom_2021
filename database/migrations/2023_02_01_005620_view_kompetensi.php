<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{

    public function up()
    {
        DB::unprepared("
        CREATE OR REPLACE VIEW view_kompetensi  AS 
        SELECT 
                jurusan.nama_jurusan, 
                jurusan.id_jurusan, 
                kompetensi.id_kompetensi, 
                kompetensi.nama_kompetensi

        FROM kompetensi
        
        INNER JOIN jurusan ON kompetensi.id_jurusan = jurusan.id_jurusan;
      
    ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
