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

if(isset($_SESSION['username'])){
						header('Location: userSide\pages\index.php');
}else if(!isset($_SESSION['Vcode'])){
	session_unset();
	session_destroy();
}



$avnum=15;

function Specialchars($str){ // turn tags into string
	return strip_tags(filter_var($str,FILTER_SANITIZE_SPECIAL_CHARS));
}
function Anumber($int){
	return filter_var($int,FILTER_SANITIZE_NUMBER_INT);
}
function Validateemail($email){
	return filter_var($email,FILTER_VALIDATE_EMAIL);
}
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
//=========================================================================================================
}
$signuperrormessage=array();
$signinerrormessage=array();
$av;
if($_SERVER['REQUEST_METHOD']=='POST'){

if(isset($_POST['signup'])){//if signup submit button

		if(isset($_POST['g-recaptcha-response'])){
			$captcha=$_POST['g-recaptcha-response'];
			if(!$captcha){
				array_push($signuperrormessage,"tell us if you are a robot or not");
          
        }

		}

		
       
     
					
			if($_POST['firstname']==null){
				array_push($signuperrormessage,"you didn't fill a non-optional cell-firstname");
			}else{
				$firstname=Specialchars($_POST['firstname']);
			}


			if($_POST['lastname']==null){
				array_push($signuperrormessage,"you didn't fill a non-optional cell-lastname");
			}else{
				$lastname=Specialchars($_POST['lastname']);
			}


			if($_POST['username']==null){
				array_push($signuperrormessage,"you didn't fill a non-optional cell-username");
			}else{
				$username=Specialchars($_POST['username']);
			}
			if(repeatedusername($username)){
				array_push($signuperrormessage,"username already exists");
			}


			if($_POST['password']==null){
				array_push($signuperrormessage,"you didn't fill a non-optional cell-password");
			}else{
				$password=Specialchars($_POST['password']);
				$cpassword=Specialchars($_POST['cpassword']);
				if($password!=$cpassword){
					array_push($signuperrormessage,"comfirmed password isn't correct ");
				}
				else if(strlen($password)<8){
					array_push($signuperrormessage,"your password must be more than or equal 8 characters");
				}
			}


			if($_POST['email']==null){
				array_push($signuperrormessage,"you didn't fill a non-optional cell-email");
			}elseif(!Validateemail($_POST['email'])){
				array_push($signuperrormessage,"the email you entered isn't validated");
			}else{
				$email=$_POST['email'];
			}


			if($_POST['day']=='0'||$_POST['month']=='0'||$_POST['year']=='0'){
				array_push($signuperrormessage,"Date of birth wasn't selected");
			}
			$DOB=$_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];

			$mobile=Anumber($_POST['mobile']);

			$university=Specialchars($_POST['university']);

			$faculty=Specialchars($_POST['faculty']);

			$department=Specialchars($_POST['department']);


			//----------------
			$interests=array();
			$interests1=null;
			if (isset($_POST['Science'])) {
		    	array_push($interests,'Science');
		    }
		    if (isset($_POST['Geology'])) {
		    	array_push($interests, 'Geology');
		    }
		    if (isset($_POST['Biology'])) {
		    	array_push($interests, 'Biology');
		    }
		    if (isset($_POST['Archeticture'])) {
		    	array_push($interests, 'Archeticture');
		    }
		    $counter=0;
		    foreach ($interests as $i) {

		    	if ($counter!=0){
		    	$interests1 .='-'.$i;
		    }else{
		    	$interests1.=$i;
		    	$counter =1;
		    }

$bbc=0;
		    	for($i=1;$i<=$avnum;$i++){
		    		$sss="av".$i;
		    if (isset($_POST[$sss])) {
		    	$av=$_POST[$sss];
		    	$bbc++;
		    }
		}
if($bbc==0){$av=$_POST['av1'];}

		}
		    //---------------


		    if($_POST['gender']=='0'){
		    	array_push($signuperrormessage,"gender wasn't selected");
		    }else{
		    	$gender=$_POST['gender'];
		    }



				if(count($signuperrormessage)!=0){

					foreach ($signuperrormessage as $error) {
						echo 
								'<div class="alert alert-danger">'.
								'<strong>'.$error.'</strong></div>';
					}
			
				}else{
					echo "sign up was successfull<br>";
					session_start();
					$Vcode=rand(1000000,9999999);
				
					$encrypted_pass=password_hash($password,PASSWORD_DEFAULT);
					$_SESSION['data']=array($firstname,$lastname,$username,$encrypted_pass,$email,$DOB,$mobile,$university,$faculty,$department,$interests1,$gender,$av);
					//all data
					$_SESSION['Vcode']=$Vcode;
					mail($email,
						'verification message',
						'your vcode for learn project is: '.$Vcode,
						'From: one@leaRN.project'
						) ;                                          
				
					header('Location: vcode.php');

					}
}elseif(isset($_POST['signin'])){ // if signin submit button

				$username=$_POST['username'];
				$password=$_POST['password'];
				$username=filter_var($username,FILTER_SANITIZE_SPECIAL_CHARS);
				$realpassword = null;

				//search for username - if found return password in $realpasword - else return null in realpassword-----------BISO-----write down---------------------------------
				
				//===================================================working area==================================================================================
				$serverSql = "localhost";
    $usernameSql = "id771390_root";
    $passwordSql = "372816";
    $dbnameSql = "id771390_learn";
				$conn = mysqli_connect($serverSql,$usernameSql,$passwordSql,$dbnameSql);
				if(!$conn){
					die("connection failed we are working in fixing this error :) >> ".mysqli_connect_error());
				}
				$sql = "SELECT pass from signup where username = '$username'";
				$result = mysqli_query($conn,$sql);
				if($result){
					$row = mysqli_fetch_assoc($result);
					$realpassword = $row['pass'];
				}else{
					$realpassword = null;
				}
				mysqli_close($conn);
				//===================================================================================================



				$decrypted_pass=password_verify($password,$realpassword);
				if($realpassword==null){
					$signinerrormessage = "email is't correct";
				}elseif($password!=$decrypted_pass){
					$signinerrormessage = "password is't correct";
				}else{
					session_start();

					$_SESSION['username'] = $username;
					online(1,$username);
					header('Location: userSide\pages\index.php');
					die("unable to connect to index.php");
				}

}elseif(isset($_POST['Vcodeb'])){
                                                           
			
			if($_POST['userEntered']==$_SESSION['Vcode']){
			echo "welldone <br>now you have an active email on learn";
			$arr12=$_SESSION['data'];
		   
			//------------------------------------					$_SESSION['data']=array($firstname,$lastname,$username,$encrypted_pass,$email,$DOB,$mobile,$university,$faculty,$department,$interests1,$gender);
//-----------------------------------------------------store above data -in arr12- in signupdatabase-----------------------------------biso ---------------
			//=======================================================working area============================================================================
				$firstname = $arr12[0];
				$lastname = $arr12[1];
				$username = $arr12[2];
				$encrypted_pass = $arr12[3];
				$email = $arr12[4];
				$DOB = $arr12[5];
				$mobile = $arr12[6];
				$ay7amada = $arr12[7];
				$faculty = $arr12[8];
				$department = $arr12[9];
				$interests1 = $arr12[10];
				$gender = $arr12[11];
				$av1=$arr12[12];

				$serverSql = "localhost";
    $usernameSql = "id771390_root";
    $passwordSql = "372816";
    $dbnameSql = "id771390_learn";
				$conn = mysqli_connect($serverSql,$usernameSql,$passwordSql,$dbnameSql);
				if(!$conn){
					die("connection failed we are working in fixing this error :) >> ".mysqli_connect_error());
				}
				$sql = "INSERT into signup (firstname,lastname,username,pass,Email,DOB,mobile,faculty,department,interest,gender,avlink) VALUES('$firstname','$lastname','$username','$encrypted_pass','$email','$DOB','$mobile','$faculty','$department','$interests1','$gender','$av1')";
				$result = mysqli_query($conn,$sql);
				mysqli_close($conn);
//============================================================================================================================================
			session_unset();
			session_destroy();

		}
	}
}

