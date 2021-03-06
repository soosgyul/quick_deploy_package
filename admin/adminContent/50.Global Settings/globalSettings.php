<?php
/**
* @about: The file will allow the user, to change the global settings of the site. 
* these settings include the site name, description, timezone, template to use, email address that is used in the contact
* 
* Also the site can be put offline.
* 
* PHP version 5.4
*
* @version          2.0 - 30/01/2017
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

$str_data = file_get_contents(siteRootFolder.DS.'siteSettings.json');
$siteSettings = json_decode($str_data, true);

//when the save button pressed, store each data in the siteSettings array
if (isset($_POST["save"])){


  $siteSettings['siteFromYear'] = $_POST["siteFromYear"];
  $siteSettings['timezone'] = $_POST["timezone"];
  $siteSettings['template'] = $_POST["template"];
  $siteSettings['contactEmail'] = $_POST["contactEmail"];
  $siteSettings['outgoingEmailFrom'] = $_POST["outgoingEmailFrom"];
  $siteSettings['recaptchaSiteKey'] = $_POST["recaptchaSiteKey"];
  $siteSettings['recaptchaSecret'] = $_POST["recaptchaSecret"];
  $siteSettings['offline'] = isset($_POST["offline"]) ? true : false;


  //save the array as a json file and then refresh the page
  file_put_contents(siteRootFolder.DS.'siteSettings.json', json_encode($siteSettings, JSON_PRETTY_PRINT));
  header("Refresh:0");
}

//generate a list of the available templates located in the templates folder 
function getTemplates($location, $siteSettings){
  if ($location == "site"){
    $templateFolder = '../templates/';
} elseif ($location == "admin"){
    $templateFolder = 'template/';
}
$availableTemplates = array_diff(scandir($templateFolder), array('..', '.',));

foreach ($availableTemplates as $key => $value) {
    //will return something like this:
    //<option name='template' id='template' value='whatever folders found'>Whatever the folder name is</option>
    echo "\n<option value='".$value."' ";
    if($siteSettings['template'] == $value){
      echo ('selected="selected"');
  }
  echo ">".$value."</option>";
}
}

//list available timezones for the site.
function getTimezones($siteSettings){
/**
 * Timezones list with GMT offset
 *
 * @return array
 * @link http://stackoverflow.com/a/9328760
 * @link http://stackoverflow.com/questions/4755704/php-timezone-list
 */
