<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsFixedAndMonthEarningsCategoryIdAndReceivedDayAndDescriptionToMonthEarningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('month_earnings', function (Blueprint $table) {
            $table->boolean('is_fixed')->default(0);
            $table->foreignId('month_earnings_category_id')->constrained()->onDelete('cascade');
            $table->string('received_day')->nullable() ;
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
        Schema::table('month_earnings', function (Blueprint $table) {
            $table->dropColumn(['is_fixed', 'month_earnings_category_id','received_day','description']);
        });
    }
}
