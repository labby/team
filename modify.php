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
if(!defined('LEPTON_PATH')) { exit("Cannot access this file directly"); }

// include functions to edit the optional module CSS files (frontend.css, backend.css)
require_once('css.functions.php');


// Load Language file
if(LANGUAGE_LOADED) {
	if(!file_exists(LEPTON_PATH.'/modules/team/languages/'.LANGUAGE.'.php')) {
		require_once(LEPTON_PATH.'/modules/team/languages/EN.php');
	} else {
		require_once(LEPTON_PATH.'/modules/team/languages/'.LANGUAGE.'.php');
	}
}

//Delete all members and groups with no name
$database->query("DELETE FROM ".TABLE_PREFIX."mod_team_members  WHERE page_id = '$page_id' and section_id = '$section_id' and m_name=''");
$database->query("DELETE FROM ".TABLE_PREFIX."mod_team_groups  WHERE page_id = '$page_id' and section_id = '$section_id' and group_name=''");

// Get information on what groups and ungrouped links are sorted by
$query_sort_grp_name = $database->query("SELECT * FROM ".TABLE_PREFIX."mod_team_settings WHERE section_id = '$section_id'");
$sorting = $query_sort_grp_name->fetchRow();
// $query_sort_nogrp_team = $database->query("SELECT sort_nogrp_team FROM ".TABLE_PREFIX."mod_team_settings WHERE section_id = '$section_id'");


$picurl = LEPTON_URL.'/modules/team/img/';
?>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
	<td align="left" width="25%">
		<input type="button" value="<?php echo $TEXT['ADD'].' '.$TMTEXT['MEMBER']; ?>" onclick="javascript: window.location = '<?php echo LEPTON_URL; ?>/modules/team/add_member.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>';" style="width: 100%;" />
	</td>
	<td align="center" width="25%">
		<input type="button" value="<?php echo $TEXT['ADD'].' '.$TEXT['GROUP']; ?>" onclick="javascript: window.location = '<?php echo LEPTON_URL; ?>/modules/team/add_group.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>';" style="width: 100%;" />
	</td>
	<td align="right" width="25%">
		<input type="button" value="<?php echo $TEXT['SETTINGS']; ?>" onclick="javascript: window.location = '<?php echo LEPTON_URL; ?>/modules/team/modify_settings.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>';" style="width: 100%;" />
	</td>
	<td align="right" width="25%">
		<input type="button" value="<?php echo $MENU['HELP']; ?>" onclick="javascript: window.location = '<?php echo LEPTON_URL; ?>/modules/team/help.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>';" style="width: 100%;" />
	</td>
</tr>
</table>

<br />

<h2><?php echo $TEXT['MODIFY'].'/'.$TEXT['DELETE'].' '.$TMTEXT['MEMBER']; ?></h2>

<?php

// Loop through existing links
$query_team = $database->query("SELECT * FROM `".TABLE_PREFIX."mod_team_members` WHERE section_id = '$section_id' ORDER BY position ASC");
$countmax=$query_team->numRows();
if ($countmax > 0) {
	$count=0;
	$row = 'a';
	?>
	<table cellpadding="2" cellspacing="0" border="0" width="100%">
	<?php
	while($teammember = $query_team->fetchRow()) {
	$count++;
		?>
		<tr class="row_<?php echo $row; ?>" height="20">
			<td width="20">
				<a href="<?php echo LEPTON_URL; ?>/modules/team/modify_member.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>&team_id=<?php echo $teammember['team_id']; ?>">
					<img src="<?php echo THEME_URL; ?>/images/modify_16.png" border="0" alt="Modify" />
				</a>
			</td>
			<td>
				<a href="<?php echo LEPTON_URL; ?>/modules/team/modify_member.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>&team_id=<?php echo $teammember['team_id']; ?>">
					<?php echo stripslashes($teammember['m_name']); ?>
				</a>
			</td>
			<td width="270">
				<?php echo $TEXT['GROUP'].': ';
				// Get group m_name
				$query_g_name = $database->query("SELECT group_name FROM ".TABLE_PREFIX."mod_team_groups WHERE group_id = '".$teammember['group_id']."'");
				if($query_g_name->numRows() > 0) {
					$fetch_g_name = $query_g_name->fetchRow();
					echo stripslashes($fetch_g_name['group_name']);
				} else {
					echo $TEXT['NONE'];
				}
				?>
			</td>			
			<td width="30"><img src="<?php echo $picurl.'active'. $teammember['active']; ?>.gif" alt="" /></td>
			<td width="20"><?php if ($count > 1) { ?>
				<a href="<?php echo LEPTON_URL; ?>/modules/team/move_up.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>&team_id=<?php echo $teammember['team_id']; ?>" m_name="<?php echo $TEXT['MOVE_UP']; ?>">
					<img src="<?php echo THEME_URL; ?>/images/up_16.png" border="0" alt="^" />
				</a><?php  } else {echo '&nbsp;';}  ?>
			</td>
			<td width="20"><?php if ($count < $countmax) { ?>
				<a href="<?php echo LEPTON_URL; ?>/modules/team/move_down.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>&team_id=<?php echo $teammember['team_id']; ?>" m_name="<?php echo $TEXT['MOVE_DOWN']; ?>">
					<img src="<?php echo THEME_URL; ?>/images/down_16.png" border="0" alt="v" />
				</a><?php  } else {echo '&nbsp;';}  ?>
			</td>
			<td width="20">
				<a href="#" onclick="javascript: confirm_link('<?php echo $TEXT['ARE_YOU_SURE']; ?>', '<?php echo LEPTON_URL; ?>/modules/team/delete_member.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>&team_id=<?php echo $teammember['team_id']; ?>');" m_name="<?php echo $TEXT['DELETE']; ?>">
					<img src="<?php echo THEME_URL; ?>/images/delete_16.png" border="0" alt="<?php echo $TEXT['DELETE']; ?>" />
				</a>
			</td>
		</tr>
		<?php
		// Alternate row color
		if($row == 'a') {
			$row = 'b';
		} else {
			$row = 'a';
		}
	}
	?>
	</table>
	<?php
} else {
	echo $TEXT['NONE_FOUND'];
}

