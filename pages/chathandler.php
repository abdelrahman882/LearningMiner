<?php

session_start();
function mk_message_code($str1,$str2){
$arr=array($str1,$str2);
sort($arr,SORT_STRING);
$code=$arr[0].'<->'.$arr[1];
return $code;
}

if($_SERVER['REQUEST_METHOD']=='POST'){

if(isset($_POST['chatsend'])){

$date=date('Y/m/d H:i:s');
$message=$_POST['message'];
$message=filter_var($message,FILTER_SANITIZE_SPECIAL_CHARS);
$to=$_POST['to'];
$to=filter_var($to,FILTER_SANITIZE_SPECIAL_CHARS);
$_SESSION['chatting']=$to;
$username=$_SESSION['username'];


//go back to first page ..copy repeated username function here ...use it in if condition
function repeatedusername($username){
	//------------------------------------------BISO------------------------------------------------------------------------------
	//check if $username is repeated or not if repeated return true ,, else return false 
//================================================working area==================================================================================
	$serverSql = "localhost";
    $usernameSql = "id771390_root";
    $passwordSql = "372816";
    $dbnameSql = "id771390_learn";
	$conn = mysqli_connect($serverSql,$usernameSql,$passwordSql,$dbnameSql);
	if(!$conn){
		die("connection failed we are working in fixing this error :) >> ".mysqli_connect_error());
	}
	$sql = "SELECT username from signup where username = '$username'";
	$result = mysqli_query($conn,$sql);
	if($result){
		$counterRep = mysqli_num_rows($result);
		mysqli_close($conn);
		if($counterRep == 0){
			return false;
		}else{
			return true;
		}
	}else{
		return true;
	}

//================================================================================================
}

if(repeatedusername($to)){
$message_code=mk_message_code($username,$to);

//----------------------------------------------biso-------------------------------------------------
//===============================================working area==============================================
//store (message_code,,message ,, from(username) ,, to);
	$serverSql = "localhost";
    $usernameSql = "root";
    $passwordSql = "";
    $dbnameSql = "learn";
    $conn = mysqli_connect($serverSql,$usernameSql,$passwordSql,$dbnameSql);
    if(!$conn){
        die("connection failed we are working in fixing this error :) >> ".mysqli_connect_error());
    }
    $sql = "INSERT INTO chat (code,message,fromchat,tochat,Date) VALUES ('$message_code','$message','$username','$to','$date')";//where is the date you request from me later ?
    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);
//=========================delete the echo below after finishing=============================================================================



}





}
header('Location: userSide/pages/index.php');
}else{
	die("can't access this page");
}