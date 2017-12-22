<?php
session_start();

//-----------------------------------------------------------biso -----------------------
// get data and put in $profs
//=================================================work here====================================================
//make virtual data ,, get them in array of arrays as shown below in profs                   --img is a link--
$serverSql = "localhost";
    $usernameSql = "id771390_root";
    $passwordSql = "372816";
    $dbnameSql = "id771390_learn";
$conn = mysqli_connect($serverSql,$usernameSql,$passwordSql,$dbnameSql);
if(!$conn){
    die("connection failed we are working in fixing this error :) >> ".mysqli_connect_error());
}
$sql = "SELECT * from doc";
$result = mysqli_query($conn,$sql);
$profA =  array();


while($row =  mysqli_fetch_assoc($result)){
    $temp = array($row["imglink"],$row["name"],$row["content"],$row["jobtitle"]);
    array_push($profA, $temp);
}
mysqli_close($conn);





//=================================================================================================
$profs = $profA;

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Professors</title>

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
	        <script type="text/javascript" src="jquery.min.js"></script>

</head>

<body>

    <div id="wrapper">

	
	<!-- ========================================================================================================================
	=================================All what you need to change is at lie 267-->
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
                        <li><a href="login.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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



					<!-- Page Content -->
					

						<!-- Introduction Row -->
						<div class="row">
							<div class="col-lg-12">
								<h1 class="page-header">Professors</br>
									<small>All What you need to know about your professors</small>
								</h1>
								<p></p>
							</div>
						</div>

						<!-- Team Members Row -->
						<div class="row">
							<div class="col-lg-12">
								<h2 class="page-header">Our Team</h2>
                                <?php

                                foreach ($profs as $prof) {
                                   echo '
							</div>
							<div class="col-lg-4 col-sm-6 text-center">
								<img class="img-circle img-responsive img-center" src="'
             .$prof[0].//<!-- Image here -->
                                '" alt="sajed">
								<h3>'
             .$prof[1].// <!-- prof NAME-->
									'<small>'
            .$prof[2]. //<!-- Job title here-->
                                    '</small>
								</h3>
								<p>'
            .$prof[3].//<!-- little discreption here -->
                                '</p>
							</div>

						</div>';
                            }
                            ?>






                    
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
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

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
