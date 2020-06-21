<?php
/**
 * Created by PhpStorm.
 * User: pdkhang
 * Date: 02-Oct-17
 * Time: 8:24 PM
 */
session_start();
session_destroy();
header('Location: index.php');
?>