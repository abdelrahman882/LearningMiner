<?php 
session_start();
function mk_message_code($str1,$str2){
$arr=array($str1,$str2);
sort($arr,SORT_STRING);
$code=$arr[0].'<->'.$arr[1];
return $code;
}

$username;
$visitor=false;


if(isset($_SESSION['username'])){
    $username=$_SESSION['username'];
}else{
    $username='visitor';
    $visitor=true;
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
        
}$score+=$points;


    $sql = "UPDATE signup SET score = '$score' where username = '$username1'";
    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);
    }

function addinterest($strs,$usern){
     $serverSql = "localhost";
    $usernameSql = "id771390_root";
    $passwordSql = "372816";
    $dbnameSql = "id771390_learn";
    $conn = mysqli_connect($serverSql,$usernameSql,$passwordSql,$dbnameSql);
    if(!$conn){
        die("connection failed we are working in fixing this error :) >> ".mysqli_connect_error());
    }

$sql = "SELECT * FROM signup where username = '$usern'";
    $result1 = mysqli_query($conn,$sql);
    if($result1){
        $row =  mysqli_fetch_assoc($result1);
        $interest = $row['interest'];
        $arr=explode('-', $interest);
        foreach ($strs as $str) {
            array_push($arr, $str);
        }
        $re= implode('-', $arr);
}

    $sql = "UPDATE signup SET interest = '$re' where username = '$usern'";
    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);

}









if(isset($_SESSION['errormsg'])){
    echo "provided source's informatin wasn't complete";
    unset($_SESSION['errormsg']);
}
$username=null;
$visitor=false;
$type=null;
if(isset($_SESSION['type'])){
    $type=$_SESSION['type'];
}
if(isset($_SESSION['username'])){
$username=$_SESSION['username'];


if($_SERVER['REQUEST_METHOD']=='POST'){



if(isset($_POST['Lectures'])){



$type='lectures';
}elseif(isset($_POST['refrences'])){

$type='refrences';

}elseif(isset($_POST['playlists'])){

$type='playlists';
}




$_SESSION['type']=$type;

}
}else{
$visitor=true;
}






?>





<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sources</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
        <link rel="stylesheet" href="rangeSlider.css">

     <style>

	 	 #searchB {

            height: 50px;
            width: 45px;
            margin-left: -3px;
         }
		.panel-heading {
			height: 45px;
		}

		#addNewModal { 
			float : right;
			height : 35px;
			width : 150px;
			position: relative;
			padding-top: -50px;
			margin-top: -5px;
			margin-right: -10px;
		}
		
		.glyphicon-plus {
			float : right;
		}

input[type=text] {
    width: 130px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: white;
    background-image: url('searchicon.png');
    background-position: 10px 10px; 
    background-repeat: no-repeat;
    padding: 12px 20px 12px 40px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
}

input[type=text]:focus {
    width: 80%;
}




        #js-example-disabled, #js-example-buffer-set, #js-example-update-range, #js-example-destroy, #js-example-hidden{
            display : none;
        }
        
        html {
            color: #404040;
            font-family: Helvetica, arial, sans-serif;
        }

        #js-example-change-value {
            padding: 50px 20px;
            margin: 0 auto;
            max-width: 150px;
        }

        output {
            display: block;
            font-size: 30px;
            font-weight: bold;
            text-align: center;
            margin: 30px 0;
            width: 100%;
        }
        span.stars, span.stars span {
            display: block;
            background: url(stars.png) 0 -16px repeat-x;
            width: 80px;
            height: 16px;
        }
    
        span.stars span {
            background-position: 0 0;
        }
        
        .sajed {
            display :none;
        }
    </style>




    <script type="text/javascript" src="jquery.min.js"></script>
    
    <script type="text/javascript">
        $(function() {          
            $('input[type=submit]').click(function() {
                $('p').html('<span class="stars">'+parseFloat($('input[name=amount]').val())+'</span>');
                $('span.stars').stars();
            });         
            $('input[type=submit]').click();
        });

        $.fn.stars = function() {
            return $(this).each(function() {
                $(this).html($('<span />').width(Math.max(0, (Math.min(5, parseFloat($(this).html())))) * 16));
            });
        }
    </script>

