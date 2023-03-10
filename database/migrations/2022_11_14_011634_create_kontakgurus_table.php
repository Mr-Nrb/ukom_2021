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
    
    //menentukan nama tabel
    protected $table;
    function __construct()
    {
        $this->table = 'kontak_guru';
    }

    //menentukan isi tabel
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->tinyInteger('id_guru')->length(4)->nullable(false);
            $table->string('kontak',17)->nullable(false);

            $table->foreign('id_guru')->references('id_guru')->on('guru')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    
     // kalo sudah ada akan didrop
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
};