?>


<br />

<h2><?php echo $TEXT['MODIFY'].'/'.$TEXT['DELETE'].' '.$TEXT['GROUP']; ?></h2>


<?php
//echo mysql_error();
// Loop through existing groups
$query_groups = $database->query("SELECT * FROM `".TABLE_PREFIX."mod_team_groups` WHERE section_id = '$section_id' ORDER BY position ASC");
$countmax=$query_groups->numRows();
if ($countmax > 0) {
	$count=0;
	$row = 'a';
	?>
	<table cellpadding="2" cellspacing="0" border="0" width="100%">
	<?php
	while($group = $query_groups->fetchRow()) {
		$count++;
		?>
		<tr class="row_<?php echo $row; ?>" height="20">
			<td width="20">
				<a href="<?php echo LEPTON_URL; ?>/modules/team/modify_group.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>&group_id=<?php echo $group['group_id']; ?>">
          <img src="<?php echo THEME_URL; ?>/images/modify_16.png" border="0" alt="Modify - " />
				</a>
			</td>
			<td>
				<a href="<?php echo LEPTON_URL; ?>/modules/team/modify_group.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>&group_id=<?php echo $group['group_id']; ?>">
					<?php echo stripslashes($group['group_name']) ; ?>
				</a>
			</td>
			<td width="270">
				<?php echo $TMTEXT['SORT_BY'].': '; if($group['sort_by_name'] == 0) { echo $TMTEXT['SORT_BY_ORDER']; } else { echo $TMTEXT['SORT_BY_NAME']; } ?>
			</td>
			<!--td width="80">
				<?php echo $TEXT['ACTIVE'].': '; if($group['active'] == 1) { echo $TEXT['YES']; } else { echo $TEXT['NO']; } ?>
			</td-->
			<td width="30"><img src="<?php echo $picurl.'active'. $group['active']; ?>.gif" alt="" /></td>
			<td width="20"><?php if ($count > 1) { ?>
				<a href="<?php echo LEPTON_URL; ?>/modules/team/move_up.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>&group_id=<?php echo $group['group_id']; ?>" m_name="<?php echo $TEXT['MOVE_UP']; ?>">
					<img src="<?php echo THEME_URL; ?>/images/up_16.png" border="0" alt="^" />
				</a><?php  } else {echo '&nbsp;';}  ?>
			</td>
			<td width="20"><?php if ($count < $countmax) { ?>
				<a href="<?php echo LEPTON_URL; ?>/modules/team/move_down.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>&group_id=<?php echo $group['group_id']; ?>" m_name="<?php echo $TEXT['MOVE_DOWN']; ?>">
					<img src="<?php echo THEME_URL; ?>/images/down_16.png" border="0" alt="v" />
				</a><?php  } else {echo '&nbsp;';}  ?>
			</td>
			<td width="20">
				<a href="#" onclick="javascript: confirm_link('<?php echo $TEXT['ARE_YOU_SURE']; ?>', '<?php echo LEPTON_URL; ?>/modules/team/delete_group.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>&group_id=<?php echo $group['group_id']; ?>');" m_name="<?php echo $TEXT['DELETE']; ?>">
					<img src="<?php echo THEME_URL; ?>/images/delete_16.png" border="0" alt="X" />
				</a>
			</td>
		</tr>
		<?php
		// Alternate row color
		if($row == 'a') {
			$row = 'b';
		} else {
			$row = 'a';
		}
	}
	?>
	</table>
	<?php
} else {
	echo $TEXT['NONE_FOUND'];
}
echo '<h4>'; css_edit(); echo '</h4><hr/>';
?>