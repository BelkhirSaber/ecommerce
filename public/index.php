<?php
// Application Start Point

if(session_id()) session_start();

require_once '../vendor/autoload.php';
require_once '../config/config.php';
require_once '../router/route.php';