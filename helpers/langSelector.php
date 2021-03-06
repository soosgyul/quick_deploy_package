<?php
/**
* @about:This file will display the language selector icons
* 
* 
* 
* PHP version 5.4
*
* @version          1.0 - 26/01/2017
* @package          This file is part of QDP - QUICK DEVELOPMENT PACKAGE - THE DATABASE FREE CMS
* @copyright        (C) 2017 Gyula Soós
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
defined('QDP') or die('Restricted access');

$str_data = file_get_contents(rootFolder.'/siteSettings.json');
$siteSettings = json_decode($str_data, true);

$url = $_SERVER['REQUEST_URI'];

echo '<style type="text/css"> @import url("'.siteDomain.'/plugins/languageSelector/flags.css") </style>';

echo '<ul id="langSelector">';
	foreach ($siteSettings["languages"] as $key => $language) {

		echo '<li class="flag flag-'.$language.'">';
		echo '<a href="';
		echo '/index.php?lang='.$language;
		echo '"></a></li>';
	}
echo '</ul>';

?>

