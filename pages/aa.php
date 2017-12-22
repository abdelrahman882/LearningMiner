<?php
session_start();
function scoreplus($points,$username1){

        $serverSql = "localhost";
    $usernameSql = "id771390_root";
    $passwordSql = "372816";
    $dbnameSql = "id771390_learn";
    $conn = mysqli_connect($serverSql,$usernameSql,$passwordSql,$dbnameSql);
    if(!$conn){
        die("connection failed we are working in fixing this error :) >> ".mysqli_connect_error());
    }

$sql = "SELECT * FROM signup where username = '$username1'";
    $result1 = mysqli_query($conn,$sql);
    if($result1){
        $row =  mysqli_fetch_assoc($result1);
        $score = $row['score'];
        
}

$score+=$points;


    $sql = "UPDATE signup SET score = '$score' where username = '$username1'";
    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);
    }

function score($username1){
    $serverSql = "localhost";
    $usernameSql = "id771390_root";
    $passwordSql = "372816";
    $dbnameSql = "id771390_learn";
    $conn = mysqli_connect($serverSql,$usernameSql,$passwordSql,$dbnameSql);
    if(!$conn){
        die("connection failed we are working in fixing this error :) >> ".mysqli_connect_error());
    }

$sql = "SELECT * FROM signup where username = '$username1'";
    $result1 = mysqli_query($conn,$sql);
    if($result1){
        $row =  mysqli_fetch_assoc($result1);
        $score = $row['score'];
        return $score;
}
return 0 ;
}


if($_SERVER['REQUEST_METHOD']=='POST'){
if(isset($_POST['addnew'])){
$type=$_SESSION['type'];
$username=$_SESSION['username'];


if($type=='Lectures'){

$type='lectures';
}elseif($type=='refrences'){
 
$type='ref';

}elseif($type=='playlists'){

$type='playlist';
}



	$name=filter_var($_POST['name'],FILTER_SANITIZE_SPECIAL_CHARS);
$keywords1= explode(' ', filter_var($_POST['keywords'],FILTER_SANITIZE_SPECIAL_CHARS));
array_push($keywords1, $name);
$keywords= implode('-', $keywords1);
	$link=filter_var($_POST['link'],FILTER_SANITIZE_SPECIAL_CHARS);
	$img=filter_var($_POST['img'],FILTER_SANITIZE_SPECIAL_CHARS);
	$about=filter_var($_POST['about'],FILTER_SANITIZE_SPECIAL_CHARS);
    $D=date('Y/m/d H:i:s');
	if($name==null||$img==null||$about==null||$link==null||$keywords==null){
		$_SESSION['errormsg']="didn't fill an important field";

header('Location: userSide/pages/sources.php');
die('error');
	}
$serverSql = "localhost";
    $usernameSql = "id771390_root";
    $passwordSql = "372816";
    $dbnameSql = "id771390_learn";
    $conn = mysqli_connect($serverSql,$usernameSql,$passwordSql,$dbnameSql);
    if(!$conn){
        die("connection failed we are working in fixing this error :) >> ".mysqli_connect_error());
    }
    $sql = "INSERT INTO ".$type." (name,imglink,content,link,KeyWord,owner,adddate) VALUES ('$name','$img','$about','$link','$keywords','$username','$D')";

    
    $result = mysqli_query($conn,$sql);
    if($result){
        scoreplus(10,$username);
        if(score($username)>=1000){            // if adder score more than 1000  >> we will add it to interests
   
    $sql = "SELECT * from signup";
    $result = mysqli_query($conn,$sql);
     while($row =  mysqli_fetch_assoc($result)){


        $arr=explode('-', $row['interest']);
        foreach ($keywords1 as $key) {
            foreach ($arr as $interest) {
                if(strcasecmp($key, $interest) == 0){

                    $addtotm=$name.'-'.$about.'-'.$link;
                    $st=$row['timeline'].'#'.$addtotm;
                    $usernn=$row['username'];
            

    $sql = "UPDATE signup SET timeline = '$st' where username = '$usernn'";
    $result = mysqli_query($conn,$sql);

                }
            }
        }



    }

    }


    }
    mysqli_close($conn);

    
header('Location: userSide/pages/sources.php');
}else{
header('Location: userSide/pages/sources.php');
}
}else{
header('Location: userSide/pages/sources.php');

}
