<?php
session_start();
// Destroying All Sessions
if(session_destroy())
{
// Redirecting To Home Page
echo "<script>location='/'</script>";
header("Location: /");
}
?>