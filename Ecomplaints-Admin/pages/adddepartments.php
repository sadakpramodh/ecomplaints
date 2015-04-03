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
   require_once("footer.php");
?>