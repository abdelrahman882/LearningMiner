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

$plylstnum = -1;
$profnum = -1;
$refnum = -1;
//-----------------------------------------------------biso-----------------------------------------------------------------
//return the num of each ::::::: playlists->put in $plylstnum , refrenes -> put in refnum , profs -> put in $profnum---there is no num for lectures
//==================================================working area=================================================================================
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
    if($result){
        $plylstnum = mysqli_num_rows($result);
    }else{
        $plylstnum = -1;
    }
    $sql = "SELECT * from ref";
    $result = mysqli_query($conn,$sql);
    if($result){
        $refnum = mysqli_num_rows($result);
    }else{
        $refnum = -1;
    }
    $sql = "SELECT * from doc";
    $result = mysqli_query($conn,$sql);
    if($result){
        $profnum = mysqli_num_rows($result);
    }else{
        $profnum = -1;
    }
    mysqli_close($conn);

//===============================================================================================================================

?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LeaRn</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
		<!-- Who is online-->
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link href='https://fonts.googleapis.com/css?family=RobotoDraft' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
		        <script type="text/javascript" src="jquery.min.js"></script>

				
				
				
				
					<style>
	/* Style the links inside the sidenav */
#mySidenav1 a {
    position: absolute; /* Position them relative to the browser window */
    left: -80px; /* Position them outside of the screen */
    transition: 0.3s; /* Add transition on hover */
    padding: 7px; /* 15px padding */
	padding-left: 25px;
    width: 100px; /* Set a specific width */
    text-decoration: none; /* Remove underline */
    font-size: 20px; /* Increase font size */
    color: white; /* White text color */
    border-radius: 0 5px 5px 0; /* Rounded corners on the top right and bottom right side */
	margin-top : 32px;
	height: 40px;
}

#WhoIsOn {
	margin-top: 52px;
}

@media screen and (max-width: 767px) {
    #mySidenav1 a {
		margin-top : 83px;
    }
	#WhoIsOn {
		margin-top: 100px;
	}
}



#mySidenav1 a:hover {
    left: 0; /* On mouse-over, make the elements appear as they should */
}

/* The about link: 20px from the top with a green background */
#about {
    top: 20px;
    background-color: #4CAF50;
}


	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	
/* The side navigation menu */
.sidenav {
    height: 100%; /* 100% Full-height */
    width: 0; /* 0 width - change this with JavaScript */
    position: fixed; /* Stay in place */
    z-index: 10000000; /* Stay on top */
    top: 0;
    left: 0;
    background-color: #111; /* Black*/
    overflow-x: hidden; /* Disable horizontal scroll */
    padding-top: 60px; /* Place content 60px from the top */
    transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
}



/* The navigation menu links */
.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s
}

/* When you mouse over the navigation links, change their color */
.sidenav a:hover, .offcanvas a:focus{
    color: #f1f1f1;
}

/* Position and style the close button (top right corner) */
.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}



/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
}









#chat1 {
	position: fixed;
    bottom: 0;
    right: 0;
	width: 300px;
	margin-bottom: -20px;
	display: none;
	}
	
#timeline { 
	margin:  auto;
}
	
	
	
#zorar {
	width: 100%;
}	

#btn-input2 {
	display: none;
}
<!-- msg sent to -->
.msgSentTo {
	display: none;
}
	
</style>

				
				
				
				
				
				
				
</head>
<body>
<!-- Who is online -->
<nav  id = "WhoIsOn" class="w3-bar-block w3-collapse w3-white w3-animate-left w3-card-2" style="position: absolute; top:0 ; right: 0 ;z-index:3;width:110px;">

  <a id="myBtn" onclick="myFunc('Demo1')" href="javascript:void(0)" class="w3-bar-item w3-button"><i class="fa fa-inbox w3-margin-right"></i>Online<i class="fa fa-caret-down w3-margin-right"></i></a>
  
  <div id="Demo1" class="w3-hide w3-animate-right"  >

  <?php

