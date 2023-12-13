<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateViewbookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<'SQL'
        CREATE VIEW viewbookiing AS
        SELECT f.name as `detailer`, `a`.`branchcode` AS `branchcode`,`b`.`branch_name` AS `branch_name`,`a`.`bookingnumber` AS `bookingnumber`,
        `a`.`bookingstatus` AS `bookingstatus`,`e`.`statusname` AS `statusname`,`a`.`fullName` AS `fullName`,
        `a`.`mobileNumber` AS `mobileNumber`,`a`.`washDate` AS `washDate`,`a`.`washTime` AS `washTime`,
        `a`.`email` AS `email`,`a`.`txnNumber` AS `txnNumber`,`a`.`postingDate` AS `postingDate`,`a`.`amount` AS `amount`,
        `a`.`paymentMode` AS `paymentMode`,`a`.`classid` AS `classid`,`c`.`vehicletype` AS `vehicletype`,`a`.`servicesid` AS `servicesid`,`d`.`servicesname` AS `servicesname`
        FROM (((((`booking` `a`
        LEFT JOIN `srdbranch` `b` ON((`a`.`branchcode` = `b`.`id`)))
        LEFT JOIN `classification_services` `c` ON((`a`.`classid` = `c`.`id`)))
        LEFT JOIN `srdservices` `d` ON((`a`.`servicesid` = `d`.`sid`)))
        LEFT JOIN `status` `e` ON((`a`.`bookingstatus` = `e`.`statusid`)))
        LEFT JOIN `users` `f` ON((`a`.`employeeid` = `f`.`name`)));
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
        Schema::dropIfExists('viewbooking');
    }
}
