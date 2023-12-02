<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateViewsaleschartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<'SQL'
            CREATE VIEW viewsaleschart AS
            SELECT YEAR(`a`.`created_at`) AS `Years`, MONTH(`a`.`created_at`) AS `Months`, SUM(`a`.`amount`) AS `totalsales`
            FROM `booking` `a`
            WHERE (`a`.`bookingstatus` = 4)
            GROUP BY MONTH(`a`.`created_at`);
        SQL;

        DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('viewsaleschart');
    }
}
