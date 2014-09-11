<?php
include_once 'billing_info2.inc.php';
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

        
        <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.css">


       
       

        <link href="css/custom.css" rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">


        
        <script src="js/jquery.js"></script>
        <script src="js/jquery.dataTables.js"></script>

        <script type="text/javascript" charset="utf-8">
            $(document).ready(function() {
                $('#datatablesaa').dataTable();
            } )
        </script>
    </head>
    <body>
        <div id="wrapper">
            <nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
                <div class="navbar-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2 col-md-offset-6">
                                <a class="navbar-brand" href="index.php">MyBills.com</a>
                            </div>

<<<<<<< HEAD
                            
                                <ul class="nav navbar-nav navbar-right  navbar-user">
                                    <li><p class="navbar-text"><span class="glyphicon glyphicon-user"></span>
                                            &nbsp; Hello <?php echo ucfirst($name); ?></p></li>
                                            <li><form  method="POST" class="navbar-text"  >
					 <input type="submit"  class=" btn-primary" name="messages" value="Messages" style="float: left"> 
                    </input></form>
                </li>
                                    <li>
                                        <form role="form" method="POST" class="navbar-text" action = "" onsubmit="return confirm('Budget planning done !!!')">
                                            <button type="submit" class="btn btn-danger"  name="logout" >
                                                <span class="glyphicon glyphicon-off"></span>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
=======

                            <ul class="nav navbar-nav navbar-right  navbar-user">
                                <li><p class="navbar-text"><span class="glyphicon glyphicon-user"></span>
                                        &nbsp; Hello <?php echo ucfirst($name); ?></p></li>


                                <!-----Message link on top navigation bar between username and logout --->
                                <li><form  method="POST" class="navbar-text"  >
                                        <button type="submit"  class="glyphicon glyphicon-envelope" name="messages" style="float: left"> 
                                        </button>
                                    </form>
                                </li>
                                <!-----Message link ended--->
                                <li>					
                                    <form method="POST" action = "" class="navbar-text" onsubmit="return confirm('Budget planning done !!!')">
                                        <button type="submit" class="btn btn-danger" name="logout" >
                                            <span class="glyphicon glyphicon-off"></span>
                                        </button>
                                    </form>
                                </li>
                            </ul>
>>>>>>> ac77a46ec923092a053d259bcd4b247e5586d1ec
                            <!--/.nav-collapse -->
                        </div>
                    </div>
                </div>
        </div>

        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">

                <li class="dropdown"><a data-toggle="modal"  data-target="#eye" style="float: right; cursor:pointer;">
                <i class="fa fa-download"></i>
                        Enter your expenses
                    </a>
                </li>
                <li><a data-toggle="modal"  data-target="#myModal" style="float: right; cursor:pointer;">
                    <i class="glyphicon glyphicon-user"></i><i class="glyphicon glyphicon-user"></i>Create New Group
                    </a>
                </li>
				

            </ul>
        </div>
<<<<<<< HEAD
        <div id="page-wrapper">
=======

>>>>>>> ac77a46ec923092a053d259bcd4b247e5586d1ec

        <!-----View by month and in between two dates -------------ADDED--------------- shows Billing details -----> 
        <div id="page-wrapper">
            <div class="row">
                <div class="span2">
                </div>
<<<<<<< HEAD

                <div class="span9">
        
						<form method="POST" action = "">
                            <p> <h4>                             
                                <input type="date" name="bil"  placeholder="From (yyyy-mm-dd)">
                              
                                
                                <input type="date" name="bite"  placeholder="To (yyyy-mm-dd)">
								<input type="submit" class="btn btn-primary" name="view"  value="View" /> 
					
			       					<form method='POST' >
									<select name = "month" onchange='this.form.submit()' ></h4></p>	
									<?php
									    $month = date("m") ;
										if(isset($_POST['month'])){
											$month = $_POST['month'];
											}	
										$months = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
										$i = 1;
										
										foreach ($months as $mon){
											if($month == $i ) {
												if($i <= 9){
													echo	"<option value='0".$i."' selected >".$mon."</option>";
												}
												else {
													echo	"<option value='".$i."' selected >".$mon."</option>";
												}
											} else {
												if($i <= 9)
													echo	"<option value='0".$i."' >".$mon."</option>";
												else 
													echo	"<option value='".$i."' >".$mon."</option>";
												
											}
											$i+=1;
										}
										?>	
															
									</select>
							<noscript><input type="submit" name="month" value="Submit"></noscript>
                        </form>
