<?php

session_start();
$user_id = $_SESSION['user_id'];
$name = $_SESSION['first_name'];

if (!isset($_SESSION['first_name'])) {
    header('Location: index.php');
}


$db_handle = mysqli_connect("localhost", "root", "redhat111111", "mybill");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if (isset($_POST['logout'])) {
    header('Location: index.php');
    unset($_SESSION['user_id']);
    unset($_SESSION['first_name']);
    session_destroy();
}

if (isset($_POST['send'])) {
    $sender = $_SESSION['user_id'];
    $receiver = $_POST['receiver_id'] ;
    $message = $_POST['mess'] ;
    mysqli_query($db_handle, "INSERT INTO messages (sender_id, receiver_id, message) VALUES ('$sender', '$receiver', '$message');") ;
}

if (isset($_POST['see_all_message'])) {
    $sender = $_SESSION['user_id'];
    $receiver = $_POST['receiver_id'] ;
    
     
}

?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>billing</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Billing, Sharing, budget">
        <meta name="author" content="Rajnish">

        <!-- Le styles -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <style>
            body {
                padding-top: 10px; /* 60px to make the container go all the way to the bottom of the topbar */
            }             
        </style>

        <link href="css/bootstrap-responsive.css" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.css">


        <script type="text/javascript" language="javascript" src="js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" language="javascript" src="js/dataTables.bootstrap.js"></script>

        <link href="css/custom.css" rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">
        

        <script src="js/datatable_custom.js"></script>
        <script type="text/javascript" charset="utf-8">
            $(document).ready(function() {
                $('#example').dataTable();
            } );
        </script>
    </head>

    <body>

          <div id="wrapper">
      <nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
          <div class="navbar-header">
                    <div class="container">
                        <div class="row">
							<a class="navbar-brand" style="pull-left" href="billing_info.php">Back</a>
                            <div class="col-md-2 col-md-offset-6">
                                <a class="navbar-brand"  href="index.php">MyBills.com</a>
                            </div>

                            
                                <ul class="nav navbar-nav navbar-right  navbar-user">
                                    <li><p class="navbar-text"><span class="glyphicon glyphicon-user"></span>
                                            &nbsp; Hello <?php echo ucfirst($name); ?></p></li>
                                    <li>
                                        <form role="form" method="POST" action = "" onsubmit="return confirm('Budget planning done !!!')">
                                            <button type="submit" class="btn btn-danger"  name="logout" >
                                                <span class="glyphicon glyphicon-off"></span>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            <!--/.nav-collapse -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="page-wrapper">

            <div class="row">
                <div class="span5">
					
                    <p> <h4><font color = "006666">Friends: </font></h4> </p>
                   
			<?php   
			
                
							$names = mysqli_query($db_handle, "select * from user_info as a join 
																(select DISTINCT b.user_id from groups as a join
																 groups as b where a.user_id = '$user_id' and
																  a.group_name = b.group_name and b.user_id != '$user_id')
																	as b where a.user_id=b.user_id;") ;

					while ($nms = mysqli_fetch_array($names)) {
						$user_name = $nms['first_name'];
						$unm = $nms['last_name'] ;
						$anl = mysqli_query($db_handle, "SELECT user_id from user_info where first_name = '$user_name' AND last_name = '$unm';") ;
						$nam = mysqli_fetch_array($anl) ;
						$df = $nam['user_id'] ;
						echo "<a data-toggle='modal' data-target='#myModal' style='cursor:pointer;'>"."<form method='POST' class='inline-form' >".strtoupper($user_name)." ".strtoupper($unm)."<input type='hidden' name='receiver_id' value='" . $df . "'/>"."</form>"."</br>"."</a>" ;
				
				}
			
					?>
		   </div>
	 </div>
</div>

	   <div class="span5">
   Conversation:<br/>
   <?php
    $messagedisplay = mysqli_query($db_handle, "SELECT * from messages WHERE 
								(sender_id = $sender and receiver_id = $receiver) OR 
								(sender_id = $receiver and receiver_id = $sender) 
								ORDER BY time DESC LIMIT 0, 10;") ;
		while($messagedisplayRow = mysqli_fetch_array($messagedisplay) ) {
			$send = $messagedisplayRow['sender_id'] ;
		    $rece = $messagedisplayRow['receiver_id'] ;
			$mesage = $messagedisplayRow['message'] ;
			$time = $messagedisplayRow['time'] ;
			$as = mysqli_query($db_handle, "SELECT first_name from user_info WHERE user_id = '$send';") ;
			$rt = mysqli_fetch_array($as) ;
			$namer = $rt['first_name'] ;
		    $asj = mysqli_query($db_handle, "SELECT first_name from user_info WHERE user_id = '$rece';") ;
			$rtr = mysqli_fetch_array($asj) ;
			$namers = $rtr['first_name'] ;
		  
         echo strtoupper($namer)." "."said"." "."to"." ".strtoupper($namers)." "."at"." ".$time."<br/>".$mesage."<br/>"."<br/>" ;
    }
    ?>
	   </div>
        </div>   
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Message</h4>
                    </div>

                    <div class="modal-body">

                        <div class='input-group'>
						<form method='POST' class='inline-form' >
							<div class='input-group'>
									<input type='text' class='form-control' name='mess' placeholder='Type your message here'></br></br>
									<input type='hidden' name='receiver_id' value='<?php echo $df;    ?>' />
									<button type='submit'  class='btn-primary'  name='send'  >Send </button>
									
							</form></br></br>
						<form method='POST' class='inline-form' >
							<button type='submit'  class='btn-primary'  name='see_all_message'  >See all messages </button>
									<input type='hidden' name='receiver_id' value='<?php echo $df;    ?>'/>
							</form>
                    </div> </div> </div>
                    <div class="modal-footer">
                        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                        <button id="newuser" type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div></div></div></div></div>
        <!--end modle-->
        <script type="text/javascript">
		
        </script>

        <script src="js/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>

        <script src="js/custom.js"></script>

        <div class="row">
            <div class="span5 pull-right">

                <ul class="list-inline">
                    <li>Posted by: Mybill.com</li>
                    <li>Copyright @ 2014</li>
                </ul>
            </div>
        </div>
        <script type="text/javascript">
            $('#example')
            .removeClass( 'display' )
            .addClass('table table-striped table-bordered');
        </script>
    </body>
</html>


<?php
mysqli_close($db_handle);
?>

