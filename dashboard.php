<?php
	session_start();
	require_once("include/configuration.php");
	require_once("include/functions.php");
	error_reporting_mode();
	getsiteconfiguration();
	
	$table_name = "users";
	$ref_column = "username";
	$ref_value = $_SESSION["username"];
	$userid = $_SESSION["userid"];
	$email = $_SESSION["email"];
	$username = $_SESSION["username"];
	$type = $_SESSION["type"];
	$deptid = $_SESSION["deptid"];
	if(isset($_POST["verificationkey"]))
		{
			$verificationkey = $_POST["verificationkey"];
			$q = fetch_data(verificationkey, $ref_column, $ref_value, $table_name);
			if($q!=null)
				{
				$verificationkey_db = $q;
				if($verificationkey_db == $verificationkey)
					{
						
					}
				else
					{
						echo "Invalid verification key!";
					}
				}
			else
				{
				echo "failed fetch verification key details";
				}
		}
	echo header_page();
	
	$q = fetch_data(aadhar, $ref_column, $ref_value, $table_name);
	if($q!=null)
		{
			$aadhar = $q;
		}
	else
		{
			echo "failed fetch aadhar details";
		}
		
	$q = fetch_data(status, $ref_column, $ref_value, $table_name);
	if($q!=null)
		{
			$status = $q;
		}
	else
		{
			echo "failed fetch status details";
		}
	$q = fetch_data(verificationkey, $ref_column, $ref_value, $table_name);
	if($q!=null)
		{
			$verificationkey = $q;
		}
	else
		{
			echo "failed fetch verification key details";
		}
	$q = fetch_data(block, $ref_column, $ref_value, $table_name);
	if($q!=null)
		{
			$block = $q;
		}
	else
		{
			echo "failed fetch block details";
		}
	$q = fetch_data(address, $ref_column, $ref_value, $table_name);
	if($q!=null)
		{
			$address = $q;
		}
	else
		{
			echo "failed fetch address details";
		}
		
	$q = fetch_data(phno, $ref_column, $ref_value, $table_name);
	if($q!=null)
		{
			$phno = $q;
		}
	else
		{
			echo "failed fetch phone number details";
		}
	$q = fetch_data(gender, $ref_column, $ref_value, $table_name);
	if($q!=null)
		{
			$gender = $q;
		}
	else
		{
			echo "failed fetch gender details";
		}


	echo "<hr>";
	echo $aadhar;
	echo "<hr>";
	if($block == "1")
		{
			$error_mesasge = "Admin is blocked please contact us in contact areas about your problem!";
			echo $error_mesasge;
		}
	else
		{
			if($status == "0" && $verificationkey != "0")
				{
					$error_mesasge = "Please verify email address and entercode";
					echo $error_mesasge;
					echo "<form role=\"form\" method=\"POST\" action=\"dashboard.php\" name=\"verify_email\">";
					echo"<div class=\"form-group\">";
					echo "<input type=\"text\" name=\"verificationkey\" id=\"verificationkey\" class=\"form-control input-lg\" placeholder=\"Verification Code\" tabindex=\"3\"  required>";
            		echo "</div>";
					echo "<div class=\"row\">";
					echo "<div class=\"col-xs-12 col-md-6\"><input type=\"submit\" value=\"verificationkey\" class=\"btn btn-primary btn-block btn-lg\" tabindex=\"7\" name=\"login\"></div>";
				
					echo "</form>";
				}
			elseif($aadhar == "0")
				{
					$error_message = "Please enter aadhar number.";
					echo $error_mesasge;
				}
			else
				{
					echo "you can post complaint and view complaint!";
					echo $error_mesasge;
					
				}
		}
						/*echo is_string($userid)."<br>" .is_string($email)."<br>". is_string($username)."<br>". is_string($type)."<br>". is_string($deptid)."<br>". is_string($aadhar)."<br>". is_string($status)."<br>" .is_string($verificationkey)."<br>". is_string($block)."<br>" .is_string($address)."<br>". is_string($phno)."<br>". is_string($gender);*/
	
?>