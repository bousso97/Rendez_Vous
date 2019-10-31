<?php
session_start();
  // require "fonctions/fonction.php";
session_unset();
// destroy the session
session_destroy(); 
header("location:index.php");
?>