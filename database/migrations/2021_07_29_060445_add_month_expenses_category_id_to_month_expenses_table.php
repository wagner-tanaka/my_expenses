<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMonthExpensesCategoryIdToMonthExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('month_expenses', function (Blueprint $table) {
            $table->foreignId('month_expenses_category_id')->constrained()->onDelete('cascade');
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
            $table->dropColumn('month_expenses_category_id');
        });
    }
}
