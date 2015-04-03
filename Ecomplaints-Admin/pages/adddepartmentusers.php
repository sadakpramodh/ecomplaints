<?php
session_start();
require_once("../../include/configuration.php");
require_once("../../include/functions.php");
error_reporting_mode();
getsiteconfiguration();
require_once("header.php");
require_once("navigationbar.php");
require_once("sidebar.php");
?>

<?php
if(isset($_POST["adddepartmentuser"]))
		{
			
			$email = $_POST["email"];
			$username = $_POST["username"];
			$password = $_POST["password"];
			$type = $_POST["type"];
			$deptid = $_POST["deptid"];
			
			
		
			//validation
			
			$errors = array();
			
			if(!isset($email[5]) || isset($email[30]))
				{
    			$errors["email"] = "email is too long / short!";
				}
			$email_result = check_email_db($email);
			if($email_result == true)
				{
				$errors["emailaddress"] = "Email is already taken. Please enter another email !";
				}
				
			if(!isset($username[6]) || isset($username[25]))
				{
    			$errors["username"] = "username is too long / short!";
				}
			$username_result = check_username($username);
			if($username_result == true)
				{
				$errors["username_exists"] = "username is already taken. Please enter another username !";
				}
			if(!isset($password[6]) || isset($password[25]))
				{
    			$errors["password"] = "password is too long / short!";
				}
			if(!isset($deptid))
				{
    			$errors["dept"] = "Please select department!";
				}
			if(!isset($type))
				{
    			$errors["type"] = "Please select type!";
				}
			
			if(empty($errors))
				{
					databaseconnectivity_open();
					global $connection;
			
					$username = mysqli_real_escape_string($connection, $username);
					$password = mysqli_real_escape_string($connection, $password);
					$email = mysqli_real_escape_string($connection, $email);
					$query = "INSERT INTO `users`(`username`, `password`, `email`, `type`, `deptid`, `status`, `verificationkey`, `block`, `aadhar`, `address`, `phno`, `gender`) VALUES (\"";
					$query .= $username ."\",\"";
					$query .= $password ."\",\"";
					$query .= $email ."\",\"";
					$query .= $type ."\",". $deptid .",0,\"";
					$verificationkey = rand(1,99999);
					$query .= $verificationkey ."\",0,\"0\",\"0\",\"0\",\"0\")";
					
					$result = mysqli_query($connection, $query);
					if(!$result)
						{
						$_SESSION["error_number"] = "2007";
						$_SESSION["error_message"] = "Query failed while user is registering and inserting details in database". mysqli_error($connection);
						
						$string = "error.php?error_number=";
						$string .= urlencode("DB_Query_Failed");
						$string .= "&error_message=";
						$string .= urlencode("Query failed while user is registering and inserting details in database");
						
						redirect_to($string);
						}
					else
						{
						$_SESSION["registration_message"] = "Registration sucessfully done! Please login !";
						$subject = "You are sucessfully registered on ".$_SESSION["sitename"].", Please verify your email address";
						$message = "Your verification code is : ".$verificationkey;
						sendmail($email1, $subject, $message);
						
						$_SESSION["adduserdept"] = "success";
						}
						
					mysqli_free_result($result);
					
					databaseconnectivity_close();
					
				}
						
		}
        
        ?>         

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add users to departments</h1>
                    


<?php
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
						
						if($_SESSION["adduserdept"] == "success")
                        {
                        echo "<div class=\"form-group\">";
                        echo "<div class=\"alert alert-success alert-dismissible\" role=\"alert\">";
                        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
                        echo "<strong>";
                        echo "user added!";
                        echo "</strong>";
                        
                        echo "</div>";
                    
                        echo "</div>";
                        $_SESSION["adduserdept"] = null;
                        }
                    ?>
					
                    
                    
                    
                    <form role="form" class="form-horizontal col-sm-6" name="postcomplaint" method="post" action="adddepartmentusers.php">
                     
                  <div class="form-group">
                        <label for="email" class ="control-label">Email</label>
                       	
                            <input name="email" type="text" class="form-control" id = "email" placeholder="Email"  required>
                          
                     	
                      </div>
                      
        		<div class="form-group">
          			<label for="username">Username:</label>
          			<input type="text" name="username" class="form-control" id="username" placeholder="Enter Username" size="20" required>
        		</div>
        	
              <div class="form-group">
      				<label for="password">Password:</label>
      				<textarea class="form-control" rows="5" id="password" name="password" required></textarea>
    			</div>
              <div class="form-group">
                        <label for="type" class ="control-label" required>Type</label>
                        <select name="type">
                        <option value=""> </option>
                        <option value="managers">Manager</option>
                        <option value="assoc managers">Associate Managers</option>
                        
                        </select>
                       		
              </div>
              
                      
                  <div class="form-group">
                                            <label>Select Department</label>
                                            <select class="form-control" name="deptid" required>
                                            <option></option>
                                            <?php
                                            databaseconnectivity_open();
		
											global $connection;
											$query = "SELECT * FROM departments";
											$result = mysqli_query($connection, $query);
											if(!$result)
												{
												$_SESSION["error_number"] = "2011";
												$_SESSION["error_message"] = "Query failed while getting departments";
			
												$string = "error.php?error_number=";
												$string .= urlencode("DB_Query_Failed");
                                                $string .= "&error_message=";
                                                $string .= urlencode("Query failed while getting departments");
                                                
                                                redirect_to($string);
                                                }
                                            else
                                                {
                                                    while($row = mysqli_fetch_assoc($result))
                                                        {
															echo "<option value=\"".$row["deptid"]."\">".$row["deptname"]."</option>";
														}
												}
												
											mysqli_free_result($result);
											
											databaseconnectivity_close();
                                                  ?>      
                                            
                                            </select>
                  </div>
                	
        			<button type="submit" class="btn btn-default" name="adddepartmentuser">Add user</button>
                    <button type="reset" class="btn btn-danger" name="reset">Reset</button>
		 </form>
       
                    
                    
                    
                            
                </div>

<?php
   require_once("footer.php");
?>