</div></div></div>
        <div id="page-wrapper">

            <div class="row">
                <div class="span2">
                </div>

                <div class="span6">
                    <p> <h4><font color = "006666">Your Billing Details: </font></h4> </p>
                   <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover datatable" id="datatable">
                                <thead>
                            <tr>
                                <th>Billing Date  </th>
                                <th>Amount  </th>
                                <th>Description  </th>
                                <th>BILL ID  </th>
                                <th>Group Name  </th>
                            </tr>
                        </thead>
                        <tbody>
=======
                <div class="span7">
                    <form method="POST" action = "">
                        <p> <h4>                   
                            <input type="date" name="bil"  placeholder="From (yyyy-mm-dd)" />
                            <input type="date" name="bite"  placeholder="To (yyyy-mm-dd)" />
                            <input type="submit" class="btn btn-primary" name="view"  value="View" /> 
                            <a><font color = "blue">View by month</font></a>
                        
                            <select name = "month" onchange='this.form.submit()' >	
<?php
$month = date("m");
if (isset($_POST['month'])) {
    $month = $_POST['month'];
}
$months = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
$i = 1;
foreach ($months as $mon) {
    if ($month == $i) {
        if ($i <= 9) {
            echo "<option value='0" . $i . "' selected >" . $mon . "</option>";
        } else {
            echo "<option value='" . $i . "' selected >" . $mon . "</option>";
        }
    } else {
        if ($i <= 9)
            echo "<option value='0" . $i . "' >" . $mon . "</option>";
        else
            echo "<option value='" . $i . "' >" . $mon . "</option>";
    }
    $i+=1;
}
?>	
                            </select> </h4>
                        </form>
                        <noscript><input type="submit" name="month" value="Submit"></noscript>
                        </div>
                        </div>
                        </div>
                        <!-----View by month and in between two dates -----------ENDS------------ shows Billing details ----->

                            <div class="row">
                                <div class="span2">
                                </div>

                                <div class="span7">

                                    <p> <h4><font color = "006666">Your Billing Details: </font></h4> </p>
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover datatable" id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th>BILL ID  </th>
                                                        <th>Amount  </th>
                                                        <th>Description  </th>
                                                        <th>Billing Date  </th>
                                                        <th>Group Name  </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
>>>>>>> ac77a46ec923092a053d259bcd4b247e5586d1ec
<?php
// use string to collect html and echo it
$total = 0;
while ($billRow = mysqli_fetch_array($response)) {
    echo "<tr>";
    echo "<td>" . $billRow['billing_date'] . "</td>";
    echo "<td>" . $billRow['amount'] . "</td>";
    $total += $billRow['amount'];
    echo "<td>" . $billRow['description'] . "</td>";
    echo "<td>" . $billRow['bill_id'] . "</td>";
    echo "<td>" . $billRow['group_name'] . "</td>";
    echo "<td>
                                            <form method='POST' onsubmit=\"return confirm('Cool, Have your really start saving !!!')\">
                                                        <input type='hidden' name='bill_id' value=" . $billRow['bill_id'] . "/>
                                                        <button type='submit'  class='btn btn-danger'  name='delete_bill'   > 
                                                        x
                                                        </button>
                                                </form>
                                                </td>";
    echo "</tr>";
}
echo "<tr>
                                        <td>Total</td>
                                        <td>" . $total . "</td>
                                    </tr>";
