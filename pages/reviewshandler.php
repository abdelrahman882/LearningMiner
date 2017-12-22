<?php

session_start();
function rated($un,$val,$rtrs,$f,$typeg,$typen){
	
	if($f==1){
		$i=0;
		foreach ($rtrs as $rater) {
			$arr22=explode('-', $rater);
			echo $un . $arr22[0];

			if($un==$arr22[0]){
			$rtrs[$i]=$un.'-'.$val;
		}
		$i++;
		}
	
	}else{
		array_push($rtrs, $un.'-'.$val);
	}
	$finalraters=implode('#', $rtrs);
	
	$serverSql = "localhost";
    $usernameSql = "id771390_root";
    $passwordSql = "372816";
    $dbnameSql = "id771390_learn";
    $conn = mysqli_connect($serverSql,$usernameSql,$passwordSql,$dbnameSql);

 $sql = "UPDATE ".$typeg." SET rated = '$finalraters' where name = '$typen'";
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

if($_SERVER['REQUEST_METHOD']=='POST'){


//============================================================
	$type=$_SESSION['type'];
	$username=$_SESSION['username'];
	$review=$_POST['review'];
	$review=filter_var($review,FILTER_SANITIZE_SPECIAL_CHARS);
    $typename=$_POST['typenamerv'];

//======================================================================
//you should store these data username is writer of the review...review is what he wrote .. type (ex-playlists)..typename(ex-javaplaylist)
    $serverSql = "localhost";
    $usernameSql = "id771390_root";
    $passwordSql = "372816";
    $dbnameSql = "id771390_learn";
	$conn = mysqli_connect($serverSql,$usernameSql,$passwordSql,$dbnameSql);
	if(!$conn){
		die("connection failed we are working in fixing this error :) >> ".mysqli_connect_error());
	}
	$sql = "INSERT INTO comments (username,comment,type,title) VALUES ('$username','$review','$type','$typename')";
	$result = mysqli_query($conn,$sql);
	mysqli_close($conn);
	if($result){
		scoreplus(2,$username);
	}
	header('Location: userSide/pages/sources.php');


}else if($_SERVER['REQUEST_METHOD']=='GET'){

//============================================
$totalrate=0.0;
$num=0.0;
$owner ='';
$raters='';
$rate=$_GET['rate'];
$dateadd='';
if($rate>100||$rate<0){
    header('Location: userSide/pages/sources.php');
}
$typename=$_GET['typenamert'];
$type=$_SESSION['type'];
$username=$_SESSION['username'];
//=============================================
/*
first step : get the total rate .. and get the number of people .......put in $totalrate and $num 
second step .. put this code; */
if($type == "playlists"){
	$serverSql = "localhost";
    $usernameSql = "id771390_root";
    $passwordSql = "372816";
    $dbnameSql = "id771390_learn";
	$conn = mysqli_connect($serverSql,$usernameSql,$passwordSql,$dbnameSql);
	if(!$conn){
		die("connection failed we are working in fixing this error :) >> ".mysqli_connect_error());
	}
	$sql = "SELECT * FROM playlist where name = '$typename'";
	$result = mysqli_query($conn,$sql);
	if($result){
		$row =  mysqli_fetch_assoc($result);
		$totalrate = $row['rank'];
		$num = $row['NoP'];
		$owner = $row['owner'];
		$raters=$row['rated'];
			$dateadd=$row['adddate'];

	}else{
		$totalrate = 0;
		$num = 0;
	}
	mysqli_close($conn);
}elseif($type == "lectures"){
	$serverSql = "localhost";
    $usernameSql = "id771390_root";
    $passwordSql = "372816";
    $dbnameSql = "id771390_learn";
	$conn = mysqli_connect($serverSql,$usernameSql,$passwordSql,$dbnameSql);
	if(!$conn){
		die("connection failed we are working in fixing this error :) >> ".mysqli_connect_error());
	}
	$sql = "SELECT * FROM lectures where name = '$typename'";
	$result = mysqli_query($conn,$sql);
	if($result){
		$row =  mysqli_fetch_assoc($result);
		$totalrate = $row['rank'];
		$num = $row['NoP'];
$owner = $row['owner'];
		$raters=$row['rated'];
				$dateadd=$row['adddate'];


	}else{
		$totalrate = 0;
		$num = 0;
	}
	mysqli_close($conn);
}elseif($type == "refrences"){
	$serverSql = "localhost";
    $usernameSql = "id771390_root";
    $passwordSql = "372816";
    $dbnameSql = "id771390_learn";
	$conn = mysqli_connect($serverSql,$usernameSql,$passwordSql,$dbnameSql);
	if(!$conn){
		die("connection failed we are working in fixing this error :) >> ".mysqli_connect_error());
	}
	$sql = "SELECT * FROM ref where name = '$typename'";
	$result = mysqli_query($conn,$sql);
	if($result){
		$row =  mysqli_fetch_assoc($result);
		$totalrate = $row['rank'];
		$num = $row['NoP'];
		$owner = $row['owner'];
		$raters=$row['rated'];
		$dateadd=$row['adddate'];

	}else{
		$totalrate = 0;
		$num = 0;
	}
	mysqli_close($conn);
}
$heratedbf=-1;
$flagg=0;
		$arr=explode('#', $raters);
		foreach ($arr as $rater) {
			$arr22=explode('-', $rater);
			print_r($arr22);
			if($_SESSION['username']==$arr22[0]){
			$heratedbf=$arr22[1];
			$flagg=1;
			break;
			
		}
		}
		


		$raterscore=score($_SESSION['username']); //$totalrate$num$owner$raters$dateadd   $raterscore
		$dnw=explode(' ', date('Y/m/d H:i:s'));
		$dnwleftnw=explode('/', $dnw[0]);
		$dpt=explode(' ', $dateadd);
		$dnwleftpt=explode('/', $dnw[0]);

		$days= (intval($dnwleftnw[0])-intval($dnwleftpt[0]))*360+(intval($dnwleftnw[1])-intval($dnwleftpt[1]))*30+(intval($dnwleftnw[2])-intval($dnwleftpt[2]));


		if($heratedbf!=-1){ 

	$totalrate-=$heratedbf;
	$num--;


		}

$totalrateold=$totalrate;

	$totalrate=(((($rate)*$raterscore)/(($days+1)*1000))+$totalrate)/($num+1);
//echo $totalrate;





$rateeff=$totalrate-$totalrateold;
$num++;
         $typeg='';
    switch ($type) {
    	case 'playlists':
    		$typeg="playlist";
    		break;
    	case 'lectures':
    		$typeg="lectures";

    	break;
    	case 'refrences':
    		$typeg="ref";

    	break;
    	default:
    		# code...
    		break;
    }     
rated($username,$rateeff,$arr,$flagg,$typeg,$typename);//if flag ==1 user update rating his name aleady included in raters

if($totalrate>50){
switch ($num) {
		case 50:
		scoreplus(50,$owner);
		break;
		case 200:
		scoreplus(75,$owner);
		break;
		case 1000:
		scoreplus(100,$owner);
		break;
		case 100000:
		scoreplus(200,$owner);
		break;
	
	default:
		
		break;
}
}
scoreplus(1,$username);

/*
third step :
store the new totalrate and the new num 
*/
if($type == "playlists"){
	$serverSql = "localhost";
    $usernameSql = "id771390_root";
    $passwordSql = "372816";
    $dbnameSql = "id771390_learn";
	$conn = mysqli_connect($serverSql,$usernameSql,$passwordSql,$dbnameSql);
	if(!$conn){
		die("connection failed we are working in fixing this error :) >> ".mysqli_connect_error());
	}
	$sql = "UPDATE playlist SET rank = '$totalrate' where name = '$typename'";
	$result = mysqli_query($conn,$sql);
	$sql = "UPDATE playlist SET NoP = '$num' where name = '$typename'";
	$result = mysqli_query($conn,$sql);
	mysqli_close($conn);
}elseif($type == "lectures"){
	$serverSql = "localhost";
	$usernameSql = "root";
	$passwordSql = "";
	$dbnameSql = "learn";
	$conn = mysqli_connect($serverSql,$usernameSql,$passwordSql,$dbnameSql);
	if(!$conn){
		die("connection failed we are working in fixing this error :) >> ".mysqli_connect_error());
	}
	$sql = "UPDATE lectures SET rank = '$totalrate' where name = '$typename'";
	$result = mysqli_query($conn,$sql);
	$sql = "UPDATE lectures SET NoP = '$num' where name = '$typename'";
	$result = mysqli_query($conn,$sql);
	mysqli_close($conn);
}elseif($type == "refrences"){
	$serverSql = "localhost";
    $usernameSql = "id771390_root";
    $passwordSql = "372816";
    $dbnameSql = "id771390_learn";
	$conn = mysqli_connect($serverSql,$usernameSql,$passwordSql,$dbnameSql);
	if(!$conn){
		die("connection failed we are working in fixing this error :) >> ".mysqli_connect_error());
	}
	$sql = "UPDATE ref SET rank = '$totalrate' where name = '$typename'";
	$result = mysqli_query($conn,$sql);
	$sql = "UPDATE ref SET NoP = '$num' where name = '$typename'";
	$result = mysqli_query($conn,$sql);
	mysqli_close($conn);
}


header('Location: userSide/pages/sources.php');
}else{
    die("can't access this page");
}