$serverSql = "localhost";
    $usernameSql = "root";
    $passwordSql = "";
    $dbnameSql = "learn";
    $conn = mysqli_connect($serverSql,$usernameSql,$passwordSql,$dbnameSql);
    if(!$conn){
        die("connection failed we are working in fixing this error :) >> ".mysqli_connect_error());
    }





  $friendarr=array();
  
  $sql = "SELECT * FROM signup where username = '$username'";
    $result220 = mysqli_query($conn,$sql);
    if($result220){
        $row =  mysqli_fetch_assoc($result220);
        $friends= $row['friends'];
     $friendarr=explode('-', $friends);

}

     


 
    
   $arr7=array(null,null,null,null);
foreach ($friendarr as $friend) {
         

  $sql = "SELECT * FROM signup where username = '$friend'";
    $result220 = mysqli_query($conn,$sql);
    if($result220){
        $row =  mysqli_fetch_assoc($result220);
$arr7[0]= $row['online'];
$arr7[1]= $row['avlink'];
$arr7[2]=$row['firstname'];
$arr7[3]=$row['username'];
    }
    
    //--------------------------
    if($arr7[0]==1){ // asht3'l hna
echo ' <a id = "'.$arr7[3].'" href="javascript:void(0)" class="w3-bar-item w3-button w3-border-bottom test w3-hover-light-grey" onclick="openChat('."'Demo1',this.id".');" id="firstTab">
      <div class="w3-container">

        <img class="w3-round w3-margin-right" src="../../'.
        $arr7[1]
        .'" style="width:100%;"><span class="w3-opacity w3-large">'.
        $arr7[2]
        .'</span>
      </div>
    </a>';
    }
}// ---------------------- mlksh d3wa bli mktob t7t 5lik fli fo2
echo ' <a href="javascript:void(0)" class="w3-bar-item w3-button w3-border-bottom test w3-hover-light-grey" onclick="openChat('."'Demo1'".');" id="firstTab">
      <div class="w3-container">
        <img class="w3-round w3-margin-right" src="../../avatars/non.png" style="width:100%;"><span class="w3-opacity w3-large"><h6>Send a friend request<h6></span>

      </div>
    </a>';
   mysqli_close($conn);
   
     ?>
  </div>

</nav>


<!-- Side bar -->


<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

  <a href="https://stackoverflow.com/"><img border="0" alt="W3Schools" src="1.png" width="200" height="35"></a>
  <a href="https://www.codecademy.com/"><img border="0" alt="W3Schools" src="2.png" width="200" height="35"></a>
  <a href="https://www.coursera.org/"><img border="0" alt="W3Schools" src="3.png" width="200" height="35"></a>
  <a href="https://www.edx.org/course"><img border="0" alt="W3Schools" src="4.png" width="200" height="35"></a>
</div>

		
<div id="mySidenav1" class="sidenav1">
  <a href="#" id="about" onclick="openNav()" >Sites</a>