?>




<!DOCTYPE html>

<html>






	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="with = device-width, initial-scale=1" />
		<link rel="stylesheet"  href="css/mystyle.css" />
	    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
		<link rel="stylesheet"  href="css/mystyle.css" />
		
		<!-- Sign Up -->
		<link rel="stylesheet" type="text/css" href="css/style.css"><!--VIP-->
		<meta name="viewport" content="width=device-width, initial-scale=1"><!--display-mbile-->
		<script src="js/html5shiv.min.js"></script><!--VIP-->
		<script src="js/respond.min.js"></script><!--VIP-->

		
		
		<!-- transition -->
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<link rel="stylesheet" type="text/css" href="css/animations.css" />
		<script src="js/modernizr.custom.js"></script>
		
		<!-- more info -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<link href="styleinfpage.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



		<title>LeaRN</title>
		<script src='https://www.google.com/recaptcha/api.js'></script>

	</head>


	<body>
	

	
	
	
		<div id="pt-main" class="pt-perspective">
			<div class="pt-page pt-page-1">
				
				
						<div class="container">
			
			<!--
			<div id = "slider">
		
				<div id="upperinfo" class="jumbotron collapse">
				
				    <img id="imglogo"src="images/44.png" alt="logo" />
					
					
					<p id="slogan">LeaRN and let them burn<br/>deal with it !!</p>
					
					
					<p id="notiP">
					LeaRN is a web-based application enables you to organize your time ,comunicate with friends ,share information ,create learning-groupes and more .<br/>All in an easy and efficient way .<br/>
					</p>
					
					<div id="moreinf">
					<a href="info2/index.html"><button  class="btn btn-success btn-xs">More Information</button></a>
					</div>
				</div>
				
				
				<a id="notificationlink" href="#upperinfo" data-toggle="collapse">
				<div id="nbar" class="row">
				<div id="notification">
				<span  class="glyphicon glyphicon-chevron-down">. ABOUT THE WEBSITE  .</span><span  class="glyphicon glyphicon-chevron-down"></span>
				</div>
				</div>
				</a>
			</div
			-->
			
			<div id = "slider">
				<div id = "sliderContent" >
								    
					<img id="imglogo"src="images/44.png" alt="logo" />
					
					<div id = "explaningContent">
					<p id="slogan">LeaRN and let them burn<br/>deal with it !!</p>
										
					<p id="notiP">
					LeaRN is a web-based application enables you to organize your time ,comunicate with friends ,share information ,create learning-groupes and more .<br/>All in an easy and efficient way .<br/>
					</p>
					
					<div id="moreinf">
					<a href="info2/index.html"><button  class="btn btn-success btn-xs">More Information</button></a>
					</div>
					</div>
				
				
				</div>
				
				<!-- the row with arrow to be slided -->
				<div id="nbar2" class="row">
				<div id="notification2">
				<span  class="glyphicon glyphicon-chevron-up">. ABOUT THE WEBSITE  .</span><span  class="glyphicon glyphicon-chevron-up"></span>
				</div>
				</div>
				
			</div>
			
				<div id="nbar" class="row">
				<div id="notification">
				<span  class="glyphicon glyphicon-chevron-down">. ABOUT THE WEBSITE  .</span><span  class="glyphicon glyphicon-chevron-down"></span>
				</div>
				</div>
				
				
				<div id="main" >
				<br/><br/>
				<p id="caption"><div id="welcomemessage">Welcome to LeaRN</div>
				<p>
				<br/><h3 id="slogan1"> We complete your intelegence </h3><br/><h3 id="letsgomessage">Have a great experience by singing up</h3><br/></p></p>
				
					
				<div id="dl-menu" class="dl-menuwrapper ses">
					<ul class="dl-menu">
								<li data-animation="3" id="btnalign" class ="down"><a id="btnlink" class="btn btn-default btn-lg" href="#">Start</a></li>
					</ul>
				</div><!-- /dl-menu-wrapper-->
				

				
				
				
				</div>
				</div>
				
				
				<footer class="container-fluid">
				<div id = "footerContent" class="row">
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 ">About the website<br/>website malosh 3aza<br/>athlnn</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 ">contact us<br/>gmail:<a href="#">abdelrahmanahmed882@gmail.com</a><br/>facebook:www.facebook.com/aybtngan<br/>twitter: www.twitter.com/ay7aga</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 ">The Developers<br/>Abdelrahman<br/>Sajed<br/>Bassam</div>

				</div>
				</footer>

				
			
			</div>