$timezones = array(
    'Pacific/Midway'       => "(GMT-11:00) Midway Island",
    'US/Samoa'             => "(GMT-11:00) Samoa",
    'US/Hawaii'            => "(GMT-10:00) Hawaii",
    'US/Alaska'            => "(GMT-09:00) Alaska",
    'US/Pacific'           => "(GMT-08:00) Pacific Time (US &amp; Canada)",
    'America/Tijuana'      => "(GMT-08:00) Tijuana",
    'US/Arizona'           => "(GMT-07:00) Arizona",
    'US/Mountain'          => "(GMT-07:00) Mountain Time (US &amp; Canada)",
    'America/Chihuahua'    => "(GMT-07:00) Chihuahua",
    'America/Mazatlan'     => "(GMT-07:00) Mazatlan",
    'America/Mexico_City'  => "(GMT-06:00) Mexico City",
    'America/Monterrey'    => "(GMT-06:00) Monterrey",
    'Canada/Saskatchewan'  => "(GMT-06:00) Saskatchewan",
    'US/Central'           => "(GMT-06:00) Central Time (US &amp; Canada)",
    'US/Eastern'           => "(GMT-05:00) Eastern Time (US &amp; Canada)",
    'US/East-Indiana'      => "(GMT-05:00) Indiana (East)",
    'America/Bogota'       => "(GMT-05:00) Bogota",
    'America/Lima'         => "(GMT-05:00) Lima",
    'America/Caracas'      => "(GMT-04:30) Caracas",
    'Canada/Atlantic'      => "(GMT-04:00) Atlantic Time (Canada)",
    'America/La_Paz'       => "(GMT-04:00) La Paz",
    'America/Santiago'     => "(GMT-04:00) Santiago",
    'Canada/Newfoundland'  => "(GMT-03:30) Newfoundland",
    'America/Buenos_Aires' => "(GMT-03:00) Buenos Aires",
    'Greenland'            => "(GMT-03:00) Greenland",
    'Atlantic/Stanley'     => "(GMT-02:00) Stanley",
    'Atlantic/Azores'      => "(GMT-01:00) Azores",
    'Atlantic/Cape_Verde'  => "(GMT-01:00) Cape Verde Is.",
    'Africa/Casablanca'    => "(GMT) Casablanca",
    'Europe/Dublin'        => "(GMT) Dublin",
    'Europe/Lisbon'        => "(GMT) Lisbon",
    'Europe/London'        => "(GMT) London",
    'Africa/Monrovia'      => "(GMT) Monrovia",
    'Europe/Amsterdam'     => "(GMT+01:00) Amsterdam",
    'Europe/Belgrade'      => "(GMT+01:00) Belgrade",
    'Europe/Berlin'        => "(GMT+01:00) Berlin",
    'Europe/Bratislava'    => "(GMT+01:00) Bratislava",
    'Europe/Brussels'      => "(GMT+01:00) Brussels",
    'Europe/Budapest'      => "(GMT+01:00) Budapest",
    'Europe/Copenhagen'    => "(GMT+01:00) Copenhagen",
    'Europe/Ljubljana'     => "(GMT+01:00) Ljubljana",
    'Europe/Madrid'        => "(GMT+01:00) Madrid",
    'Europe/Paris'         => "(GMT+01:00) Paris",
    'Europe/Prague'        => "(GMT+01:00) Prague",
    'Europe/Rome'          => "(GMT+01:00) Rome",
    'Europe/Sarajevo'      => "(GMT+01:00) Sarajevo",
    'Europe/Skopje'        => "(GMT+01:00) Skopje",
    'Europe/Stockholm'     => "(GMT+01:00) Stockholm",
    'Europe/Vienna'        => "(GMT+01:00) Vienna",
    'Europe/Warsaw'        => "(GMT+01:00) Warsaw",
    'Europe/Zagreb'        => "(GMT+01:00) Zagreb",
    'Europe/Athens'        => "(GMT+02:00) Athens",
    'Europe/Bucharest'     => "(GMT+02:00) Bucharest",
    'Africa/Cairo'         => "(GMT+02:00) Cairo",
    'Africa/Harare'        => "(GMT+02:00) Harare",
    'Europe/Helsinki'      => "(GMT+02:00) Helsinki",
    'Europe/Istanbul'      => "(GMT+02:00) Istanbul",
    'Asia/Jerusalem'       => "(GMT+02:00) Jerusalem",
    'Europe/Kiev'          => "(GMT+02:00) Kyiv",
    'Europe/Minsk'         => "(GMT+02:00) Minsk",
    'Europe/Riga'          => "(GMT+02:00) Riga",
    'Europe/Sofia'         => "(GMT+02:00) Sofia",
    'Europe/Tallinn'       => "(GMT+02:00) Tallinn",
    'Europe/Vilnius'       => "(GMT+02:00) Vilnius",
    'Asia/Baghdad'         => "(GMT+03:00) Baghdad",
    'Asia/Kuwait'          => "(GMT+03:00) Kuwait",
    'Africa/Nairobi'       => "(GMT+03:00) Nairobi",
    'Asia/Riyadh'          => "(GMT+03:00) Riyadh",
    'Europe/Moscow'        => "(GMT+03:00) Moscow",
    'Asia/Tehran'          => "(GMT+03:30) Tehran",
    'Asia/Baku'            => "(GMT+04:00) Baku",
    'Europe/Volgograd'     => "(GMT+04:00) Volgograd",
    'Asia/Muscat'          => "(GMT+04:00) Muscat",
    'Asia/Tbilisi'         => "(GMT+04:00) Tbilisi",
    'Asia/Yerevan'         => "(GMT+04:00) Yerevan",
    'Asia/Kabul'           => "(GMT+04:30) Kabul",
    'Asia/Karachi'         => "(GMT+05:00) Karachi",
    'Asia/Tashkent'        => "(GMT+05:00) Tashkent",
    'Asia/Kolkata'         => "(GMT+05:30) Kolkata",
    'Asia/Kathmandu'       => "(GMT+05:45) Kathmandu",
    'Asia/Yekaterinburg'   => "(GMT+06:00) Ekaterinburg",
    'Asia/Almaty'          => "(GMT+06:00) Almaty",
    'Asia/Dhaka'           => "(GMT+06:00) Dhaka",
    'Asia/Novosibirsk'     => "(GMT+07:00) Novosibirsk",
    'Asia/Bangkok'         => "(GMT+07:00) Bangkok",
    'Asia/Jakarta'         => "(GMT+07:00) Jakarta",
    'Asia/Krasnoyarsk'     => "(GMT+08:00) Krasnoyarsk",
    'Asia/Chongqing'       => "(GMT+08:00) Chongqing",
    'Asia/Hong_Kong'       => "(GMT+08:00) Hong Kong",
    'Asia/Kuala_Lumpur'    => "(GMT+08:00) Kuala Lumpur",
    'Australia/Perth'      => "(GMT+08:00) Perth",
    'Asia/Singapore'       => "(GMT+08:00) Singapore",
    'Asia/Taipei'          => "(GMT+08:00) Taipei",
    'Asia/Ulaanbaatar'     => "(GMT+08:00) Ulaan Bataar",
    'Asia/Urumqi'          => "(GMT+08:00) Urumqi",
    'Asia/Irkutsk'         => "(GMT+09:00) Irkutsk",
    'Asia/Seoul'           => "(GMT+09:00) Seoul",
    'Asia/Tokyo'           => "(GMT+09:00) Tokyo",
    'Australia/Adelaide'   => "(GMT+09:30) Adelaide",
    'Australia/Darwin'     => "(GMT+09:30) Darwin",
    'Asia/Yakutsk'         => "(GMT+10:00) Yakutsk",
    'Australia/Brisbane'   => "(GMT+10:00) Brisbane",
    'Australia/Canberra'   => "(GMT+10:00) Canberra",
    'Pacific/Guam'         => "(GMT+10:00) Guam",
    'Australia/Hobart'     => "(GMT+10:00) Hobart",
    'Australia/Melbourne'  => "(GMT+10:00) Melbourne",
    'Pacific/Port_Moresby' => "(GMT+10:00) Port Moresby",
    'Australia/Sydney'     => "(GMT+10:00) Sydney",
    'Asia/Vladivostok'     => "(GMT+11:00) Vladivostok",
    'Asia/Magadan'         => "(GMT+12:00) Magadan",
    'Pacific/Auckland'     => "(GMT+12:00) Auckland",
    'Pacific/Fiji'         => "(GMT+12:00) Fiji",
    );

