<?php
session_start();
require_once("include/configuration.php");
require_once("include/functions.php");
error_reporting_mode();
getsiteconfiguration();
echo header_page();
//echo navigation();
//echo sidebar();
/*
session_start();
include_once("include/configuration.php");

	$connection = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname);
	if(mysqli_connect_errno())
		{
			die("Database Connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")" );
		}

		$query = "SELECT * FROM configuration LIMIT 1";
		$result = mysqli_query($connection, $query);
		if(!$result)
			{
				die("query failed");
			}
		else
			{
				while($row = mysqli_fetch_assoc($result))
					{
						$_SESSION['sitename'] = $row["sitename"];
						$_SESSION['sitestatus'] = $row["sitestatus"];
						$_SESSION['alloregister'] = $row["allowregister"];
						$_SESSION['allologin'] = $row["allowlogin"];
						$_SESSION['stopaddingcomplaints'] = $row["stopaddingcomplaints"];
						$_SESSION['supportemail'] = $row["supportemail"];
						
						echo $_SESSION["sitename"];
				//var_dump($row);
					}
			}
			
		mysqli_free_result($result);


		if(isset($connection))
			{
			mysqli_close($connection);
			}



$error_code = "2002";
$error_message = "Hey error occured. ?";
$string = "error.php?error_number=";
$string .= rawurlencode($error_code);
$string .= "&error_message=";
$string .= rawurlencode($error_message);
echo "<a href=\"{$string}\">sss</a>";
echo $string;

*/

?>

<!--div class="progress">
  <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
    100%
  </div>
</div-->
<?php
//echo footer();
/*$password = "1234567809";
$password_confirmation = "123456789";
if(!($password === $password_confirmation))
			{
			echo "Passwords doesn't match !";
			}
			
	else {	echo "matched"; }
	
	
	$password = "123456789";
	$password_confirmation = "123456789";

	if(!isset($password[5]) || isset($password[16]))
			{
    		$errors["password"] = "Password too short or too long !";
			}
	if(!($password === $password_confirmation))
			{
			$errors["passwordsmatch"] = "Passwords doesn't match !";
			}
			
			
	echo "OK";
	
	*/
	?>
	<form role="form" method="POST" action="dashboard.php" name="verify_email">
	<div class="form-group">
				<input type="text" name="verificationkey" id="verificationkey" class="form-control input-lg" placeholder="Verification Code" tabindex="3"  required>
            </div>
		<div class="row">
				<div class="col-xs-12 col-md-6"><input type="submit" value="verificationkey" class="btn btn-primary btn-block btn-lg" tabindex="7" name="login"></div>
				
                
               
		</form>
	
	<?php
	echo footer();
?>



