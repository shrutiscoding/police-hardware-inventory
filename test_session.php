<?php
session_start();
$_SESSION['test'] = "Session is working!";
echo "Session Test: " . $_SESSION['test'];
?>
