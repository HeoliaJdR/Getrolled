<?php
session_start();
require "header.php";
require_once "functions.php";

$db = connectDb();

showArray($_GET);
