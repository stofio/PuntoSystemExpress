<?php
/**
 * restrict access to non logged and non supplier
 */
session_start();

if(!isset($_SESSION["role_id"]) || $_SESSION["role_id"] !== "1") { //if is not supplier
    echo "<script>location='/'</script>";
    header("Location: /");
    exit(); 
}
?>