</head>

<body>

    <div id="wrapper">
	
	<!-- =====================================================================================================
	============================================================================================================
	======================================================== GO TO LINE 296 =====================-->

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">

						<!-- strat of mesaage -->
                        <?php
                          $all_messages_array=array();
                          $farr=array();
                        $serverSql = "localhost";
    $usernameSql = "id771390_root";
    $passwordSql = "372816";
    $dbnameSql = "id771390_learn";
                                $conn = mysqli_connect($serverSql,$usernameSql,$passwordSql,$dbnameSql);
                                if(!$conn){
                                    die("connection failed we are working in fixing this error :) >> ".mysqli_connect_error());
                                }

                                
                               
                                 
                                $sql = "SELECT * from signup where username = '".$_SESSION['username']."'";//where is the code massage that we agreed on!
                                $result = mysqli_query($conn,$sql);
                                if($result){
$row =  mysqli_fetch_assoc($result);
                                       $allfstr=$row['friends'];
                                       $farr=explode('-', $allfstr);                                 
                                }

foreach ($farr as $f) {
   $code=mk_message_code($f,$username);
                                   $sql = "SELECT * from chat where code = '$code'";//where is the code massage that we agreed on!

                                 
                                $result = mysqli_query($conn,$sql);
                                if($result){
                                    while($row =  mysqli_fetch_assoc($result)){

                                        $Single_message_array = array($row['message'],$row['fromchat'],$row['Date'],$row['seen']);
                                        if( $Single_message_array[3]==0&&$row['fromchat']==$f){
                                        array_push($all_messages_array, $Single_message_array);
                                    }
                                    }
                                }else{
                                    echo "no messages !!";
                                }

echo'<li>
                            <a href="#">
                                <div>
                                    <strong>'.$f.'</strong></div>';
                                    for($i=count($all_messages_array)-1;$i>=count($all_messages_array)-4&&$i>=0;$i--) {
                                        $Single_message_array=$all_messages_array[$i];
                                      echo'

                                    <span class="pull-right text-muted">
                                        <em>'.$Single_message_array[2].'</em>
                                    </span>
                                
                                <div>'.$Single_message_array[0].'</div>
                            </a>
                        </li>';}
                            }
                                mysqli_close($conn);
                        
						?>
						<!-- end of message-->
                        
                        <li class="divider"></li>
                       
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
               
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../../logouthandler.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->


            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
					
					
	
	
	<!-- ============================================================================================
	===================================================================================================
	==================================================================================================
	================== Things to be changed here is 4 things the source name at line 292 and the body at lie 296 the image of comment person at line 317 name of cmment person at line 324 and message of comment at 327-->
	
				
				<div class="row">
                <div class="col-lg-12">
                    <div id = "acco" class="panel panel-default">


<form method="GET" action="sources.php">
  <input type="text" name="sstr" placeholder="Search..">
  <button id = "searchB" name = "Search" type="submit"><span class="glyphicon glyphicon-search"></span></button>
</form>

                        <div class="panel-heading">
                        
							


							<?php

                            $DYMC=0;
                            $IOF=array();
                            $sourcearr=array();
//==============================================================working area===================================================================
                            //make virtual data for lectures refrences playlists

if($type=='lectures'){
//get from database the data of lectures ---put in an array-- each element is array(name, about ,comments)--comments also is array of(username, message)
//you told me that there is no lec ?!
    $serverSql = "localhost";
    $usernameSql = "id771390_root";
    $passwordSql = "372816";
    $dbnameSql = "id771390_learn";
    $conn = mysqli_connect($serverSql,$usernameSql,$passwordSql,$dbnameSql);
    if(!$conn){
        die("connection failed we are working in fixing this error :) >> ".mysqli_connect_error());
    }
    $sql = "SELECT * from lectures";
    $result = mysqli_query($conn,$sql);
    $comments = array();
    
             if($result){

         if(isset($_GET['Search'])){ $IOF=explode(' ', $_GET['sstr']);addinterest($IOF,$username);}


                                                while($row =  mysqli_fetch_assoc($result)){
                                                    $indexcomm = $row['name'];
                                                    $sqllec = "SELECT * from comments where title = '$indexcomm' ORDER BY ID";
                                                    $resultlec = mysqli_query($conn,$sqllec);

                                                    if($resultlec){
                                                        while($rowlec =  mysqli_fetch_assoc($resultlec)){
                                                            $arrcomm = array($rowlec['username'],$rowlec['comment']);
                                                            array_push($comments,$arrcomm);
                                                        }
                                                    }


                                                    $arrlec = array($row['name'],$row['about'],$comments,$row['rank'],$row['KeyWord'],$row['link'],$row['imglink'],$row['owner']);
                                                    unset($comments);
                                                    $comments = array();
                                       if(isset($_GET['Search'])){

                                                                          //  array_push($IOF,explode(' ', $_GET['sstr']));
                                                                            array_push($arr2, $arrlec[4]);
                                                                            array_push($arr, $_GET['sstr']);


                                                                            for($i = 0 ; $i < count($arr);$i++){ // remove repeated
                                                                                for($j = $i+1 ; $j < count($arr)-1;$j++){
                                                                                if($arr[$i]==$arr[$j]){
                                                                                    unset($arr[$i]);
                                                                                    $i--;
                                                                                    break;
                                                                                }
                                                                              }
                                                                            }//------------------------------------------------

                                                                                $inti=0;

                                                                            foreach($arr as $keyword){
                                                                                foreach ($arr2 as $realkey) {
                                                                                    if(strcasecmp($keyword, $realkey) == 0){// if equal


                                                                                                    array_push($sourcearr,$arrlec);
                                                                                    }else{// doooooooooo you meaaaaan
                                                                                                        

                                                                                  $arrworduser=str_split($keyword);
                                                                                     $arrwordreal=str_split($realkey);
                                                                                     $counter=0.0;
                                                                                     $counter2=0.0;
                                                                                $t1=0;
                                                                                $t2=0;
                                                                                     foreach($arrworduser as $charuser){
                                                                                        foreach ($arrwordreal as $charreal) {
                                                                                            
                                                                                            if(strcasecmp($charreal, $charuser) == 0){
                                                                                    
                                                                                                $counter++;
                                                                                               
                                                                                                if($t2==$t1||$t2==$t1+1||$t2+1==$t1){
                                                                                                    $counter2+=1;
                                                                                                }
                                                                                                 break;
                                                                                            }
                                                                                            $t2++;
                                                                                        }
                                                                                        $t2=0;
                                                                                        $t1++;
                                                                                     }
                                                                                     if($counter/count($arrwordreal)>.5&&$counter2>=2){
                                                                    

                                                                                        $IOF[$inti]=$realkey;
                                                                                        $DYMC++;
                                                                                     }

                                                                                    }

                                                                                }
                                         $inti++;
                                                                            }


                                                                            
                                        }else{array_push($sourcearr,$arrlec);}


            }
              }
      mysqli_close($conn);
}elseif($type=='refrences'){
                                            $serverSql = "localhost";
    $usernameSql = "id771390_root";
    $passwordSql = "372816";
    $dbnameSql = "id771390_learn";
                                            $conn = mysqli_connect($serverSql,$usernameSql,$passwordSql,$dbnameSql);
                                            if(!$conn){
                                                die("connection failed we are working in fixing this error :) >> ".mysqli_connect_error());
                                            }
                                            $sql = "SELECT * from ref";
                                            $result = mysqli_query($conn,$sql);
                                            $comments = array();
                                            
                                            if($result){
                                                       if(isset($_GET['Search'])){   $IOF=explode(' ', $_GET['sstr']);addinterest($IOF,$username);
                                                   }

                                                while($row =  mysqli_fetch_assoc($result)){
                                                    $indexcomm = $row['name'];
                                                    $sqlref = "SELECT * from comments where title = '$indexcomm' ORDER BY ID";
                                                    $resultref = mysqli_query($conn,$sqlref);
                                                    if($resultref){
                                                        while($rowref =  mysqli_fetch_assoc($resultref)){
                                                            $arrcomm = array($rowrowref['username'],$rowref['comment']);
                                                            array_push($comments,$arrcomm);
                                                        }
                                                    }
                                                    $arrRef = array($row['name'],$row['content'],$comments,$row['rank'],$row['KeyWord'],$row['link'],$row['imglink'],$row['owner']);
                                            
                                                    unset($comments);
                                                    $comments = array();
                                                   if(isset($_GET['Search'])){

                                                                           // $IOF=explode(' ', $_GET['sstr']);
                                                                            $arr2=explode('-', $arrRef[4]);
                                                                            $arr=explode(' ', $_GET['sstr']);

                                                                            for($i = 0 ; $i < count($arr);$i++){ // remove repeated
                                                                                for($j = $i+1 ; $j < count($arr)-1;$j++){
                                                                                if($arr[$i]==$arr[$j]){
                                                                                    unset($arr[$i]);
                                                                                    $i--;
                                                                                    break;
                                                                                }
                                                                              }
                                                                            }//------------------------------------------------

                                                                                $inti=0;

                                                                            foreach($arr as $keyword){
                                                                                foreach ($arr2 as $realkey) {
                                                                                    if(strcasecmp($keyword, $realkey) == 0){// if equal


                                                                                                    array_push($sourcearr,$arrRef);
                                                                                    }else{// doooooooooo you meaaaaan
                                                                                                        

                                                                                  $arrworduser=str_split($keyword);
                                                                                     $arrwordreal=str_split($realkey);
                                                                                     $counter=0.0;
                                                                                     $counter2=0.0;
                                                                                $t1=0;
                                                                                $t2=0;
                                                                                     foreach($arrworduser as $charuser){
                                                                                        foreach ($arrwordreal as $charreal) {
                                                                                            
                                                                                            if(strcasecmp($charreal, $charuser) == 0){
                                                                                    
                                                                                                $counter++;
                                                                                               
                                                                                                if($t2==$t1||$t2==$t1+1||$t2+1==$t1){
                                                                                                    $counter2+=1;
                                                                                                }
                                                                                                 break;
                                                                                            }
                                                                                            $t2++;
                                                                                        }
                                                                                        $t2=0;
                                                                                        $t1++;
                                                                                     }
                                                                                     if($counter/count($arrwordreal)>.5&&$counter2>=2){
                                                                    
                                                                                        $IOF[$inti]=$realkey;
                                                                                        $DYMC++;
                                                                                     }

                                                                                    }

                                                                                }
                                         $inti++;
                                                                            }


                                                                            
                                        }else{array_push($sourcearr,$arrRef);}
                                                }
                                            }
    mysqli_close($conn);

}elseif($type=='playlists'){
    $serverSql = "localhost";
    $usernameSql = "id771390_root";
    $passwordSql = "372816";
    $dbnameSql = "id771390_learn";
    $conn = mysqli_connect($serverSql,$usernameSql,$passwordSql,$dbnameSql);
    if(!$conn){
        die("connection failed we are working in fixing this error :) >> ".mysqli_connect_error());
    }
    $sql = "SELECT * from playlist";
    $result = mysqli_query($conn,$sql);
    $comments = array();
    
    if($result){
         if(isset($_GET['Search'])){ $IOF=explode(' ', $_GET['sstr']);addinterest($IOF,$username);}
        while($row =  mysqli_fetch_assoc($result)){
            $indexcomm = $row['name'];
            $sqlplay = "SELECT * from comments where title = '$indexcomm' ORDER BY ID";
            $resultplay = mysqli_query($conn,$sqlplay);
            if($resultplay){
                while($rowplay =  mysqli_fetch_assoc($resultplay)){
                    $arrcomm = array($rowplay['username'],$rowplay['comment']);
                    array_push($comments,$arrcomm);
                }
            }   
            $arrplay = array($row['name'],$row['content'],$comments,$row['rank'],$row['KeyWord'],$row['link'],$row['imglink'],$row['owner']);
            unset($comments);
            $comments = array();
    if(isset($_GET['Search'])){
                                                                           // $IOF=explode(' ', $_GET['sstr']);
                                                                            $arr2=explode('-', $arrplay[4]);
                                                                            $arr=explode(' ', $_GET['sstr']);
                                                                            for($i = 0 ; $i < count($arr);$i++){ // remove repeated
                                                                                for($j = $i+1 ; $j < count($arr)-1;$j++){
                                                                                if($arr[$i]==$arr[$j]){
                                                                                    unset($arr[$i]);
                                                                                    $i--;
                                                                                    break;
                                                                                }
                                                                              }
                                                                            }//------------------------------------------------

                                                                                $inti=0;

                                                                            foreach($arr as $keyword){
                                                                                foreach ($arr2 as $realkey) {
                                                                                    if(strcasecmp($keyword, $realkey) == 0){// if equal


                                                                                                    array_push($sourcearr,$arrplay);
                                                                                    }else if(!isset($_GET['comingfromSG'])){// doooooooooo you meaaaaan
                                                                                                        

                                                                                  $arrworduser=str_split($keyword);
                                                                                     $arrwordreal=str_split($realkey);
                                                                                     $counter=0.0;
                                                                                     $counter2=0.0;
                                                                                $t1=0;
                                                                                $t2=0;
                                                                                     foreach($arrworduser as $charuser){
                                                                                        foreach ($arrwordreal as $charreal) {
                                                                                            
                                                                                            if(strcasecmp($charreal, $charuser) == 0){
                                                                                    
                                                                                                $counter++;
                                                                                               
                                                                                                if($t2==$t1||$t2==$t1+1||$t2+1==$t1){
                                                                                                    $counter2+=1;
                                                                                                }
                                                                                                 break;
                                                                                            }
                                                                                            $t2++;
                                                                                        }
                                                                                        $t2=0;
                                                                                        $t1++;
                                                                                     }
                                                                                     if($counter/count($arrwordreal)>.5&&$counter2>=2){
                                                                             
                                                                                        $IOF[$inti]=$realkey;
                                                                                        $DYMC++;

                                                                                     }

                                                                                    }

                                                                                }
                                         $inti++;
                                                                            }


                                                                            
                                        }else{array_push($sourcearr,$arrplay);}
        }
    }

    mysqli_close($conn);
            

}
//==================================================================================================================================================                        

                            

                 if($_SERVER['REQUEST_METHOD']=='GET'&&isset($_GET['sstr'])){
                            if($DYMC>0){
                            
                                echo 'SEARCHING FOR <b>"'.implode(' ', $IOF).'"</b> instead of "'.$_GET['sstr'].'" ?'.'<form method="GET" action="sources.php">
                                  <input name="sstr" type="text" value="'.implode(' ', $IOF).'" style="display:none;">
                                  <input name="comingfromSG" type="text" value="1" style="display:none;">
                                 <button name = "Search" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                  </form>';
                            }else{
                            echo 'results for "'.filter_var($_GET['sstr'],FILTER_SANITIZE_SPECIAL_CHARS).'" :';
                                 }
                }else {
                           echo  "Recommended";
                           
                            if(!$visitor){
                            echo ' '.$type." for you , ".$username;
                            }else{
                                echo ' '.$type." for you visitor, and we are witing for you to sign up";
                            }
                      }
                      echo'
<button id="addNewModal" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add new <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>';
                            ?>
                        </div>
                        <!-- .panel-heading -->
                        <div class="panel-body">
                            <div class="panel-group" id="accordion">
                            <!-- FIRST SOURCE -->
							


							<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog" role="document">
								<div class="modal-content">
								  <div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Add new recommended source</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									  <span aria-hidden="true">×</span>
									</button>
								  </div>
                                  <form action="../../aa.php" method="POST">
								  <div class="modal-body">
									
									  <div class="form-group">
										<label class="form-control-label" >Name:</label>
										<input type="text" class="form-control" name="name" id="recipient-name">
									  </div>
									   <div class="form-group">
										<label class="form-control-label">Field:</label>
										<input type="text" class="form-control"   name="keywords" id="recipient-name">
									  </div>
									   <div class="form-group">
										<label class="form-control-label">Link:</label>
										<input type="text" class="form-control"  name="link" id="recipient-name">
									  </div>
									     <div class="form-group">
										<label class="form-control-label" >Image link:</label>
										<input type="text" class="form-control" name="img" id="recipient-name">
									  </div>
									  <div class="form-group">
										<label class="form-control-label" >Discreption:</label>
										<textarea class="form-control" name="about" id="message-text"></textarea>
									  </div>
									
								  </div>
								  <div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" name="addnew" class="btn btn-primary">Add new</button>
                                   
								  </div>
                                   </form>
								</div>
							  </div>
							</div>
                        </div>
                  




<?php

$counter=0;
foreach ($sourcearr as $arr) {
$counter++;
$rate=0.0;
$rate=$arr[3];
$rate/=20.0;
//-----------------------------------------------------------------


//arr 5 - link  6 imglink -- owner 7
if(isset($_GET['Search'])){
scoreplus(5,$arr[7]);
}

 echo '

							
                                <div class="panel panel-default">

                  <div data-toggle="collapse" data-parent="#accordion" href="#collapse'.$counter.'" aria-expanded="false" class="collapsed" id = "accoHover" class="panel-heading">
                                       
                                        <div  class="panel-title"> 




                                        '
        .$arr[0].//res - name   
                                        '

                
                                        
                                        </div>


                                        </div>
                                    <div id="collapse'.$counter.'" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">



                                    



                                        <div class="panel-body">'
                                          
                                        
									
        .$arr[1].//about the res



												  
													'<div class = "collapsecollector">
													<div class="row">
													<div class="col-sm-12">


   <input class = "sajed" type="text" name="amount'.$counter.'" value="'.$rate.'" />
                                        <input class = "sajed" type="submit" value="update" />
                                        <p><span class="test'.$counter.'">2.4618164</span></p>

													<h4>reviews :</h4>

													</div><!-- /col-sm-12 -->
													</div><!-- /row -->'
													
													
			
                                ;
     foreach ($arr[2] as $comment) {
        $avatarr=null;
                            $serverSql = "localhost";
    $usernameSql = "id771390_root";
    $passwordSql = "372816";
    $dbnameSql = "id771390_learn";
                                $conn = mysqli_connect($serverSql,$usernameSql,$passwordSql,$dbnameSql);
                                if(!$conn){
                                    die("connection failed we are working in fixing this error :) >> ".mysqli_connect_error());
                                }
                                $sql = "SELECT * from signup where username = '$comment[0]'";
                                $result = mysqli_query($conn,$sql);
                                if($result){
                                    while($row =  mysqli_fetch_assoc($result)){
                                            $avatarr=$row['avlink'];
                               }
                                }else{
                                    echo "no messages !!";
                                }
                                mysqli_close($conn);
                        
$avatarr="../../".$avatarr;
        
echo ' 
													
													<div class="col-sm-1">
													<div class="thumbnail">
													<img class="img-responsive user-photo" src="'

           .$avatarr. //commenter avatar 
                                                    '" alt="image">
													</div><!-- /thumbnail -->
													</div><!-- /col-sm-1 -->

													<div class="col-sm-5">
													<div class="panel panel-default">
													<div class="panel-heading">
													<strong>'
            .$comment[0].// The  commenter
                                                    '</strong> <span class="text-muted"><!--Time Ago --></span>
													</div>
													<div class="panel-body">'
			.$comment[1].//  his message
													'</div><!-- /panel-body -->
													</div><!-- /panel panel-default -->
													</div><!-- /col-sm-5 -->
  
													</br>
													</br>
													</br>
													</br>
													</br>
                                                
                                                    </br>
                                                    </br>

                                                    '
 ;                         

    }       
    echo '
													<!-- Another comment here after the break -->
													 <link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css">

													 
													 </div> <!-- end collapse collector div -->
													 

																					

														</br>
														</br>';
                                                        if(!$visitor){
													
echo '
																								 
															<div id = "addComm" class="col-md-6">
																					<div class="widget-area no-padding blank">
																						<div class="status-upload">
																							<form action="../../reviewshandler.php" method="POST">
																								<textarea name="review" id = "textArea" placeholder="What are you doing right now?" ></textarea>
																								<ul>
																									<li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Audio"><i class="fa fa-music"></i></a></li>
																									<li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Video"><i class="fa fa-video-camera"></i></a></li>
																									<li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Sound Record"><i class="fa fa-microphone"></i></a></li>
																									<li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Picture"><i class="fa fa-picture-o"></i></a></li>
																								</ul>
                                                                                                <input name="typenamerv" type="text" value="'.$arr[0].'" style="display:none;">
																								<button 
                                                                                                name='
                                                                                                .$arr[0].'
                                                                                               " type="submit" class="btn btn-success green"><i class="fa fa-share"></i> Share</button>

																							</form>
 

                                                                                            <form action="../../reviewshandler.php" method="GET">



                                                                                            <div id="js-example-change-value">
                                                                                            <h5>RATE US</h5>
                                                                                           
                                                                                            <output></output>
                                                                                            <button 
                                                                                                name="'
                                                                                                .$arr[0].'
                                                                                               " type="submit" class="btn btn-success green"><i class="fa fa-share"></i> RATE</button>
                                                                                              </div>
                                                                                                <input name="typenamert" type="text" value="'.$arr[0].'" style="display:none;">
                                                                                                 <input name="rate" type="range" min="10" max="100" data-rangeSlider>
                                                                                                



                                                                                            </form>
																						</div><!-- Status Upload  -->
																					</div><!-- Widget Area -->
																				</div>';
																

				
	  }


	echo '
						
										
										</div>
                                    </div>
                                </div>
                                ';

                            }
								?>
								<!-- END OF FIRST SOURCE -->
                               
       
	   
	   
								<!-- Another source to be added here -->
	   
	   
	   
	   
                            </div>
                        </div>
                        <!-- .panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
					
					
					
					
					
					
					
					
                        
						
						
						
						
						
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <!--->



<!-- DONOT TOUCH THIS CODE YA ABDO MESH #AEF BTA# EH BAS MOHEM GDAN GDAN GDAN -->
<div id="js-example-disabled">
    <button data-behaviour="toggle">Toggle disabled state</button>
</div>
<div id="js-example-buffer-set">
    <button>Change value</button>
</div>
<div id="js-example-update-range">
    <button>Update range {min : 0, max : 20, step : 0.5, value : 1.5, buffer : 70}</button>
</div>
<div id="js-example-destroy">
    <button data-behaviour="destroy">Destroy</button>
    <button data-behaviour="initialize">Initialize</button>
</div>
<div id="js-example-hidden">
    <button data-behaviour="toggle">Toggle visibility</button>
</div>


<script src="rangeSlider.js"></script>
<script>
    (function () {

        var selector = '[data-rangeSlider]',
                elements = document.querySelectorAll(selector);

        // Example functionality to demonstrate a value feedback
        function valueOutput(element) {
            var value = element.value,
                    output = element.parentNode.getElementsByTagName('output')[0];
            output.innerHTML = value;
        }

        for (var i = elements.length - 1; i >= 0; i--) {
            valueOutput(elements[i]);
        }

        Array.prototype.slice.call(document.querySelectorAll('input[type="range"]')).forEach(function (el) {
            el.addEventListener('input', function (e) {
                valueOutput(e.target);
            }, false);
        });


        // Example functionality to demonstrate disabled functionality
        var toggleBtnDisable = document.querySelector('#js-example-disabled button[data-behaviour="toggle"]');
        toggleBtnDisable.addEventListener('click', function (e) {
            var inputRange = toggleBtnDisable.parentNode.querySelector('input[type="range"]');
            console.log(inputRange);
            if (inputRange.disabled) {
                inputRange.disabled = false;
            }
            else {
                inputRange.disabled = true;
            }
            inputRange.rangeSlider.update();
        }, false);

        // Example functionality to demonstrate programmatic value changes
        var changeValBtn = document.querySelector('#js-example-change-value button');
        changeValBtn.addEventListener('click', function (e) {
            var inputRange = changeValBtn.parentNode.querySelector('input[type="range"]'),
                    value = changeValBtn.parentNode.querySelector('input[type="number"]').value;

            inputRange.value = value;
            inputRange.dispatchEvent(new Event('change'));
        }, false);

        // Example functionality to demonstrate programmatic buffer set
        var stBufferBtn = document.querySelector('#js-example-buffer-set button');
        stBufferBtn.addEventListener('click', function (e) {
            var inputRange = stBufferBtn.parentNode.querySelector('input[type="range"]'),
                    value = stBufferBtn.parentNode.querySelector('input[type="number"]').value;

            inputRange.rangeSlider.update({buffer: value});
        }, false);

        // Example functionality to demonstrate destroy functionality
        var destroyBtn = document.querySelector('#js-example-destroy button[data-behaviour="destroy"]');
        destroyBtn.addEventListener('click', function (e) {
            var inputRange = destroyBtn.parentNode.querySelector('input[type="range"]');
            console.log(inputRange);
            inputRange.rangeSlider.destroy();
        }, false);

        var initBtn = document.querySelector('#js-example-destroy button[data-behaviour="initialize"]');

        initBtn.addEventListener('click', function (e) {
            var inputRange = initBtn.parentNode.querySelector('input[type="range"]');
            rangeSlider.create(inputRange, {});
        }, false);

        //update range
        var updateBtn1 = document.querySelector('#js-example-update-range button');
        updateBtn1.addEventListener('click', function (e) {
            var inputRange = updateBtn1.parentNode.querySelector('input[type="range"]');
            inputRange.rangeSlider.update({min: 0, max: 20, step: 0.5, value: 1.5, buffer: 70});
        }, false);


        var toggleBtn = document.querySelector('#js-example-hidden button[data-behaviour="toggle"]');
        toggleBtn.addEventListener('click', function (e) {
            var container = e.target.previousElementSibling;
            if (container.style.cssText.match(/display[\s:]{1,3}none/)) {
                container.style.cssText = '';
            } else {
                container.style.cssText = 'display: none;';
            }
        }, false);

        // Basic rangeSlider initialization
        rangeSlider.create(elements, {

            // Callback function
            onInit: function () {
            },

            // Callback function
            onSlideStart: function (value, percent, position) {
                console.info('onSlideStart', 'value: ' + value, 'percent: ' + percent, 'position: ' + position);
            },

            // Callback function
            onSlide: function (value, percent, position) {
                console.log('onSlide', 'value: ' + value, 'percent: ' + percent, 'position: ' + position);
            },

            // Callback function
            onSlideEnd: function (value, percent, position) {
                console.warn('onSlideEnd', 'value: ' + value, 'percent: ' + percent, 'position: ' + position);
            }
        });

    })();
</script>
    <!--->
    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
