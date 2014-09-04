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
    echo "hi";
}
if (isset($_POST['delete_bill'])) {
    $bill_id = $_POST['bill_id'];
    mysqli_query($db_handle, "DELETE FROM billing_info where bill_id = '$bill_id';");
    header('Location: billing_info.php');
    //echo "<script>alert('success')</script>";
}

if (isset($_POST['create_group'])) {
    $group_name = $_POST['group_name'];
    $email = $_POST['email'];
    $respo = mysqli_query($db_handle, "SELECT * FROM user_info WHERE email = '$email';");
    $row = mysqli_num_rows($respo);
    if ($row == 1) {
        $responserow = mysqli_fetch_array($respo);
        $uid = $responserow['user_id'];
        mysqli_query($db_handle, "INSERT INTO groups (user_id, group_name) VALUES ('$uid', '$group_name'),('$user_id','$group_name');");
        mysqli_query($db_handle, "INSERT INTO group_owners (group_owner, group_name) VALUES ('$user_id','$group_name');");
        header('Location: billing_info.php');
    } else {
       
        if(mail($email,$name+" have share bill with you.","Hi,\n ".$name." have share bill with you.\n
            To know details login to http://54.64.1.52/Mybill/.\n
            Username: ".$email."\n
            Password: user123#"))
            print "<script>alert('User was not registered, we have invited the user!')</script>";
        else
            print "<script>alert('An error occured, Sorry try again!')</script>";

        
    }
}

if (isset($_POST['delete_group'])) {
    $group_name = $_POST['group_name'];
    $user_id = $_SESSION['user_id'];
    $owner = mysqli_query($db_handle, "SELECT * FROM group_owners WHERE group_name = '$group_name' and group_owner = '$user_id';");
    $num = mysqli_num_rows($owner);
    if ($num = 1) {
    mysqli_query($db_handle, "DELETE FROM groups WHERE group_name = '$group_name';");
    header('Location: billing_info.php');
} else { 
	echo "You have no Permission!!" ;
	}
}

if (isset($_POST['add_member'])) {
    $email = $_POST['email'];
    $group_name = $_POST['group_name'];
    $respo = mysqli_query($db_handle, "SELECT * FROM user_info WHERE email = '$email';");
    $row = mysqli_num_rows($respo);
    if ($row) {
        $responserow = mysqli_fetch_array($respo);
        $uid = $responserow['user_id'];
        mysqli_query($db_handle, "INSERT INTO groups (user_id, group_name) VALUES ('$uid', '$group_name');");
        header('Location: billing_info.php');
    } else {
        echo "This Person is not registered";
    }
}

if (isset($_POST['delete_member'])) {
    $uid = $_POST['uid'];
    $group_name = $_POST['group_name'];
    mysqli_query($db_handle, "DELETE FROM groups WHERE user_id = '$uid' AND group_name = '$group_name';");
    header('Location: billing_info.php');
}

if (isset($_POST['save'])) {
    $billing_date = $_POST['billing_date'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $group_name = $_POST['group_name'];
    if ($group_name == '') {
        mysqli_query($db_handle, "INSERT INTO groups (user_id, group_name) VALUES ('$user_id', '$name');");
        $group_name = $name;
        
    }
    mysqli_query($db_handle, "INSERT INTO billing_info ( user_id, billing_date, amount, description, group_name ) 
											VALUES ('$user_id','$billing_date','$amount','$description','$group_name');");
    header('Location: billing_info.php');
}

$response = mysqli_query($db_handle, "SELECT * FROM billing_info WHERE user_id = '$user_id';");
//echo "<script>alert('".  print_r($response)."')</script>";

if (isset($_POST['logout'])) {
    header('Location: index.php');
    unset($_SESSION['user_id']);
    unset($_SESSION['first_name']);
    session_destroy();
}

$creditTable = array();

$rt = mysqli_query($db_handle, "select a.bill_id,a.group_name,a.description,a.user_id as user_id,a.amount 
                        from billing_info as a 
                        join groups as b 
                        where a.group_name=b.group_name
                        and a.user_id != '$user_id'
                        and b.user_id = '$user_id' 
                        ;");
while ($we = mysqli_fetch_array($rt)) {
    $gnm = $we['group_name'];
    $gh = mysqli_query($db_handle, "select * from groups where group_name = '$gnm';");
    $abh = mysqli_num_rows($gh);
    $usi = $we['user_id'];
    $res = mysqli_query($db_handle, "select * from user_info where user_id = '$usi';");
    $as = mysqli_fetch_array($res);
    $eid = $as['email'];
    $unm = $as['first_name'];
    $cd = "Debit";
    $amt = $we['amount'];
    $amnt = $amt / $abh;

    if (key_exists($eid, $creditTable)) {

        $creditTable[$eid]['amount'] += $amnt;
        $creditTable[$eid]['desc'][$we['bill_id']] = $we['description']." ".$we['bill_id']." ".$amt." /".$abh." = ".$amnt;
    } else {
        $creditTable[$eid] = array();
        $creditTable[$eid]['desc'] = array();
        $creditTable[$eid]['name'] = ucfirst($as['first_name']) . " " . ucfirst($as['last_name']);
        $creditTable[$eid]['email'] = $eid;
        $creditTable[$eid]['user_id'] = $as['user_id'];
        $creditTable[$eid]['amount'] = 0;
        $creditTable[$eid]['amount'] += $amnt;
        $creditTable[$eid]['desc'][$we['bill_id']] = $we['description']." ".$we['bill_id']." ".$amt." /".$abh." = ".$amnt;
    }
}
$selfTable = array();

$rt = mysqli_query($db_handle, "select a.group_name,a.amount, a.user_id as uid, b.user_id as user_id   
                        from billing_info as a 
                        join groups as b 
                        where a.group_name=b.group_name
                       
                        and b.user_id = '$user_id' 
                        and a.group_name != 'NULL';");
while ($we = mysqli_fetch_array($rt)) {
    $gnm = $we['group_name'];
    $gh = mysqli_query($db_handle, "select * from groups where group_name = '$gnm';");
    $abh = mysqli_num_rows($gh);


    $usi = $we['user_id'];

    $res = mysqli_query($db_handle, "select * from user_info where user_id = '$usi';");
    $as = mysqli_fetch_array($res);
    $eid = $as['email'];
    $unm = $as['first_name'];
    $cd = "Debit";
    $amnt = $we['amount'];
    if ($we['uid'] != $user_id) {
        //  echo "<div class='span3'></div>".$usi;
        $amnt = $amnt / $abh;
    }
    if ($usi == $user_id) {
        if (key_exists($eid, $selfTable)) {

            $selfTable[$eid]['amount'] += $amnt;
        } else {
            $selfTable[$eid] = array();
            $selfTable[$eid]['name'] = ucfirst($as['first_name']) . " " . ucfirst($as['last_name']);
            $selfTable[$eid]['email'] = $eid;
            $selfTable[$eid]['amount'] = 0;
            $selfTable[$eid]['amount'] += $amnt;
        }
    }
}
$debitTable = array();

$rt = mysqli_query($db_handle, "select * 
                        from billing_info as a 
                        join groups as b 
                        where a.group_name=b.group_name
                        and a.user_id = '$user_id'
                        and b.user_id != '$user_id' 
                        ;");
while ($we = mysqli_fetch_array($rt)) {
    $gnm = $we['group_name'];

    $gh = mysqli_query($db_handle, "select * from groups where group_name = '$gnm';");
    $abh = mysqli_num_rows($gh);


    $usi = $we['user_id'];

    $res = mysqli_query($db_handle, "select * from user_info where user_id = '$usi';");
    $as = mysqli_fetch_array($res);
    $eid = $as['email'];
    $unm = $as['first_name'];
    $cd = "Debit";
    $amnt = $we['amount'];

    $amnt = $amnt / $abh;
    //   echo "<div class='span3'></div>".$amnt."::: ".$usi."::: ".$gnm.";";
    if (key_exists($eid, $debitTable)) {

        $debitTable[$eid]['amount'] += $amnt;
        $debitTable[$eid]['desc'][$we['bill_id']] = $we['description']." ".$we['bill_id']." ".$amt." /".$abh." = ".$amnt;

    } else {
        $debitTable[$eid] = array();
        $debitTable[$eid]['desc'] = array();
        $debitTable[$eid]['name'] = ucfirst($as['first_name']) . " " . ucfirst($as['last_name']);
        $debitTable[$eid]['email'] = $eid;
        $debitTable[$eid]['amount'] = 0;
        $debitTable[$eid]['amount'] += $amnt;
        $debitTable[$eid]['desc'][$we['bill_id']] = $we['description']." ".$we['bill_id']." ".$amt." /".$abh." = ".$amnt;

    }
}
$groupdisplay = mysqli_query($db_handle, "SELECT group_name from groups where user_id = '$user_id';");
$group_display_td = "";
while ($groupRow = mysqli_fetch_array($groupdisplay)) {
    $grp = $groupRow['group_name'];
    $users_in_group = mysqli_query($db_handle, "SELECT a.group_name,b.first_name, b.last_name,a.user_id 
																				from groups as a 
																				join user_info as b 
																				where a.group_name = '$grp' 
																				and  a.user_id = b.user_id;");
    $group_display_td .= "<tr><td>" . $groupRow['group_name'] . "</td>";
    while ($users_in_groupRow = mysqli_fetch_array($users_in_group)) {

        $group_display_td = $group_display_td . "<td ><div class='dropdown'>
				  <button class='btn btn-default dropdown-toggle' type='button' id='dropdownMenu1' data-toggle='dropdown'>
			       " . ucfirst($users_in_groupRow['first_name']) . " " . ucfirst($users_in_groupRow['last_name']) .
                " <span class='caret'></span></button>
			       <ul class='dropdown-menu' role='menu' aria-labelledby='dropdownMenu1'>
    			<li>
				
                                        <form method='POST' class='inline-form' onsubmit=\"return confirm('Really, No more sharing with this friend !!!')\">
						<input type='hidden' name='group_name' value='" . $grp . "'/>
						<input type='hidden' name='uid' value='" . $users_in_groupRow['user_id'] . "'/>
						
						<button type='submit'  class='btn-danger'  name='delete_member'  >Delete Member x</button>
                                        </form></li>
                            </ul>
                            </div>
                                    </td>";
    }

    $group_display_td = $group_display_td . "<td>
				<div class='dropdown'>
				  <button class='btn btn-default dropdown-toggle' type='button' id='dropdownMenu1' data-toggle='dropdown'>
			      + Memeber
                                    <span class='caret'></span></button>
			       <ul class='dropdown-menu' role='menu' aria-labelledby='dropdownMenu1'>
    			<li>
					<form role='form' method='POST' action = ''>
						<input type='hidden' name='group_name' value='" . $grp . "'/>
						<div class='input-group'>
							<input type='email' class='form-control' name='email' placeholder='Email'>
						</div>
						<input type='submit' class='btn btn-primary' name = 'add_member' value = 'Add Member' >		
					</form>
				</li>
				<li>
					<form role='form' method='POST' onsubmit=\"return confirm('Less outing less groups !!!')\" >
						<input type='hidden' name='group_name' value='" . $grp . "'/>
						<input type='submit' class='btn btn-primary' name = 'delete_group' value = 'Delete Group' >
					</form>
				</li>
                            </ul>
                            </div>
                    </td></tr>";
}
?>
