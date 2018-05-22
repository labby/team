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

require('../../config.php');

// Include WB admin wrapper script
$update_when_modified = true; // Tells script to update when this page was last updated
require(LEPTON_PATH.'/modules/admin.php');

// This code removes any php tags and adds slashes
$header = addslashes(str_replace('?php', '', $_POST['header']));
$footer = addslashes(str_replace('?php', '', $_POST['footer']));

$theader = addslashes(str_replace('?php', '', $_POST['theader']));
$tloop   = addslashes(str_replace('?php', '', $_POST['tloop']));
$tfooter = addslashes(str_replace('?php', '', $_POST['tfooter']));
$bheader = addslashes(str_replace('?php', '', $_POST['bheader']));
$bloop   = addslashes(str_replace('?php', '', $_POST['bloop']));
$bfooter = addslashes(str_replace('?php', '', $_POST['bfooter']));

$pic_loc = $_POST['pic_loc'];
$sort_grp_name = $_POST['sort_grp_name'];
$sort_nogrp_team = $_POST['sort_nogrp_team'];
$hide_email = $_POST['hide_email'];

// Update settings
$database->query("UPDATE ".TABLE_PREFIX."mod_team_settings SET "
					." header = '$header', "
					." footer = '$footer', "
					." theader = '$theader', "
					." tloop = '$tloop', "
					." tfooter = '$tfooter', "
					." bheader = '$bheader', "
					." bloop = '$bloop', "
					." bfooter = '$bfooter', "
					." hide_email = '$hide_email', "
					." pic_loc = '$pic_loc', "
					." sort_grp_name = '$sort_grp_name', "
					." sort_nogrp_team = '$sort_nogrp_team' "
					." WHERE section_id = '$section_id'");

// Check if there is a db error, otherwise say successful
if($database->is_error()) {
	$admin->print_error($database->get_error(), ADMIN_URL.'/pages/modify.php?page_id='.$page_id);
} else {
	$admin->print_success($TEXT['SUCCESS'], ADMIN_URL.'/pages/modify.php?page_id='.$page_id);
}

// Print admin footer
$admin->print_footer();

?>