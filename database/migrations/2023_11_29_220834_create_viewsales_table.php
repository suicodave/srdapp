<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateViewsalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<'SQL'
            CREATE VIEW viewsales AS
            SELECT `a`.`bookingid` AS `bookingid`,`b`.`branchcode` AS `branchcode`,`f`.`branch_name` AS `branch_name`,`d`.`id` AS `vehicleid`,`d`.`vehicletype` AS `vehicletype`,`e`.`servicesname` AS `servicesname`,`b`.`numbervehicle` AS `numbervehicle`,`e`.`price` AS `price`,`b`.`bookingnumber` AS `bookingnumber`,`a`.`salesdate` AS `salesdate`,`a`.`tnxtype` AS `tnxtype`,`a`.`actiontakenby` AS `actiontakenby`,`a`.`amountdue` AS `amountdue`,`a`.`cashier` AS `cashier`,`a`.`invoicenumber` AS `invoicenumber`,`a`.`ispaid` AS `ispaid`,`a`.`status` AS `status`,`c`.`statusname` AS `statusname`
            FROM (((((`srdsales` `a`
            LEFT JOIN `booking` `b` ON((`a`.`bookingid` = `b`.`id`)))
            LEFT JOIN `status` `c` ON((`a`.`status` = `c`.`statusid`)))
            LEFT JOIN `classification_services` `d` ON((`d`.`id` = `b`.`classid`)))
            LEFT JOIN `srdservices` `e` ON((`e`.`sid` = `b`.`servicesid`)))
            LEFT JOIN `srdbranch` `f` ON((`b`.`branchcode` = `f`.`id`)));
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
        Schema::dropIfExists('viewsales');
    }
}
