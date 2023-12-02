<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateViewpendingforpaymentTmpView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<'SQL'
            CREATE VIEW viewpendingforpayment_tmp AS
            SELECT `a`.`salesid` AS `salesid`,`b`.`id` AS `bookingid`,`b`.`bookingnumber` AS `bookingnumber`,`e`.`price` AS `price`,`b`.`fullName` AS `clients`,`c`.`maker` AS `performedby`,`d`.`vehicletype` AS `vehicletype`,`e`.`servicesname` AS `servicesname`,`g`.`branch_name` AS `branch_name`,`b`.`washDate` AS `washDate`,`b`.`washTime` AS `washTime`,`a`.`updated_at` AS `postingdate`,`a`.`status` AS `status`
            FROM (((((((`pendingforpayment_tmp` `x`
            LEFT JOIN `srdsales` `a` ON((`x`.`salesid` = `a`.`salesid`)))
            LEFT JOIN `booking` `b` ON((`a`.`bookingid` = `b`.`id`)))
            LEFT JOIN `bookingpriority` `c` ON((`a`.`bpid` = `c`.`pid`)))
            LEFT JOIN `classification_services` `d` ON((`b`.`classid` = `d`.`id`)))
            LEFT JOIN `srdservices` `e` ON((`b`.`servicesid` = `e`.`sid`)))
            LEFT JOIN `status` `f` ON((`b`.`bookingstatus` = `f`.`statusid`)))
            LEFT JOIN `srdbranch` `g` ON((`b`.`branchcode` = `g`.`id`)))
            WHERE (`a`.`status` LIKE '%Pending for Payment%');
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
        Schema::dropIfExists('viewpendingforpayment_tmp_view');
    }
}