?>
<<<<<<< HEAD
                        </tbody>	
                    </table>
            </div> </div>    </div>
         <div class="container">
		<div class='row'>					
					<div class="span3"  >
						
                        <p> <h4><font color = "006666">Suggestions: </font></h4> </p>
                     <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover datatable" id="datatable">
                                <thead>    
                                    <tr style="background-color:silver;">
                                        <th>Suggestion  <br></th>
                                        <th>Likes  <br></th>

                                    </tr>
                                </thead>
                                <tbody>
									<form  method="POST" action="" >
                            
                               	<tr>
										<td>
											<input type="text"  name="suggestion" placeholder="Type your suggestion here">
										</td>
										<td>
											<input type="submit" class="btn btn-primary" name = "suggestions" value = "Submit" >
										</td>
										<td>
										</td>
								</tr>
										</form>
                                    <?php
                                    $suggestdisplay = mysqli_query($db_handle, "SELECT * from suggestions ORDER BY likes DESC LIMIT 0, 10;");
                                    while ($suggestdisplayRow = mysqli_fetch_array($suggestdisplay)) {
                                        echo "<tr>";
                                        echo "<td>" . $suggestdisplayRow['suggest'] . "</td>";
                                        echo "<td>" . $suggestdisplayRow['likes'] . "</td>";
                                        echo "<td>
                                                <form method='POST' class='inline-form'>
                                                    <input type = 'hidden' name = 'suggestion_id' value = '".$suggestdisplayRow['suggestion_id']."'>
                                                    <input type = 'hidden' name = 'likes' value = '".$suggestdisplayRow['likes']."'>
                                                     <button type='submit'  class='glyphicon glyphicon-thumbs-up'  name='like'>
                                                     </button>
                                                </form>
                                                </td>";
                                    echo "</tr>";
                                }
                                        //echo $suggestdisplay_td;
                                    ?>
                                   
                                </tbody>
                            </table>
                        </div>
                     </div>
                        </div>
                        </div>
                        </div>
            </div>
            <div class="row">
                <div class="span2">
                </div>
                <div class="span6">
                    <p> <h4><font color = "006666">Summary: </font></h4> </p>
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover datatable" id="datatable">
                                <thead>
                                    <tr>
                                        <th>User name  </th>
                                        <th>Email  </th>
                                        <th>Type </th>
                                        <th>Amount </th>
                                    </tr>
                                </thead>
                                <tbody>
=======
                                                </tbody>	
                                            </table>
                                        </div>
                                    </div>

                                </div> 





                                <!-----Show suggestion table with likes --------ADDED--------->
                                <div class="span4">
                                    <p> <h4><font color = "006666">Suggestions: </font></h4> </p>
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover datatable" id="datatable">
                                                <thead>    
                                                    <tr style="background-color:silver;">
                                                        <th>Suggestion  <br></th>
                                                        <th>Likes  <br></th>

                                                    </tr>
                                                </thead>
                                                <tbody>

<?php
$suggestdisplay = mysqli_query($db_handle, "SELECT * from suggestions ORDER BY likes DESC LIMIT 0, 10;");
while ($suggestdisplayRow = mysqli_fetch_array($suggestdisplay)) {
    echo "<tr>";
    echo "<td>" . $suggestdisplayRow['suggest'] . "</td>";
    echo "<td>" . $suggestdisplayRow['likes'] . "</td>";
    echo "<td>
                                                        <form method='POST' class='inline-form'>
                                                                <input type = 'hidden' name = 'suggestion_id' value = '" . $suggestdisplayRow['suggestion_id'] . "'>
                                                                <input type = 'hidden' name = 'likes' value = '" . $suggestdisplayRow['likes'] . "'>
                                                                    <button type='submit'  class='glyphicon glyphicon-hand-up'  name='like'>
                                                                    </button>
                                                        </form>
                                                     </td>";
    echo "</tr>";
}
?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div>
                        <!-----Show suggestion table with likes --------ENDED--------->



                        <div class="row">
                            <div class="span2">
                            </div>
                            <div class="span7">
                                <p> <h4><font color = "006666">Summary: </font></h4> </p>
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover datatable" id="datatable">
                                            <thead>
                                                <tr>
                                                    <th>User name  </th>
                                                    <th>Email  </th>
                                                    <th>Type </th>
                                                    <th>Amount </th>
                                                </tr>
                                            </thead>
                                            <tbody>
