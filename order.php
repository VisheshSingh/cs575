 <!--
 ================================================
 Project Name: 	OrderPHP
 Date: 			11/29/2015
 Programmer: 	Vishesh Thakur
 Purpose: 		Linking the order entries to cs575 database
 ================================================
 -->
 <?php

    /* Attempt MySQL server connection. Assuming you are running MySQL

    server with default setting (user 'root' with no password) */

    $link = mysqli_connect("localhost", "root", "", "cs575");

     

    // Check connection

    if($link === false){

        die("ERROR: Could not connect. " . mysqli_connect_error());

    }

     

    // Escape user inputs for security

    $Name = mysqli_real_escape_string($link, $_POST['name']);

    $Address = mysqli_real_escape_string($link, $_POST['address']);

    $City = mysqli_real_escape_string($link, $_POST['city']);
	
	$State = mysqli_real_escape_string($link, $_POST['states']);
	
	$Zip = mysqli_real_escape_string($link, $_POST['zip']);
	
	$Phone = mysqli_real_escape_string($link, $_POST['phone']);
	
	$Email = mysqli_real_escape_string($link, $_POST['email']);

    $Size =  mysqli_real_escape_string($link, $_POST['sizes']);
	
	//$toppings = mysqli_real_escape_string($link, $_POST['toppings']);
	
	$toppings = $_POST['toppings'];
	
	

    // attempt insert query execution

    $sql = "INSERT INTO orderdetails (Name, Address, City, State, Zip, Phone, Email, Size) VALUES ('$Name', '$Address', '$City', '$State', '$Zip', '$Phone', '$Email', '$Size')";
	
	
	
    if(mysqli_query($link, $sql)){

        echo "Records added successfully.";

    } else{

        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);

    }

	$orderID = mysqli_insert_id($link);
	//echo "The id for record is: " . mysqli_insert_id($link);<br />

    foreach ($toppings as $top=>$value) {
             $sql = "INSERT INTO ordertoppings VALUES ($orderID, $value)";
			 
			 if(mysqli_query($link, $sql)){

				//echo "Records added successfully.";

			} else{

				echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);

			}
    }
	

    // close connection

    mysqli_close($link);

    ?>