<?php

/*

 Website Baker Project <http://www.websitebaker.org/>
 Copyright (C) 2004-2007, Ryan Djurovich

 Website Baker is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 Website Baker is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with Website Baker; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/

// Must include code to stop this file being access directly
if(defined('LEPTON_PATH') == false) { exit("Cannot access this file directly"); }

$mpath = LEPTON_PATH.'/modules/team/';
if (!file_exists($mpath.'module_settings.php')) { copy($mpath.'module_settings.default.php', $mpath.'module_settings.php') ; }
if (!file_exists($mpath.'frontend.css')) { copy($mpath.'frontend.default.css', $mpath.'frontend.css') ; }
if (!file_exists($mpath.'frontend.js')) { copy($mpath.'frontend.default.js', $mpath.'frontend.js') ; }


//Get module settings file
require('module_settings.default.php');// These are the default setting
require('module_settings.php'); //These may have been changed by the user

$header = addslashes($header);
$footer = addslashes($footer);

$theader = addslashes($theader);
$tloop = addslashes($tloop);
$tfooter = addslashes($tfooter);
$bheader = addslashes($bheader);
$bloop = addslashes($bloop);
$bfooter = addslashes($bfooter);

$hide_email = $hide_email_default;
$pic_loc = $pic_loc_default;


$database->query("INSERT INTO ".TABLE_PREFIX."mod_team_settings (section_id, page_id, header, footer, theader, tloop, tfooter, bheader, bloop, bfooter, hide_email, pic_loc, sort_nogrp_team) VALUES ('$section_id', '$page_id', '$header', '$footer', '$theader', '$tloop', '$tfooter', '$bheader', '$bloop', '$bfooter', '$hide_email', '$pic_loc', '1')");

?>