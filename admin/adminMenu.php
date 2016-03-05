<?php
    defined('QDP') or die('Restricted access');
    function createMenu($activePage){

        $dir = array_slice(scandir(adminRootFolder.'/adminContent'),2); //scan the main content folder and store all 1st level folders

        foreach ($dir as $key => $value) { //for each folder, check if there are subfolders
            if (is_dir(adminRootFolder.'/adminContent/'.$value)){ //if a folder is found in a subfolder

                $lookForFiles = array_slice(scandir(adminRootFolder.'/adminContent/'.$value),2);         //scan for every folder inside the parent   
                
                foreach ($lookForFiles as $files => $file) { //remove the entries that are folders
                    if (is_dir(adminRootFolder.'/adminContent/'.$value.DIRECTORY_SEPARATOR.$file)){
                        unset($lookForFiles[$files]);
                    }
                }

                if ($value == "00.Home"){//lay down the start of the li tag

                echo '<li '.isActive($activePage, $value).'><a href="./">'.substr($value, 3).'</a>';
                } else {
                echo '<li '.isActive($activePage, $value).'><a href="../admin/index.php?cat='.urlencode($value).'">'.substr($value, 3).'</a>';
                }
                echo '</li>'; //close the original list item

            }
        }

    }

    function isActive($page, $active){  //this function will be called with two parameters: the pagename, and what page is active. this information is generated by the pagename script
        if ($page == ""){
            $page = "00.Home"; 
        }
        
        if ($page == $active) {
            return ' class="active" ';    //if the pagename and the active page are matching, then, the link will be marked as active
        } else {
            return '';
        }
    }

?>