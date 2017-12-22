<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Chat</title>

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
	
	
	<!-- =====================================================================================
	===========================================================================================
	================all what you need to change is att lines 265 and 318 -->

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
                        <li>
                            <a href="#">
                                <div>
                                    <strong><!-- put thr name here --></strong>
                                    <span class="pull-right text-muted">
                                        <em><!-- Put time ago here  --></em>
                                    </span>
                                </div>
                                <div><!-- put message here --></div>
                            </a>
                        </li>
						
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

		
		
		
		
		
		
		<div id = "chating">
		
			<div class="container-fluid">
			<div class="row">
				<div class="col-md-3">
					 <div class="row chats-row">
						<div class="col-md-12">
							<a href="#" id = "chatinfo" class="list-group-item open-request">
								<img id = "chatimage" src = "<!-- Image of sa7eb al account -->"></img>
								<div id = "chatPersonInfo">
							   <p><strong>Name:</strong> <!-- name of sa7eb alaccount --></p>
							   <p><strong>Email:</strong>   <!-- email sa7eb alaccount --></p>
							   <p><strong>Time:</strong>   <!--  time ago last online or online now --></p>
							   <p><strong>Message:</strong>   <!-- ay 7aga 3n sa7eb al account  --></p>
							   </div>
							</a>
						</div>
						<div class="col-md-12">
							<a href="#" id = "chat1" class="list-group-item">Ordinary Chat</a>
							<a href="#" id = "chat2"  class="list-group-item list-group-item-success">Sources</a>
							<a href="#" id = "chat3" class="list-group-item active">Image</a>
						</div>
					 </div>
				</div>
				
				
				<div id = "chatContents" >
				
				
				<div id = "chatContent1" class="col-md-9 current-chat">
					<div class="row chat-toolbar-row">
						<div class="col-sm-12">
							<div class="btn-group chat-toolbar" role="group" aria-label="...">
								<button id="chat-leave" class="btn btn-default ticket-option" type="button">
								  <i class="glyphicon glyphicon-remove-sign"></i> Leave Chat
								</button>
								<button id="chat-invite" class="btn btn-default ticket-option" type="button">
								  <i class="glyphicon glyphicon-plus"></i> Invite
								</button>
								<button id="chat-customer" class="btn btn-default ticket-option" type="button">
								  <i class="glyphicon glyphicon-user"></i> Option1 eh ?
								</button>
								<button id="chat-create-ticket" class="btn btn-default ticket-option" type="button">
								  <i class="glyphicon glyphicon-pencil"></i> Option2 tb eh ?
								</button>
								<button id="chat-add-ticket" class="btn btn-default ticket-option" type="button">
								  <i class="glyphicon glyphicon-plus"></i> Option3tb eh ??
								</button>
								<button id="chat-open-ticket" class="btn btn-default ticket-option" type="button">
								  <i class="glyphicon glyphicon-open"></i> Option4
								</button>
							</div>
						</div>
					</div>
					<div class="row current-chat-area">
						<div class="col-md-12">
							  <ul class="media-list">
								<li class="media">
									<div class="media-body">
										<div class="media">
											<a class="pull-left" href="#">
												<img class="media-object img-circle " src="<!-- image here of first person -->">
											</a>
											<div class="media-body">
												 <!-- message bode here  -->
												<br>
											   <small class="text-muted"> <!-- name of person | ime ago  --> </small>
												<hr>
											</div>
										</div>
				
									</div>
								</li>
								<li class="media">
									<div class="media-body">
										<div class="media">
											<a class="pull-left" href="#">
												<img class="media-object img-circle " src="<!-- image here of second person-->">
											</a>
											<div class="media-body">
												<!-- message bode here  -->
												<br>
											   <small class="text-muted"> <!-- name of person | ime ago  --></small>
												<hr>
											</div>
										</div>
									</div>
								</li>
							</ul>  
						</div>
					</div>
					<div class="row current-chat-footer">
					<div class="panel-footer">
						<div class="input-group">
						  <input type="text" class="form-control">
						  <span class="input-group-btn">
							<button class="btn btn-default" type="button">Send</button>
						  </span>
						</div>
						</div>
					</div>
				</div>
				
				
				
				
				
				
				
				
				
				
				
				<div id = "chatContent2" class="col-md-9 current-chat">
					<div class="row chat-toolbar-row">
						<div class="col-sm-12">
							<div class="btn-group chat-toolbar" role="group" aria-label="...">
								<button id="chat-leave" class="btn btn-default ticket-option" type="button">
								  <i class="glyphicon glyphicon-remove-sign"></i> Leave Chat2
								</button>
								<button id="chat-invite" class="btn btn-default ticket-option" type="button">
								  <i class="glyphicon glyphicon-plus"></i> Invite
								</button>
								<button id="chat-customer" class="btn btn-default ticket-option" type="button">
								  <i class="glyphicon glyphicon-user"></i> Open Customer
								</button>
								<button id="chat-create-ticket" class="btn btn-default ticket-option" type="button">
								  <i class="glyphicon glyphicon-pencil"></i> Create Ticket
								</button>
								<button id="chat-add-ticket" class="btn btn-default ticket-option" type="button">
								  <i class="glyphicon glyphicon-plus"></i> Add to Ticket
								</button>
								<button id="chat-open-ticket" class="btn btn-default ticket-option" type="button">
								  <i class="glyphicon glyphicon-open"></i> Open Ticket
								</button>
							</div>
						</div>
					</div>
					<div class="row current-chat-area">
						<div class="col-md-12">
							  <ul class="media-list">
								<li class="media">
									<div class="media-body">
										<div class="media">
											<a class="pull-left" href="#">
												<img class="media-object img-circle " src="https://app.teamsupport.com/dc/1078/UserAvatar/1839999/48/1470773165634">
											</a>
											<div class="media-body">
												Donec sit amet ligula enim. Duis vel condimentum massa.
												Donec sit amet ligula enim. Duis vel condimentum massa.Donec sit amet ligula enim. 
												Duis vel condimentum massa.
												Donec sit amet ligula enim. Duis vel condimentum massa.
												<br>
											   <small class="text-muted">Alex Deo | 23rd June at 5:00pm</small>
												<hr>
											</div>
										</div>
				
									</div>
								</li>
								<li class="media">
									<div class="media-body">
										<div class="media">
											<a class="pull-left" href="#">
												<img class="media-object img-circle " src="https://app.teamsupport.com/dc/1078/UserAvatar/2733968/48/1470773158079">
											</a>
											<div class="media-body">
												Donec sit amet ligula enim. Duis vel condimentum massa.
												Donec sit amet ligula enim. Duis vel condimentum massa.Donec sit amet ligula enim. 
												Duis vel condimentum massa.
												Donec sit amet ligula enim. Duis vel condimentum massa.
												<br>
											   <small class="text-muted">Jhon Rexa | 23rd June at 5:00pm</small>
												<hr>
											</div>
										</div>
									</div>
								</li>
								<li class="media">
									<div class="media-body">
										<div class="media">
											<a class="pull-left" href="#">
												<img class="media-object img-circle " src="https://app.teamsupport.com/dc/1078/UserAvatar/1839999/48/1470773165634">
											</a>
											<div class="media-body">
												Donec sit amet ligula enim. Duis vel condimentum massa.
												Donec sit amet ligula enim. Duis vel condimentum massa.Donec sit amet ligula enim. 
												Duis vel condimentum massa.
												Donec sit amet ligula enim. Duis vel condimentum massa.
												<br>
											   <small class="text-muted">Alex Deo | 23rd June at 5:00pm</small>
												<hr>
											</div>
										</div>
									</div>
								</li>
								<li class="media">
									<div class="media-body">
										<div class="media">
											<a class="pull-left" href="#">
												<img class="media-object img-circle" src="https://app.teamsupport.com/dc/1078/UserAvatar/2733968/48/1470773158079">
											</a>
											<div class="media-body">
												Donec sit amet ligula enim. Duis vel condimentum massa.
												Donec sit amet ligula enim. Duis vel condimentum massa.Donec sit amet ligula enim. 
												Duis vel condimentum massa.
												Donec sit amet ligula enim. Duis vel condimentum massa.
												<br>
											   <small class="text-muted">Jhon Rexa | 23rd June at 5:00pm</small>
												<hr>
											</div>
										</div>
									</div>
								</li>
							</ul>  
						</div>
					</div>
					<div class="row current-chat-footer">
					<div class="panel-footer">
						<div class="input-group">
						  <input type="text" class="form-control">
						  <span class="input-group-btn">
							<button class="btn btn-default" type="button">Send</button>
						  </span>
						</div>
						</div>
					</div>
				</div>
				
				
				
				
				
				
				
				
				
				</div>
				
					
				
				
				
				
				
				
				
				
				
				
				
				
				
				
			</div>
		</div>
	
	</div> <!-- end chatting -->
				
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
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
