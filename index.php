<?php
/**
 * Created by PhpStorm.
 * User: raulnet
 * Date: 01/08/17
 * Time: 19:47
 */
use Controller\HomeController;
require 'config/core.php';
session_start();
$homeController = new HomeController();
$homeController->run();



