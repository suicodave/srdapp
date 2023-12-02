<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateViewpendingforpaymentView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<'SQL'
            CREATE VIEW viewpendingforpayment AS
            SELECT `a`.`salesid` AS `salesid`,`b`.`bookingnumber` AS `bookingnumber`,`b`.`fullName` AS `clients`,`d`.`vehicletype` AS `vehicletype`,`e`.`servicesname` AS `servicesname`,`g`.`branch_name` AS `branch_name`,`b`.`washDate` AS `washDate`,`b`.`washTime` AS `washTime`,`a`.`created_at` AS `postingdate`,`a`.`status` AS `status`
            FROM ((((((`srdsales` `a`
            LEFT JOIN `booking` `b` ON((`a`.`bookingid` = `b`.`id`)))
            LEFT JOIN `bookingpriority` `c` ON((`a`.`bpid` = `c`.`pid`)))
            LEFT JOIN `classification_services` `d` ON((`b`.`classid` = `d`.`id`)))
            LEFT JOIN `srdservices` `e` ON((`b`.`servicesid` = `e`.`sid`)))
            LEFT JOIN `status` `f` ON((`b`.`bookingstatus` = `f`.`statusid`)))
            LEFT JOIN `srdbranch` `g` ON((`b`.`branchcode` = `g`.`id`)))
            WHERE (`a`.`status` = 'Pending for Payment');
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
        Schema::dropIfExists('viewpendingforpayment_view');
    }
}