</div>











    <div id="wrapper">
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
					

						<!-- strat of prev-sent-mesaage                                                                                   -->
                         <?php
                          $all_messages_array=array();
                          $farr=array();
                        $serverSql = "localhost";
                                $usernameSql = "root";
                                $passwordSql = "";
                                $dbnameSql = "learn";
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
						<!-- end of Message                                                                                     -->
                        
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
                        <li><a href="../../logouthandler.php" ><i class="fa fa-sign-out fa-fw"></i> Logout</a><!--                    here logouthandler then firstpage-->
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->


            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"></div><!--here                start of repeated part of templates-->
                                    <div>Lectures</div>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="sources.php">

                        <button id = "zorar" type="submit" name="Lectures">


                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>


                            </div>
                        </button>

                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                    <?php
                                    if($refnum>=0){
                                    echo $refnum;
                                    }else{echo "404 data not found<br/> can't connect to database";}
                                    ?>

                                    </div>
                                    <div>refrences</div>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="sources.php">

                        <button id = "zorar" type="submit" name="refrences">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                       </form>

                        </button>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-youtube-play fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                    <?php
                                    if($plylstnum>=0){
                                    echo $plylstnum;
                                    }else{echo "404 data not found<br/> can't connect to database";}
                                    ?>

                                    </div>
                                    <div>PlayLists!</div>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="sources.php">

                        <button id = "zorar" type="submit" name="playlists">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                    <?php
                                                        if($profnum>=0){
                                    echo $profnum;
                                    }else{echo "404 data not found<br/> can't connect to database";}
                                    ?>

                                    </div>
                                    <div>Professors</div>
                                </div>
                            </div>
                        </div>
                        <a href="prof.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
			
			
			
			
			
			
			
			
			
			<!-- ==================================================================================================================== 
				======================================================================================================================
				======================================================================================================================
				======================================= Time line AREA ===============================================================
				
				things that needs to be updated 3 things TITLE of the Note and inte body and time ago ... you have comments below where to add them -->
			
			

			
		<?php	
        if(!$visitor){
            $tmstr=null;
             $serverSql = "localhost";
    $usernameSql = "root";
    $passwordSql = "";
    $dbnameSql = "learn";
    $conn = mysqli_connect($serverSql,$usernameSql,$passwordSql,$dbnameSql);
    if(!$conn){
        die("connection failed we are working in fixing this error :) >> ".mysqli_connect_error());
    }

$sql = "SELECT * FROM signup where username = '".$_SESSION['username']."'";
    $result1 = mysqli_query($conn,$sql);
    if($result1){
        $row =  mysqli_fetch_assoc($result1);
        $tmstr = $row['timeline'];
        
}
    mysqli_close($conn);
$timed=explode('#', $tmstr);

			echo '
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">


                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-clock-o fa-fw"></i> your Timeline
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <ul class="timeline">
                ';
							

    //-------------------------------------------------------------------------biso--------------------------------
            //===============================================working area===============================================================
    foreach ($timed as $timepack) {

        $pkarr=explode('-', $timepack);
        if(count($pkarr)!=3){
            continue;
        }
        if(true){
    echo '
                            <!-- left Note in time line -->
                                <li> 
                                    <div class="timeline-badge"><i class="fa fa-check"></i>
                                    </div>
                                    <div id = "sajed" class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">'
        .$pkarr[0].//Title of note 
                                            '</h4>
                                            <p><small class="text-muted"><i class="fa fa-clock-o"></i><a href="'
        .$pkarr[2].//ime posted ago 
                                            '">try it</a></small>
                                            </p>
                                        </div>
                                        <div class="timeline-body">
                                            <p>'
        .$pkarr[1].//<!-- Body of note-->
                                            '</p>
                                        </div>
                                    </div>
                                </li>
        ';              
                                
}else{
    echo '

                            <!-- right Note in time line -->
                                <li class="timeline-inverted">
                                    <div class="timeline-badge success"><i class="fa fa-graduation-cap"></i>
                                    </div>
                                    <div id = "sajed"class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">'
        .$pack[0].//Title of note 
                                            '</h4>
                                             <p><small class="text-muted"><i class="fa fa-clock-o"></i><a href="'
        .$pack[2].//ime posted ago 
                                            '"> try it</a></small>
                                            </p>
                                        </div>
                                        <div class="timeline-body">
                                            <p>'
        .$pack[1].//<!-- Body of note-->
                                            '</p>
                                        </div>
                                    </div>
                                </li>
        ';
    }
}
    
/*
$arr= array(null,null,null,null); 
$arrbig=array();

array_push($arrbig, $arr);
$serverSql = "localhost";
$usernameSql = "root";
$passwordSql = "";
$dbnameSql = "learn";
$conn = mysqli_connect($serverSql,$usernameSql,$passwordSql,$dbnameSql);
if(!$conn){
    die("connection failed we are working in fixing this error :) >> ".mysqli_connect_error());
}
$sql = "SELECT * from timeline";
$result = mysqli_query($conn,$sql);
if($result){
    while($row =  mysqli_fetch_assoc($result)){
        $arr = array($row['title'],$row['content'],$row['date'],$row['RL']);
        array_push($arrbig, $arr);
    }
}else{
    $arrbig=array(array("Developers","start filling your time line now.","-",1));
}
mysqli_close($conn);


//=======================================================================================================================
foreach ($arrbig as $pack) {
if($pack[3]==1){
    echo '
							<!-- left Note in time line -->
                                <li> 
                                    <div class="timeline-badge"><i class="fa fa-check"></i>
                                    </div>
                                    <div id = "sajed" class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">'
        .$pack[0].//Title of note 
                                            '</h4>
                                            <p><small class="text-muted"><i class="fa fa-clock-o"></i>'
        .$pack[2].//ime posted ago 
                                            '</small>
                                            </p>
                                        </div>
                                        <div class="timeline-body">
                                            <p>'
        .$pack[1].//<!-- Body of note-->
                                            '</p>
										</div>
                                    </div>
                                </li>
		';				
								
}else{
    echo '

							<!-- right Note in time line -->
                                <li class="timeline-inverted">
                                    <div class="timeline-badge success"><i class="fa fa-graduation-cap"></i>
                                    </div>
                                    <div id = "sajed"class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">'
        .$pack[0].//Title of note 
                                            '</h4>
											 <p><small class="text-muted"><i class="fa fa-clock-o"></i>'
        .$pack[2].//ime posted ago 
                                            '</small>
                                            </p>
                                        </div>
                                        <div class="timeline-body">
                                            <p>'
        .$pack[1].//<!-- Body of note-->
                                            '</p>
                                        </div>
                                    </div>
                                </li>
        ';
    }

}
}
*/
}
?>
<?php   
        if(!$visitor){
echo '
                            </ul>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
    '
    ;
				
				}
				?>
				
				
				
				<!-- ==================================================================================================================== 
				======================================================================================================================
				======================================================================================================================
                sending message form ajax
                available  and so on
                get array of arrays mesage from date , from database
				======================================= CHAT AREA ==================================================================
                things that needs to be updated 4 things the name of person the time ago the massage and the image of the person 
                you have comments below to know where to put them-->
				