>>>>>>> ac77a46ec923092a053d259bcd4b247e5586d1ec
<?php
//print_r($debitTable);
$v = array();
foreach ($selfTable as $v) {
    //print_r($v);
    echo "<tr class='success'>
                            <td>" . $v['name'] . "</td>
                            <td>" . $v['email'] . "</td>
                            <td>Total Expance</td>
                            <td>" . $v['amount'] . "</td>
                            

                        </tr>";
}
$v = array();
$n = 0;
foreach ($debitTable as $v) {
    //print_r($v);
    echo "<tr>
                            <td>" . $v['name'] . "</td>
                            <td>

                            <div class='accordion-group'>
            <a class='accordion-toggle list-group-item' data-toggle='collapse' data-parent='#leftMenu' href='#d" . $n . "'>
                <i class='fa fa-book'></i>" . $v['email'] . " </a>
            <div id=d" . $n . " class='accordion-body collapse' style='height: 0px; '>
                <div class='accordion-inner list-group'>
                    <ul>";
    foreach ($v['desc'] as $z) {
        echo $z . "<br>";
    }

    $n +=1;
    echo "</ul>
                </div>
            </div>
        </div></td><td>Debit</td>";
    echo "        <td>" . $v['amount'] . "</td>
                            

                        </tr>";
}
$v = array();
$n = 0;
foreach ($creditTable as $v) {
    //print_r($v);
    echo "<tr class= 'danger'>
                            <td>" . $v['name'] . "</td>
                            <td><div class='accordion-group'>
            <a class='accordion-toggle list-group-item danger' data-toggle='collapse' data-parent='#leftMenu' href='#c" . $n . "'>
                <i class='fa fa-book'></i>" . $v['email'] . " </a>
            <div id=c" . $n . " class='accordion-body collapse' style='height: 0px; '>
                <div class='accordion-inner list-group'>
                    <ul>";
    foreach ($v['desc'] as $z) {
        echo $z . "<br>";
    }
    $n +=1;
    echo "</ul>
                </div>
            </div>
        </div></td>
                            <td>Credit</td>
                            <td>" . $v['amount'] . "</td>
                            

                        </tr>";
}
?>
                                            </tbody>	
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
<<<<<<< HEAD
                  </div>  
          <div class="row">
                <div class="span2">
                </div>
                <div class="span9">
                    <p> <h4><font color = "006666">Groups: </font></h4> </p>
                     <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover datatable" id="datatable">
                                <thead>    
                            <tr style="background-color:silver;">
                                <th>Group Name  <br></th>
                                <th>Group Members  <br></th>
                            </tr></thead><tbody>
                        
<?php
=======
                        <div class="row">
                            <div class="span2">
                            </div>
                            <div class="span9">
                                <p> <h4><font color = "006666">Groups: </font></h4> </p>
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover datatable" id="datatable">
                                            <thead>    
                                                <tr style="background-color:silver;">
                                                    <th>Group Name  <br></th>
                                                    <th>Group Members  <br></th>
                                                </tr></thead><tbody>
>>>>>>> ac77a46ec923092a053d259bcd4b247e5586d1ec

<?php
echo $group_display_td;
?>
<<<<<<< HEAD
</tbody>
                    </table>
                        </div></div>
                </div>
            </div>
        </div>	
            <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Create New Group</h4>
                    </div>

                    <div class="modal-body">
=======
                                            </tbody>
                                        </table>
                                    </div></div>
                            </div>
                        </div>
                </div>	

                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">Create New Group</h4>
                            </div>
>>>>>>> ac77a46ec923092a053d259bcd4b247e5586d1ec

                            <div class="modal-body">

                                <form role="form" method="POST" id="tablef" >
                                    <div class="input-group" >
                                        <span class="input-group-addon">Group Name</span>
                                        <input type="text" class="form-control" name="group_name" placeholder="Enter your group name">
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <span class="input-group-addon">Create Group with (Email)</span>
                                        <input type="email" class="form-control" name="email" placeholder="Enter First group member Email">
                                    </div>
                                    <br>
                                    <input type="submit" class="btn btn-primary" name = "create_group" value = "Create New Group" >
                                </form>
                            </div>
                            <div class="modal-footer">
                                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                                <button id="newuser" type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
<<<<<<< HEAD
            </div>
        </div>
        <!--end modle-->
        <!-- Modal -->
        <div class="modal fade" id="eye" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Expense Details</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="POST" action = "">
                            <p> <h4> <font color = "blue">Enter your expense details:</font></h4></p>
                            <div class="input-group">
                                <span class="input-group-addon">Date</span> 
                                <input type="date" class="form-	control" name="billing_date" value="<?php echo date("Y-m-d"); ?>" placeholder="Enter date" min="2014-09-01" max="<?php echo date("Y-m-d"); ?>">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon">Amount</span> 
                                <input type="NUMBER" class="form- control" name="amount" placeholder="Enter amount">
