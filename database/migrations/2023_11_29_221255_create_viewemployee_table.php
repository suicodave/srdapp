<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateViewemployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<'SQL'
        CREATE VIEW viewemployee AS
        SELECT `c`.`name` AS `name`,`c`.`email` AS `email`,`c`.`mobile_no` AS `mobile_no`,`c`.`status` AS `status`,`b`.`position` AS `position`,`d`.`description` AS `description`,`e`.`branch_name` AS `branch_name`
        FROM ((((`useraccount` `a`
        LEFT JOIN `designation` `b` ON((`a`.`designationid` = `b`.`id`)))
        LEFT JOIN `users` `c` ON((`a`.`employeeid` = `c`.`id`)))
        LEFT JOIN `salaraygrade` `d` ON((`a`.`salarygrade` = `d`.`sgid`)))
        LEFT JOIN `srdbranch` `e` ON((`a`.`branchid` = `e`.`id`)));
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
        Schema::dropIfExists('viewemployee');
    }
}
