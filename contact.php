<?php
session_start();
require_once("include/configuration.php");
require_once("include/functions.php");
error_reporting_mode();
getsiteconfiguration();

if(isset($_POST["contact"]))
	{
		$name = $_POST["name"];
		$email = $_POST["email"];
		$message = $_POST["message"];
		
		$clientipaddress = $_POST["clientipaddress"];
		$clientipaddressbyipserver = $_POST["clientipaddressbyipserver"];
		$clientipaddressbyipenv = $_POST["clientipaddressbyipenv"];
		$clientipaddress = ipaddress_details($clientipaddress);
		$clientipaddressbyipserver = ipaddress_details($clientipaddressbyipserver);
		$clientipaddressbyipenv = ipaddress_details($clientipaddressbyipenv);
		
		$to = "{$_SESSION['supportemail']} , {$email}" ;
		$subject = "Support is needed to {$name} !";
		$result = sendmail($to, $subject, $message);
		if($result)
			{
				echo "$to , $subject , $message";
				$_SESSION["status"]="Mail Sent!";
			}
		else
			{
				$_SESSION["status"]="Mail Not Sent!";
			}
	}
echo header_page();
echo navigation();
echo sidebar();
?>



<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h2 class="sub-header">Contact us</h2>
          <form role="form" class="form-horizontal col-sm-6" name="contact" method="post" action="contact.php">
        		<div class="form-group">
          			<label for="name">Name:</label>
          			<input type="text" name="name" class="form-control" id="name" placeholder="Enter name" size="20" value="<?php echo $_SESSION["username"]; ?>">
        		</div>
        		<div class="form-group">
          			<label for="email">Email:</label>
          			<input type="email" name="email" class="form-control" id="email" placeholder="Enter email" size="20" value="<?php echo $_SESSION["email"]; ?>">
        		</div>
              <div class="form-group">
      				<label for="message">Message:</label>
      				<textarea class="form-control" rows="5" id="message" name="message"></textarea>
    			</div>
                	<input type="hidden" name="clientipaddress" class="form-control" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
                    <input type="hidden" name="clientipaddressbyipserver" class="form-control" value="<?php echo get_client_ip_server(); ?>">
                    <input type="hidden" name="clientipaddressbyipenv" class="form-control" value="<?php echo get_client_ip_env(); ?>">
                    
        			<button type="submit" class="btn btn-default" name="contact">Submit</button>
                    <button type="reset" class="btn btn-danger" name="reset">Reset</button>
		 </form>
       
        </div>
      </div>
    </div>
    
<?php
echo footer();
?>