=======
                <!--end modle-->
                <!-- Modal -->
                <div class="modal fade" id="eye" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">Delete Group</h4>
>>>>>>> ac77a46ec923092a053d259bcd4b247e5586d1ec
                            </div>
                            <div class="modal-body">
                                <form role="form" method="POST" action = "">
                                    <p> <h4> <font color = "blue">Enter your expense details:</font></h4></p>
                                    <div class="input-group">
                                        <span class="input-group-addon">Date</span> 
                                        <input type="date" class="form-	control" name="billing_date" value="<?php echo date("Y-m-d"); ?>" placeholder="Enter date" min="2014-09-01" max="<?php echo date("Y-m-d"); ?>">
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <span class="input-group-addon">Amount</span> 
                                        <input type="NUMBER" class="form- control" name="amount" placeholder="Enter amount">
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <span class="input-group-addon">Description</span> 
                                        <input type="text" class="form-	control" name="description" placeholder="Enter item description"> 
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <span class="input-group-addon">Share with Group</span> 
                                        <input type="text" class="form-	control" name="group_name" placeholder="Enter Group name"> 
                                    </div>
                                    <br>
                                    <input type="submit" class="btn btn-primary" name="save"  value="Save" />
                                </form>
                            </div>
<<<<<<< HEAD
                            <br>
                            <div class="input-group">
                                Select Group
									<select name = "group_name"  >
										<option value="">None</option>
										<?php
											$awr = mysqli_query($db_handle, "SELECT * FROM groups WHERE user_id = '$user_id';") ;
											while ($rty = mysqli_fetch_array($awr)) {
												$jk = $rty['group_name'] ;
												echo "<option value='$jk'>"."$jk"."</option>"."<br/>" ;
												
												}
										?>
									</select> 
=======
                            <div class="modal-footer">
                                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                                <button id="newuser" type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
>>>>>>> ac77a46ec923092a053d259bcd4b247e5586d1ec
                            </div>
                        </div>
                    </div>
                </div>
                <!--end modle-->


                <!------ENTER SUGGESTION from added----------->
                <div class="container">
                    <div class='row'>					
                        <div class="span6 pull-right"  >
                            <form  method="POST" action="" >
                                <div class="input-group" >

                                    <p> <h4> <input type="text"  name="suggestion" placeholder="Type your suggestion here">
                                        <input type="submit" class="btn btn-primary" name = "suggestions" value = "Submit" ></p> </h4></div>
                            </form>
                        </div>
                    </div>
                </div>
<<<<<<< HEAD
            </div>
        </div>
        <!--end modle-->
<<<<<<< HEAD
        </div></div></div>
        <script type="text/javascript">
		
        </script>

        <script src="js/jquery.js"></script>
=======
    
        
>>>>>>> ac77a46ec923092a053d259bcd4b247e5586d1ec
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
=======
                <!------ENTER SUGGESTION from ended----------->

>>>>>>> 851d59771ac534bbd39962d437b8e829d86407ef

                <script type="text/javascript">
		
                </script>

<<<<<<< HEAD
        <div class="row">
            <div class="span6 pull-right">
=======
                <script src="js/jquery.js"></script>
                <!-- Include all compiled plugins (below), or include individual files as needed -->
                <script src="js/bootstrap.min.js"></script>
>>>>>>> ac77a46ec923092a053d259bcd4b247e5586d1ec

                <script src="js/custom.js"></script>

                <div class="row">
                    <div class="span4 pull-right">

                        <ul class="list-inline">
                            <li>Posted by: Mybill.com</li>
                            <li>Copyright @ 2014</li>
                        </ul>
                    </div>
                </div>
<?php
if (isset($_GET['status'])) {
//status=2
    if ($_GET['status'] == 1) {
        echo "<script> 
                    alert('Sorry process died, Plz try again!');
                </script>";
    }

    if ($_GET['status'] == 0) {
        echo "<script>
                alert('Invitation sent successfully');
            </script>";
    }
}
?>
<<<<<<< HEAD
        
    </body>
</html>
=======
                <script type="text/javascript">
                    $('#example')
                    .removeClass( 'display' )
                    .addClass('table table-striped table-bordered');
                </script>

                </body>
                </html>
>>>>>>> 851d59771ac534bbd39962d437b8e829d86407ef


<?php
mysqli_close($db_handle);
?>
