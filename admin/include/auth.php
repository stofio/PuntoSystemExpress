<?php
/**
 * restrict access to non logged and non admin
 */
session_start();

if(!isset($_SESSION["role_id"]) || $_SESSION["role_id"] !== "3") { //if is not admin
    header("Location: /");
    exit(); 
}
?>