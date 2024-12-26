<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddManagerIdToEmployeesTable extends Migration
{
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            // Add manager_id column after the id column
            $table->unsignedBigInteger('manager_id')->nullable()->after('id');
            
            // Define foreign key constraint
            $table->foreign('manager_id')
                ->references('id')
                ->on('employees')
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            // Drop foreign key constraint first
            $table->dropForeign(['manager_id']);
            
            // Drop manager_id column
            $table->dropColumn('manager_id');
        });
    }
}
