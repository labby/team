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

if(LANGUAGE_LOADED) {
	if(!file_exists(LEPTON_PATH.'/modules/team/languages/'.LANGUAGE.'.php')) {
		require_once(LEPTON_PATH.'/modules/team/languages/EN.php');
	} else {
		require_once(LEPTON_PATH.'/modules/team/languages/'.LANGUAGE.'.php');
	}
}

// Get id
if(!isset($_GET['group_id']) OR !is_numeric($_GET['group_id'])) {
	header("Location: ".ADMIN_URL."/pages/index.php");
} else {
	$group_id = $_GET['group_id'];
}

// Include WB admin wrapper script
require(LEPTON_PATH.'/modules/admin.php');

//Get module settings file
require('module_settings.default.php');
require('module_settings.php');

// Get header and footer
$query_content = $database->query("SELECT * FROM ".TABLE_PREFIX."mod_team_groups WHERE group_id = '$group_id'");
$fetch_content = $query_content->fetchRow();

?>

<form name="modify" action="<?php echo LEPTON_URL; ?>/modules/team/save_group.php" method="post" style="margin: 0;">

<input type="hidden" name="section_id" value="<?php echo $section_id; ?>">
<input type="hidden" name="page_id" value="<?php echo $page_id; ?>">
<input type="hidden" name="group_id" value="<?php echo $group_id; ?>">

<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
	<td width="90"><?php echo $TEXT['NAME']; ?>:</td>
	<td>
		<input type="text" name="group_name" value="<?php echo stripslashes($fetch_content['group_name']); ?>" style="width: 100%;" maxlength="255" />
	</td>
</tr>
<tr valign="top">
			<td width="80"><?php echo $TMTEXT['DESCRIPTION']; ?>:</td>
			<td>
			<textarea name="group_desc" style="width:99%; height: 80px;"><?php echo stripslashes(htmlspecialchars($fetch_content['group_desc'])); ?></textarea>
			<?php 
			
			echo '<p>'; if ($html_allowed != 1) {echo $TMTEXT['HTMLNOTALLOWED']; } else {echo $TMTEXT['HTMLALLOWED']; } echo '<br/></p>'; ?>
		
			</td>
		</tr>
<tr>
	<td><?php echo $TEXT['ACTIVE']; ?>:</td>
	<td>
		<input type="radio" name="active" id="active_true" value="1" <?php if($fetch_content['active'] == 1) { echo ' checked'; } ?> />
		<a href="#" onclick="javascript: document.getElementById('active_true').checked = true;">
		<?php echo $TEXT['YES']; ?>
		</a>
		-
		<input type="radio" name="active" id="active_false" value="0" <?php if($fetch_content['active'] == 0) { echo ' checked'; } ?> />
		<a href="#" onclick="javascript: document.getElementById('active_false').checked = true;">
		<?php echo $TEXT['NO']; ?>
		</a>
	</td>
</tr>
<tr>
	<td><?php echo $TMTEXT['SORT_BY']; ?>:</td>
	<td>
		<input type="radio" name="sort_by_name" id="active_false" value="0" <?php if($fetch_content['sort_by_name'] == 0) { echo ' checked'; } ?> />
		<a href="#" onclick="javascript: document.getElementById('sort_by_name_false').checked = true;">
		<?php echo $TMTEXT['SORT_BY_ORDER']; ?>
		</a>
		-
		<input type="radio" name="sort_by_name" id="active_true" value="1" <?php if($fetch_content['sort_by_name'] == 1) { echo ' checked'; } ?> />
		<a href="#" onclick="javascript: document.getElementById('sort_by_name_true').checked = true;">
		<?php echo $TMTEXT['SORT_BY_NAME']; ?>
		</a>
	</td>
</tr>
</table>

<br />

<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
	<td align="left">
		<input name="save" type="submit" value="<?php echo $TEXT['SAVE'].' '.$TEXT['GROUP']; ?>" style="width: 200px; margin-top: 5px;"></form>
	</td>
	<td align="right">
		<input type="button" value="<?php echo $TEXT['CANCEL']; ?>" onclick="javascript: window.location = '<?php echo ADMIN_URL; ?>/pages/modify.php?page_id=<?php echo $page_id; ?>';" style="width: 100px; margin-top: 5px;" />
	</td>
</tr>
</table>


<?php

// Print admin footer
$admin->print_footer();

?>