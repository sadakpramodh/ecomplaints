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
										echo "Email is sucessfully validated!";
									}
								else
									{
										echo "Failed to set status";
									}
							}
						else
							{
								echo "failed to set verification key";
							}
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
		
if(isset($_POST["update"]))
	{
		$aadhar = $_POST["aadhar"];
		$address = $_POST["address"];
		$phno = $_POST["phno"];
		$gender = $_POST["gender"];
		$errors = array();
		if(!isset($aadhar[12]) || isset($name[14]))
			{
    		$errors["aadhar"] = "Invalid aadhar format!";
			}
		if(empty($errors))
			{
				$res = update_field(aadhar,$aadhar, username, $username, users);
				if($res == true)
					{
						$update_res["aadhar"] = "Aadhar is updated !";
					}
				else
					{
						$update_res["aadhar"] = "Aadhar updation failed !";
					}
				$res = update_field(address,$address, username, $username, users);
				if($res == true)
					{
						$update_res["address"] = "Address is updated !";
					}
				else
					{
						$update_res["aadhar"] = "Address updation failed !";
					}
				$res = update_field(phno,$phno, username, $username, users);
				if($res == true)
					{
						$update_res["phno"] = "Phone Number is updated !";
					}
				else
					{
						$update_res["phno"] = "Phone Number updation failed !";
					}
					
				if(!isset($_POST["gender"]))
				{
				$res = update_field(gender,$gender, username, $username, users);
				if($res == true)
					{
						$update_res["gender"] = "Gender is updated !";
					}
				else
					{
						$update_res["gender"] = "Gender updation failed !";
					}
				}
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
		
		
	
		
		
//sidebar and navigation bar
echo navigation($block, $aadhar, $username, $deptid);
echo sidebar($block, $aadhar, $username, $deptid);
echo "<div class=\"col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main\">";

		
			if(!empty($errors))
				{
				echo "<div class=\"form-group\">";
            	echo "<div class=\"alert alert-danger alert-dismissible\" role=\"alert\">";
  				echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
  				echo "<strong>";
				echo " Please review following errors<br>";
				 foreach ($errors as $error) 
					{
    				echo $error . "<br>";
					} 
				echo "</strong>";
				
				echo "</div>";
            
            	echo "</div>";
				
				}
			if(!empty($update_res))
				{
				echo "<div class=\"form-group\">";
            	echo "<div class=\"alert alert-warning alert-dismissible\" role=\"alert\">";
  				echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
  				echo "<strong>";
				echo " Please review following errors<br>";
				 foreach ($update_res as $update_res) 
					{
    				echo $update_res . "<br>";
					} 
				echo "</strong>";
				
				echo "</div>";
            
            	echo "</div>";
				
				}
		
			








	if($block == "1")
		{
			$error_mesasge = "Admin is blocked please contact us in contact areas about your problem!";
			echo $error_mesasge;
			die("Admin is blocked please contact us in contact areas about your problem!");
		}
	
?>

    <!-- Registration Form -->

          <h2 class="sub-header">Profile Details</h2>
          <form action="profile.php" method="post" role="form" class="form-horizontal col-sm-6">
                      <div class="control-group">
                        <label for = "userid" class = "control-label">User ID</label>
                       	<div class="controls">
                            <input name="userid" class="form-control" type="text"  id = "userid" placeholder="User Id" value="<?php echo $userid; ?>" disabled>    
                    	</div>
                      </div>
                      
                      <div class="control-group">
                        <label for = "email" class = "control-label">Email Address</label>
                        	<div class="controls">
                            <input name="email" class="form-control" type="text" id = "email" placeholder="Email Address" value="<?php echo $email; ?>" disabled>
                      </div>
                      </div>
                      
                      <div class="control-group">
                        <label for="username" class ="control-label">Username</label>
                       		<div class="controls">
                            <input name="username" type="text" class="form-control" id = "username" placeholder="Username" value="<?php echo $username; ?>" disabled>
                          
                     		</div>
                      </div>
                  
                     <div class="control-group">
                        <label for="type" class ="control-label">Role</label>
                       		<div class="controls">
                            <input name="type" type="text" class="form-control" id = "type" placeholder="Role" value="<?php echo $type; ?>" disabled>
                          
                     		</div>
                      </div>
                     
                     <hr />
                     
                     <div class="control-group">
                        <label for="Aadhar" class ="control-label">Aadhar Number</label>
                       		<div class="controls">
                            <input name="aadhar" type="text" class="form-control" id = "aadhar" placeholder="Aadhar Number" value="<?php echo $aadhar; ?>" required>
                          
                     		</div>
                      </div>
                     
                     <div class="control-group">
                        <label for="address" class ="control-label">Address</label>
                       		<div class="controls">
                            <textarea name="address" class="form-control" id = "address" placeholder="Address" required><?php echo $address; ?></textarea>
                     		</div>
                      </div>
                     
                     <div class="control-group">
                        <label for="phno" class ="control-label">Phone Number</label>
                       		<div class="controls">
                            <input name="phno" type="text" class="form-control" id = "phno" placeholder="Phone Number" value="<?php echo $phno; ?>" required>
                          
                     		</div>
                      </div>
                     
                     <div class="control-group">
                        <label for="gender" class ="control-label">Gender</label>
                       		<div class="controls">
                            <input type="radio" name="gender" value="male" selected="<?php if($gender == "male"){ echo "selected"; }?>"/>Male
                            &nbsp;&nbsp;
                            <input type="radio" name="gender" value="female" selected="<?php if($gender == "female"){ echo "selected"; }?>"/>Female
                          
                     		</div>
                      </div>
                     
                     
                     
                     
                     
                     <p>
                          <div>
                          <button type="submit" name="update" class="btn btn-success">Update</button>
                          <button type="reset" class="btn btn-danger">Reset</button>
                          </div>
                     </p>     
                       
                    </form>

        </div>
      </div>

    <!-- Registration Form End -->

<?php	
	
						/*echo is_string($userid)."<br>" .is_string($email)."<br>". is_string($username)."<br>". is_string($type)."<br>". is_string($deptid)."<br>". is_string($aadhar)."<br>". is_string($status)."<br>" .is_string($verificationkey)."<br>". is_string($block)."<br>" .is_string($address)."<br>". is_string($phno)."<br>". is_string($gender);*/


echo "</div>";
echo footer();

?>
