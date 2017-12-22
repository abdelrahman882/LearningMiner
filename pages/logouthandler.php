<?php


session_start();
function online($bool,$usern){
    $serverSql = "localhost";
    $usernameSql = "id771390_root";
    $passwordSql = "372816";
    $dbnameSql = "id771390_learn";
    $conn = mysqli_connect($serverSql,$usernameSql,$passwordSql,$dbnameSql);
    if(!$conn){
        die("connection failed we are working in fixing this error :) >> ".mysqli_connect_error());
    }

if($bool==1){
    $sql = "UPDATE signup SET online = 1 where username = '$usern'";
}else if($bool==0){
    $sql = "UPDATE signup SET online = 0 where username = '$usern'";

}
    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);
}


online(0,$_SESSION['username']);
unset($_SESSION['username']);

session_unset();
session_destroy();

date_default_timezone_set('Africa/Egypt');
$logoutdate = date('Y/m/d H:i:s');

//temp database it ---------  remove old >> add new----------------------                           biso
$serverSql = "localhost";
    $usernameSql = "id771390_root";
    $passwordSql = "372816";
    $dbnameSql = "id771390_learn";
$conn = mysqli_connect($serverSql,$usernameSql,$passwordSql,$dbnameSql);
if(!$conn){
	die("connection failed we are working in fixing this error :) >> ".mysqli_connect_error());
}
$sql = "UPDATE signup set logoutAt = '$logoutdate' where username = '$username'";
$result = mysqli_query($conn,$sql);
mysqli_close($conn);

header('Location: firstpage.php');
die("404 can't find homepage");