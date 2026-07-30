<?php
// Application Start Point

if(session_id()) session_start();

require_once '../vendor/autoload.php';
require_once '../Config/config.php';

require_once '../Config/database.php';

require_once '../Config/vite-helper.php';

require_once '../Router/route.php';