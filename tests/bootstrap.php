<?php

session_write_close();
session_save_path(sys_get_temp_dir());
session_id('phpunit-' . uniqid());

require __DIR__ . '/../core/sp-load.php';
