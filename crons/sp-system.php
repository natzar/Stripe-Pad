<?php

include "../core/sp-load.php";

class SystemCronjob extends cronJob
{

    function run()
    {
        # Do something
    }
}

$cron = new SystemCronjob('system');
