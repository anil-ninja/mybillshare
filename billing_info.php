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
                            <div class="col-md-2 col-md-offset-6">
                                <a class="navbar-brand" href="index.php">MyBills.com</a>
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
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">

                <li class="dropdown"><a data-toggle="modal"  data-target="#eye" style="float: right; cursor:pointer;"><i class="fa fa-download"></i>
                        Enter your expenses
                    </a>
                </li>
                <li><a data-toggle="modal"  data-target="#myModal" style="float: right; cursor:pointer;">Create New Group
                    </a>
                </li>

            </ul>
        </div>

        <div id="page-wrapper">

            <div class="row">
                <div class="span2">
                </div>

                <div class="span9">
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
<?php
// use string to collect html and echo it
$total = 0;
while ($billRow = mysqli_fetch_array($response)) {
    echo "<tr>";
    echo "<td>" . $billRow['bill_id'] . "</td>";
    echo "<td>" . $billRow['amount'] . "</td>";
    $total += $billRow['amount'];
    echo "<td>" . $billRow['description'] . "</td>";
    echo "<td>" . $billRow['billing_date'] . "</td>";
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
                        </tbody>	
                    </table>
                </div>
                

            </div> </div>
                

            </div>


            <div class="row">
                <div class="span2">
                </div>
                <div class="span9">
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
foreach ($debitTable as $v) {
    //print_r($v);
    echo "<tr>
                            <td>" . $v['name'] . "</td>
                            <td>

                            <div class='accordion-group'>
            <a class='accordion-toggle list-group-item' data-toggle='collapse' data-parent='#leftMenu' href='#collapseTwo'>
                <i class='fa fa-book'></i>" . $v['email'] ." </a>
            <div id='collapseTwo' class='accordion-body collapse' style='height: 0px; '>
                <div class='accordion-inner list-group'>
                    <ul>" ;
                              foreach ($v['desc'] as $z) {
                                  echo $z."<br>";
                                  
            }

    
        echo "</ul>
                </div>
            </div>
        </div></td><td>Debit</td>";
    echo "        <td>" . $v['amount'] . "</td>
                            

                        </tr>";
}
$v = array();
foreach ($creditTable as $v) {
    //print_r($v);
    echo "<tr class= 'danger'>
                            <td>" . $v['name'] . "</td>
                            <td>" . $v['email'] ."<br>" ;
                              foreach ($v['desc'] as $z) {
                                  echo $z."<br>";
                                  
            }
                                echo "</td>
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

echo $group_display_td;
?>
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
        <!--end modle-->
        <!-- Modal -->
        <div class="modal fade" id="eye" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Delete Group</h4>
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
                    <div class="modal-footer">
                        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                        <button id="newuser" type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!--end modle-->
        <script type="text/javascript">
		
        </script>

        <script src="js/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>

        <script src="js/custom.js"></script>

        <div class="row">
            <div class="span4 pull-right">

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
