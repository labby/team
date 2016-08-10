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

// Get id
if(!isset($_POST['team_id']) OR !is_numeric($_POST['team_id'])) {
	header("Location: ".ADMIN_URL."/pages/index.php");
} else {
	$team_id = $_POST['team_id'];
}

global $wb;
// Include WB admin wrapper script
$update_when_modified = true; // Tells script to update when this page was last updated
require(WB_PATH.'/modules/admin.php');

// Validate  fields
if($admin->get_post('m_name') == '') {
	$admin->print_error($MESSAGE['GENERIC']['FILL_IN_ALL'], WB_URL.'/modules/modify_member.php?page_id='.$page_id.'&section_id='.$section_id.'&team_id='.$team_id);
} else {

	$html_allowed = 0;
	require('module_settings.default.php');
	require('module_settings.php');
	
	$m_sort = addslashes(strip_tags($admin->get_post('m_sort')));
	$picture = addslashes(strip_tags($admin->get_post('picture')));
	$group = addslashes(strip_tags($admin->get_post('group')));
	$active = addslashes(strip_tags($admin->get_post('active')));
	$email = addslashes(strip_tags($admin->get_post('email')));
	
	$m_name = $admin->get_post('m_name');
	$m_capacity = $admin->get_post('m_capacity');
	$description = $admin->get_post('description');	
	$phone = $admin->get_post('phone');
	$m_extra1 = $admin->get_post('m_extra1');
	$m_extra2 = $admin->get_post('m_extra2');
	
	$m_searchstring = $m_name.' '.$m_capacity.' '.$description.' '.$m_extra1.' '.$m_extra2;
	$m_searchstring = addslashes(strip_tags($m_searchstring));
	
	
	if ($html_allowed != 1) {
		$m_name = my_htmlspecialchars($m_name);
		$m_capacity = my_htmlspecialchars($m_capacity);
		$description = my_htmlspecialchars($description);	
		$phone = my_htmlspecialchars($phone);
		$m_extra1 = my_htmlspecialchars($m_extra1);
		$m_extra2 = my_htmlspecialchars($m_extra2);	
	}
	
	
	
	$m_name = addslashes($m_name);
	$m_capacity = addslashes($m_capacity);
	$description = addslashes($description);	
	$phone = addslashes($phone);
	$m_extra1 = addslashes($m_extra1);
	$m_extra2 = addslashes($m_extra2);
	
	
}

// Update row
$database->query("UPDATE ".TABLE_PREFIX."mod_team_members SET "
					. " group_id = '$group', "
					. " m_sort = '$m_sort', "
					. " m_name = '$m_name', "
					. " m_capacity = '$m_capacity', "
					. " description = '$description', "
					. " email = '$email', "
					. " phone = '$phone', "
					. " m_extra1 = '$m_extra1', "
					. " m_extra2 = '$m_extra2', "
					. " active = '$active', "
					. " picture = '$picture', "
					. " m_searchstring = '$m_searchstring' "
					. " WHERE team_id = '$team_id'");

// Check if there is a db error, otherwise say successful
if($database->is_error()) {
	$admin->print_error($database->get_error(), WB_URL.'/modules/team/modify_member.php?page_id='.$page_id.'&section_id='.$section_id.'&team_id='.$team_id);
} else {
	$admin->print_success($TEXT['SUCCESS'], ADMIN_URL.'/pages/modify.php?page_id='.$page_id);
}

// Print admin footer
$admin->print_footer();

?>