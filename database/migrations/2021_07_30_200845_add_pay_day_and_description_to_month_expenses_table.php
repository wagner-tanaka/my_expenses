<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPayDayAndDescriptionToMonthExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('month_expenses', function (Blueprint $table) {
            $table->string('pay_day')->nullable() ;
            $table->string('description')->nullable() ;

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('month_expenses', function (Blueprint $table) {
            $table->dropColumn(['pay_day', 'description']);
        });
    }
}
