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
                    <h1 class="page-header">View all complaints</h1>
                    
                    
                          <div class="table-responsive">
        <table class="table table-striped">
                                              <thead>
                                                <tr>
                                                  <th>Complaint ID</th>
                                                  <th>User ID</th>
                                                  <th>Dept ID</th>
                                                  <th>Status</th>
                                                  <th>Subject</th>
                                                  <th>Body</th>
                                               
                                                  <th>Feedback</th>
                                                  <th>Traversal details</th>
                                                  <th>Date</th>
                                             
                                                </tr>
                                              </thead>
                                              <tbody>
                                            <?php
											databaseconnectivity_open();
		
											global $connection;
											$query = "SELECT * FROM complaints";
											
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
											echo '<td>'. $row['complaintid'] . '</td>';
											echo '<td>'. $row['userid'] . '</td>';
											echo '<td>'. $row['deptid'] . '</td>';
											echo '<td>'. $row['status'] . '</td>';
											echo '<td>'. $row['subject'] . '</td>';
											echo '<td>'. $row['body'] . '</td>';
											echo '<td>'. $row['feedback'] . '</td>';
											echo '<td>'. $row['traversaldetails'] . '</td>';
											echo '<td>'. $row['date'] . '</td>';
											
											
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