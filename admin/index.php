<?php
/**
* @about: This is the main landing index page for the backend. 
* 
* PHP version 5.4
*
* @version          1.0 - 06/03/2016
* @package          This file is part of QDP - QUICK DEVELOPMENT PACKAGE - THE DATABASE FREE CMS
* @copyright        (C) 2016 Gyula Soós
* @license          This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* See LICENSE.txt for copyright notices and details.
*/

define('QDP', TRUE); //defines a variable, that is checked in all other included php files. If those php files are not called by the index, it will restrict access to them

//defining various locations on the site structure
define('adminRootFolder', dirname(__DIR__).'/admin');
define('siteRootFolder', dirname(__DIR__));
define('DS', DIRECTORY_SEPARATOR);

//reading and storing the data regarding the siteSettings and adminSettings from the respective json files
$str_data = file_get_contents(siteRootFolder.'/siteSettings.json');
$siteSettings = json_decode($str_data, true);

$str_admindata = file_get_contents(adminRootFolder.'/adminSettings.json');
$adminSettings = json_decode($str_admindata, true);

//reading and storing variables from the URL
if (isset($_GET["cat"])){
    $activeMenuItem = $_GET["cat"];
} else {
    $activeMenuItem = "00.Home";
}

if (isset($_GET["menuItem"])){
    define ('menuItem', $_GET["menuItem"]);
} else {
    define ('menuItem', null);
}
//get the template for the site
include_once(adminRootFolder.DS.'adminTemplateSelector.php');
?>

<script type="text/javascript">
   //checking user authentication
   var ref = new Firebase("<?php echo $adminSettings['firebase']; ?>");    

    var authData = ref.getAuth();
    if (authData) {
      console.log("User is authenticated!");
      document.getElementById("container").style.display = "block";
    } else {
      var login = "login.php";
      window.location.href = login;
      console.log("I'm not authenticated;")
    }

    $('#signOut').on("click", function (){ 
      console.log("sign out pressed");
      document.getElementById("container").style.display = "none";
      ref.unauth();
      location.reload();
    });
    
var gravatar = document.getElementById("gravatar");
gravatar.src = authData.password.profileImageURL;
</script>
