<?php
session_start();
require_once "header.php";
require_once "functions.php";
require_once "conf.inc.php";

$db = connectDb();
$today = date("Y-m-d H:i:s"); 
if($_POST["is_profile"]==1){
	$query=$db -> prepare("INSERT INTO comments(sender_nickname, profile_id, content, comment_date) VALUES(:sender_nickname,:profile_id,:content, :comment_date)");
	$query -> execute(["sender_nickname"=>$_POST["sender_nickname"], "profile_id"=>$_POST["receiver_id"], "content"=>$_POST["content"],"comment_date"=>$today]);
} else {
	$query=$db -> prepare("INSERT INTO comments(sender_nickname, project_id, content,comment_date) VALUES(:sender_nickname,:project_id,:content, :comment_date)");
	$query -> execute(["sender_nickname"=>$_POST["sender_nickname"], "project_id"=>$_POST["receiver_id"], "content"=>$_POST["content"],"comment_date"=>$today]);
}