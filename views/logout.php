<?php session_start();
require 'C:\xampp\htdocs\INVENTORYPHP\views\logo_common.php';
session_destroy(); //for logout
header("Location: main.php");
