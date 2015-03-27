<?php
	session_start();
	require_once("include/configuration.php");
	require_once("include/functions.php");
	error_reporting_mode();
	getsiteconfiguration();
	
	if($_SESSION["username"] == null || $_SESSION["userid"] == null || $_SESSION["email"] == null)
		{
			$_SESSION["warning_message"] = "Please Login!";
			redirect_to("login.php");
			
		}
	
	
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
						$update_result = update_field(verificationkey, 0, username, $username, $table_name);
						if($update_result == true)
							{
								$update_result = update_field(status, 1, username, $username, $table_name);
								if($update_result == true)
									{
										$_SESSION["dashboard_success"] = "Email sucessfully verified!";
									}
								else
									{
										$_SESSION["dashboard_fail"] = "Status failed sent error message to Admin!";
									}
							}
						else
							{
								$_SESSION["dashboard_fail"] = "failed to set verification key";
							}
					}
				else
					{
						$_SESSION["dashboard_fail"] = "Invalid verification key!";
					}
				}
			else
				{
				$_SESSION["dashboard_fail"] = "failed fetch verification key details";
				}
		}
		
		
echo header_page();
//echo set_user_details_variables();
	
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
		
		
		
//sidebar and navigation bar
echo navigation($block, $aadhar, $username, $deptid);
echo sidebar($block, $aadhar, $username, $deptid);
echo "<div class=\"col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main\">";

	if($block == "1")
		{
			$error_mesasge = "Admin is blocked please contact us in contact areas about your problem!";
			echo $error_mesasge;
			die("Admin is blocked please contact us in contact areas about your problem!");
		}
	if($_SESSION["dashboard_success"] != null)
				{
				echo "<div class=\"form-group\">";
            	echo "<div class=\"alert alert-success alert-dismissible\" role=\"alert\">";
  				echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
  				echo "<strong>". $_SESSION["dashboard_success"] ."</strong>";
				$_SESSION["dashboard_success"] = null;
				echo "</div>";
            
            	echo "</div>";
				
				}
			
			if($_SESSION["dashboard_fail"] != null)
				{
				echo "<div class=\"form-group\">";
            	echo "<div class=\"alert alert-danger alert-dismissible\" role=\"alert\">";
  				echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
  				echo "<strong>". $_SESSION["dashboard_fail"] ."</strong>";
				$_SESSION["dashboard_fail"] = null;
				echo "</div>";
            
            	echo "</div>";
				
				}
	if($status == "0" && $verificationkey != "0")
				{
					$error_mesasge = "<p>Please verify email address and entercode</p>";
					echo $error_mesasge;
					
					echo "<form role=\"form\" method=\"POST\" action=\"dashboard.php\" name=\"verify_email\">";
					echo"<div class=\"form-group\">";
					echo "<input type=\"text\" name=\"verificationkey\" id=\"verificationkey\" class=\"form-control input-lg\" placeholder=\"Verification Code\" tabindex=\"3\"  required>";
            		echo "</div>";
					echo "<div class=\"row\">";
					echo "<div class=\"col-xs-12 col-md-6\"><input type=\"submit\" value=\"verificationkey\" class=\"btn btn-primary btn-block btn-lg\" tabindex=\"7\" name=\"login\"></div>";
				
					echo "</form>";
				}
	if($aadhar == "0")
				{
					$error_message = "<p>Please update aadhar number in profile.</p>";
					echo $error_mesasge;
				}
	else
				{
					echo "you can post complaint and view complaint!";
				
					
				}
	
						/*echo is_string($userid)."<br>" .is_string($email)."<br>". is_string($username)."<br>". is_string($type)."<br>". is_string($deptid)."<br>". is_string($aadhar)."<br>". is_string($status)."<br>" .is_string($verificationkey)."<br>". is_string($block)."<br>" .is_string($address)."<br>". is_string($phno)."<br>". is_string($gender);*/


echo "</div>";
echo footer();
?>