<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->		
			
			
			
			
			<div class="pt-page pt-page-2">
			
				
<!--NavBar-->
<nav class="navbar navbar-inverse navbar-fixed-top" background="image/signGround">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
       <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
         <span class="icon-bar"></span>
        <span class="icon-bar"></span>
       </button>
      <a class="navbar-brand" href="#">LeaRN</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
     <form method="POST" action="firstpage.php" class="navbar-form navbar-left" >
       <div class="form-group">
        <input name="username" type="text" class="form-control" placeholder="User name">
         <input name="password" type="Password" class="form-control" placeholder="Password">
          </div>
         <button type="submit" name="signin" class="btn btn-default">Sign in</button>
        </form>
      </div><!-- /.navbar-collapse -->
     </div><!-- /.container-fluid -->
    </nav>
<!--NavBar-->
<!--===============================================================-->
	<div class="container">
		<form method="POST" action="firstpage.php" class="signUp"><!---->
		
		<br></br>
																<div class="row">
																	<div class="col-xs-2">
																		<p class="lead">
																			Name :
																		</p>
																	</div>
																	<div class="col-xs-4" >
																		<input name="firstname" type="text" class="form-control" placeholder="First name">
																	</div>
																	<div class="col-xs-4">
																		<input name="lastname" type="text" class="form-control" placeholder="last name">
																	</div>	
																</div>
		<div class="row">
			<div class="col-xs-3">
				<p class="lead">
					User Name :
				</p>
			</div>
			<div class="col-xs-8 col-xs-pull-1" >
				<input name="username" type="text" class="form-control" placeholder=" name that you will sign in by">
			</div>	
		</div>
																	<div class="row">
																		<div class="col-xs-3">
																			<p class="lead">
																				Password :
																			</p>
																		</div>
																		<div class="col-xs-8 col-xs-pull-1" >
																			<input name="password" type="password" class="form-control" placeholder="password">
																		</div>	
																	</div>
		<div class="row">      
			<div class="col-xs-3">
				<p class="lead">
					Confirm :
				</p>
			</div>
			<div class="col-xs-8 col-xs-pull-1" >
				<input name="cpassword" type="password" class="form-control" placeholder="confirm password">
			</div>	
		</div>
													<div class="row">
														<div class="col-xs-3">
															<p class="lead">
																E-mail :
															</p>
														</div>
														<div class="col-xs-8 col-xs-pull-1" >
															<input name="email" type="text" class="form-control" placeholder=" E-mail">
														</div>	
													</div>

																								<div class="row">
																									<div class="col-xs-3">
																										<p class="lead">
																											Date Of Birth :
																										</p>
																									</div>
																									<div class="col-xs-3 col-xs-pull-1" >
																										<select name="day" class="Select">
																										<option value='0'>Day</option>
																											<?php 
																											for($i=1;$i<32;$i++){
																												echo
																													'<option value="'.$i.'">'.$i.'</option>';
																													;
																											}
																											?>
																										</select>
																									</div>
																									<div class="col-xs-3 col-xs-pull-1" >
																										<select name="month" class="Select">
																											<option value ='0'>Month</option>
																											<option value='1'>Jan</option>
																											<option value="2">Feb</option>
																											<option value="3">Mar</option>
																											<option value="4">Apr</option>
																											<option value="5">May</option>
																											<option value="6">Jun</option>
																											<option value="7">Jul</option>
																											<option value="8">Aug</option>
																											<option value="9">Sep</option>
																											<option value="10">Oct</option>
																											<option value="11">Nov</option>
																											<option value="12">Dec</option>

																										</select>
																									</div>
																									<div class="col-xs-3 col-xs-pull-2" >
																										<select name="year" class="Select">
																										<option value='0'>Year</option>
																											<?php 
																											for($i=2005;$i>=1900;$i--){
																												echo '<option value="'.$i.'">'.$i.'</option>';
																													
																											}
																											?>
																										</select>
																									</div>	
																								</div>
