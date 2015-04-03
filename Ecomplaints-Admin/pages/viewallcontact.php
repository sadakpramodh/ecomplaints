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
                          

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View all contacts</h1>
                    
                    
                          <div class="table-responsive">
        <table class="table table-striped">
                                              <thead>
                                                <tr>
                                                  <th>Contactt UID</th>
                                                  <th>Username</th>
                                                  <th>Subjects</th>
                                                  <th>Ipaddress 1</th>
                                                  <th>Ipaddress 2</th>
                                                  <th>Ipaddress 3</th>
                                               
                                                  <th>User ID</th>
                                                  <th>Email</th>
                                                  <th>Date</th>
                                                  <th>Reply</th>
                                             
                                                </tr>
                                              </thead>
                                              <tbody>
                                            <?php
											databaseconnectivity_open();
		
											global $connection;
											$query = "SELECT * FROM contact";
											
											$result = mysqli_query($connection, $query);
											if(!$result)
												{
												$_SESSION["error_number"] = "3000";
												$_SESSION["error_message"] = "Query failed while getting complaints";
			
												$string = "error.php?error_number=";
												$string .= urlencode("DB_Query_Failed");
												$string .= "&error_message=";
												$string .= urlencode("Query failed while getting complaints");
												
												redirect_to($string);
												}
											else
												{
													while($row = mysqli_fetch_assoc($result))
														{
											echo '<tr>';
											echo '<td>'. $row['contactuid'] . '</td>';
											echo '<td>'. $row['username'] . '</td>';
											echo '<td>'. $row['subjects'] . '</td>';
											echo '<td>'. $row['ipaddress1'] . '</td>';
											echo '<td>'. $row['ipaddress2'] . '</td>';
											echo '<td>'. $row['ipaddress3'] . '</td>';
											echo '<td>'. $row['userid'] . '</td>';
											echo '<td>'. $row['email'] . '</td>';
											echo '<td>'. $row['date'] . '</td>';
										
											
										
											echo '<td>'. $row['reply'] . '</td>';
											
											echo '</tr>';
														}
												}
											mysqli_free_result($result);
														
											databaseconnectivity_close();
					  
											?>
                                            
                                            </tbody>
                                        </table>
                                         </div>
                    
                </div>

<?php
   require_once("footer.php");
?>