<?php 
if(!$visitor){
    echo '

				
				
                <!-- /.col-lg-8 -->
                <div id = "chat1">

                    <!-- /.panel -->
                    <div class="chat-panel panel panel-default">
                        <div class="panel-heading" href="chat.php">
                            <i class="fa fa-comments fa-fw chatName"></i> 
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu slidedown">
									<li>
                                        <a href="chat.php">
                                            <i class="fa fa-times fa-fw"></i> Full chat
                                        </a>
                                    </li>
                                    
                                    <li class="divider"></li>
                                    <li onclick="closeChat();">
                                        <a >
                                            <i class="fa fa-sign-out fa-fw"></i> Close
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.panel-heading -->








                   <div class="panel-body">
                    ';
}
?>
                        <?php
                        if(!$visitor){
                            $all_messages_array=array();
                            if(isset($_SESSION['chatting'])){
                                $to=$_SESSION['chatting'];
                                $code=mk_message_code($to,$username);

                            //----------------------------------------------------------------------------------------biso---------------------
                            //
                            //==============================================working area===========================================================
 //you have $code ,, return the next three columns (message,from,date); put them in array1 represents one messae;put this array1 in whole messages array
                                $Single_message_array=array();  
                                $serverSql = "localhost";
                                $usernameSql = "root";
                                $passwordSql = "";
                                $dbnameSql = "learn";
                                $conn = mysqli_connect($serverSql,$usernameSql,$passwordSql,$dbnameSql);
                                if(!$conn){
                                    die("connection failed we are working in fixing this error :) >> ".mysqli_connect_error());
                                }
                                $sql = "SELECT * from chat where code = '$code'";//where is the code massage that we agreed on!
                                $result = mysqli_query($conn,$sql);
                                if($result){
                                    while($row =  mysqli_fetch_assoc($result)){
                                        $Single_message_array = array($row['message'],$row['fromchat'],$row['Date'],$row['Date']);
                                        array_push($all_messages_array, $Single_message_array);
                                    }
                                }else{
                                    echo "no messages !!";
                                }
                                mysqli_close($conn);
                        

                            //============================================================================================

                            }
                        foreach ($all_messages_array as $messageinf){
                            $avatarr=null;
                            $serverSql = "localhost";
                                $usernameSql = "root";
                                $passwordSql = "";
                                $dbnameSql = "learn";
                                $conn = mysqli_connect($serverSql,$usernameSql,$passwordSql,$dbnameSql);
                                if(!$conn){
                                    die("connection failed we are working in fixing this error :) >> ".mysqli_connect_error());
                                }
                                $sql = "SELECT * from signup where username = '$messageinf[1]'";//where is the code massage that we agreed on!
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
                            echo ' <ul class="chat">';
                            if($messageinf[1]==$username){
                               echo'                                                 <!-- first person -->
                                                                                <li class="left clearfix">
                                                                                    <span class="chat-img pull-left">
                                                                                        <img src="'
                                    .$avatarr.//avatar
                                                                                        '" alt="User Avatar" height="35" width="35" class="img-circle" />
                                                                                    </span>
                                                                                    <div class="chat-body clearfix">
                                                                                        <div class="header">
                                                                                            <strong class="primary-font">' 
                                    .$username.                         
                                                                                            '</strong>
                                                                                            <small class="pull-right text-muted">
                                                                                                <i class="fa fa-clock-o fa-fw">'
                                    .$messageinf[2].//date
                                                                                                '</i>                         
                                                                                            </small>
                                                                                        </div>
                                                                                        <p>'
                                    .$messageinf[0].//message                                                                  
                                                                                        '</p>
                                                                                    </div>
                                                                                </li>
                                    ';
                            }
                            else{
                                  echo '                                                        <!-- second person -->
                                                                                                <li class="right clearfix">
                                                                                                    <span class="chat-img pull-right">
                                                                                                        <img src="'
                        .$avatarr.//avatar
                                                                                                        '" alt="User Avatar" height="35" width="35" class="img-circle" />
                                                                                                    </span>
                                                                                                    <div class="chat-body clearfix">
                                                                                                        <div class="header">
                                                                                                            <small class=" text-muted">
                                                                                                                <i class="fa fa-clock-o fa-fw"></i>'
                        .$messageinf[2]. //date
                                                                                                                '</small>
                                                                                                            <strong class="pull-right primary-font">'
                        .$messageinf[1].//usernam
                                                                                                            '</strong>
                                                                                                        </div>
                                                                                                        <p>'
                        .$messageinf[0].  //message
                                                                                                        '</p>
                                                                                                    </div>
                                                                                                </li>'

                                                                                           ;
                            }

                        }
                        echo ' </ul>';
                        }

                        ?>
                        </div>
                           
                        <?php

                        if(!$visitor){
                            echo '
                        <!-- /.panel-body -->
                        <div class="panel-footer">
                            <div class="input-group">
                            <form  id = "chatForm" action="../../chathandler.php" method="POST">                                                    
                                <input name="message" id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                                <input name="to" id="btn-input2" type="text" class="form-control input-sm" placeholder="send to ..." />

                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-warning btn-sm" id="btn-chat" name="chatsend">
                                        Send

                                    </button>
                                    </span>
                                    </form>
               
                            </div>
                        </div>
';}

?>

                        <!-- /.panel-footer -->
                    </div>
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
		<script>

	
/* Set the width of the side navigation to 250px and the left margin of the page content to 250px and add a black background color to body */
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
	document.getElementById("wrapper").style.opacity = 0.4;

}



/* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
function closeNav() {
	opened = false;
    document.getElementById("mySidenav").style.width = "0";
	document.getElementById("wrapper").style.opacity = 1;
	
}
</script>

<!--Who is online -->

<script>


function myFunc(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show"; 
        x.previousElementSibling.className += " w3-red";
    } else { 
        x.className = x.className.replace(" w3-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace(" w3-red", "");
    }
}

function openChat(id, ideh) {
	$("#chat1").slideToggle(1000);
	$('input[name=to]').val(ideh);
	$('.chatName').text(ideh);


	myFunc(id);
}

function closeChat() {
	$("#chat1").slideToggle(500);
}

</script>




</body>

</html>