<div class="row">
	<div class="col-xs-3">
		<p class="lead">
			Mobile number :
		</p>
	</div>
	<div class="col-xs-8 col-xs-pull-1" >
		<input name= "mobile" type="text" class="form-control" placeholder=" Mobile Number">
	</div>	
</div>
								<div class="row">
									<div class="col-xs-3">
										<p class="lead">
											University :
										</p>
									</div>
									<div class="col-xs-8 col-xs-pull-1" >
										<input name="university" type="text" class="form-control" placeholder=" Univesity">
									</div>	
								</div>
								<div class="row">
									<div class="col-xs-3">
										<p class="lead">
											Faculty :
										</p>
									</div>
									<div class="col-xs-8 col-xs-pull-1" >
										<input name="faculty" type="text" class="form-control" placeholder=" Faculty">
									</div>	
								</div>
<div class="row">
	<div class="col-xs-3">
		<p class="lead">
			Department :
		</p>
	</div>
	<div class="col-xs-8 col-xs-pull-1" >
		<input name="department" type="text" class="form-control" placeholder=" Department">
	</div>	
</div>
																					<div class="row">
																						<div class="col-xs-3">
																							<p class="lead">
																								interested in :
																							</p>
																						</div>
																						<div class="col-xs-4 col-xs-pull-1 " style="color: #FFF">
																								<input  type="checkbox" name="Science">Science</input><br/>
																								<input type="checkbox" name="Geology">Geology</input><br/>
																								<input type="checkbox" name="Biology">Biology</input><br/>
																								<input type="checkbox" name="Archeticture">Archeticture</input>
																						</div>	
																					</div>
		<div class="row">
			<div class="col-xs-3">
				<p class="lead">
					Gender :
				</p>
			</div>
		</div>
			<div class="col-xs-4 col-xs-pull-1">
				<select name="gender" class="Select">
					<option value='0' >Gender</option>
					<option value="male">Male</option>
					<option value="female">Female</option>
				</select>
			</div>
			<br/><h2>choose an avatar :</h2>
			<div class="col-l-1 col-xs-4 col-xs-pull-1 " style="color: #FFF">
			<?php
			for($i=1;$i<=$avnum;$i++){
				echo'		<input  type="radio" name="av1" value="avatars/'.$i.'.png"><img src="avatars/'.$i.'.png" alt="avatar" height="75" width="75"/></input>';
				if($i%3==0){
					echo "<br/>";
					}
				}
?>						

				</div>	




			<br></br>

								<div class="row">
									<div class="col-xs-4 col-xs-push-5">
										<button class="btn btn-success" type="submit" name="signup">Sign Up</button>
													<div class="g-recaptcha" data-sitekey="6LeDnh0UAAAAAObrYAfWm1q_JIEXTgX20h8IjdNL"></div>


									</div>
								</div>	
		</form>
	</div> 
				
			
			</div>
		</div>
	
	
	

	
			    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

			<script src="js/jquery-3.1.1.min.js"></script>
			<script src="js/bootstrap.js"></script>
			<script src="js/jquery.dlmenu.js"></script>
			<script src="js/pagetransitions.js"></script>
			<script src="js/myscript.js"></script><!--VIP-->
			<script src="js/sajed.js"></script>



	</body>
	
	
</html>