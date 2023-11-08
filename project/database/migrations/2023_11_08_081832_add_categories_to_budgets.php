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
    public function up()
{
    Schema::table('budgets', function (Blueprint $table) {
        $table->json('categories')->nullable(); 
    });
}

public function down()
{
    Schema::table('budgets', function (Blueprint $table) {
        $table->dropColumn('categories');
    });
}

};
