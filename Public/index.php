<?php
// Application Start Point

if(!session_id()) session_start();

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Config/config.php';

require_once __DIR__ . '/../Config/database.php';

require_once __DIR__ . '/../Config/vite-helper.php';

require_once __DIR__ . '/../Router/route.php';