foreach ($timezones as $key => $value) {
    echo "\n<option value='".$key."' ";
    if($siteSettings['timezone'] == $key){
      echo ('selected="selected"');
  }
  echo ">".$value."</option>";
}
}

?> 


<p>All these informations are used in the main site (and some in the admin interface) at various locations. For example the sitename is used in the page title, the footer and in the sent out emails in the contact form. </p>
<p>Feel free to modify these, just make sure, that you don't leave them empty, so all my work doesn't goes to waste!</p>
<!-- global settings form -->
<form method="post" name="globalSettingsForm" id="globalSettingsForm" action="#">
  <div id="form">


    <p>
        <label>The year the site operates from:</label>
        <br />
        <input name="siteFromYear" type="number" id="siteFromYear" size="50" value="<?php echo $siteSettings['siteFromYear']; ?>" />
    </p>

    <p>
      <label>Set the timezone of the site:</label>
      <br />
      <select name="timezone" id="timezone" >
        <?php getTimezones($siteSettings); ?>
    </select>
</p>

<p>
    <label>Template:</label>
    <br />
    <select name="template" id="template" >
      <?php getTemplates("site", $siteSettings); ?>
  </select>
</p>

<p>
    <label>The email address the site should write to when a contact form is sent:</label>
    <br />
    <input required name="contactEmail" type="email" id="contactEmail" size="50" value="<?php echo $siteSettings['contactEmail'];?>" />
</p>

<p>
    <label>The email address that the site is sending emails from:</label>
    <br />
    <input required name="outgoingEmailFrom" type="email" id="outgoingEmailFrom" size="50" value="<?php echo $siteSettings['outgoingEmailFrom'];?>" />
</p>

<p>
    <label>Google's reCaptcha site key:</label>
    <br />
    <input required name="recaptchaSiteKey" type="text" id="recaptchaSiteKey" size="50" value="<?php echo $siteSettings['recaptchaSiteKey'];?>" />
</p>

<p>
    <label>Google's reCaptcha secret key:</label>
    <br />
    <input required name="recaptchaSecret" type="text" id="recaptchaSecret" size="50" value="<?php echo $siteSettings['recaptchaSecret'];?>" />
</p>

<p>
    <label style="color:red;">Site offline? CAUTION! (but you can uncheck it any time!)</label>
    <input name="offline" type="checkbox" id="offline" size="50" <?php echo $siteSettings['offline'] ? "checked":"";?> />
</p>

<p>
    <input name="save" type="submit" id="save" value="Save settings" />
</p>
</div>
</form>

<?php 
    //the wyswyg editor for the textareas in the forms
include(adminRootFolder.'/helpers/wyswyg.php'); 
?>