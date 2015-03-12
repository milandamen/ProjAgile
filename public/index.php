<?php
/**
 * Created by PhpStorm.
 * User: SysAdmin
 * Date: 3/2/2015
 * Time: 8:00 PM
 */

require_once '../app/init.php';

//instantiate application
try {
	$app = new App();
} catch (Exception $e) {
	die('An error happened: ' . $e->getMessage());
}