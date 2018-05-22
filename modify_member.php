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
if(!isset($_GET['team_id']) OR !is_numeric($_GET['team_id'])) {
  header("Location: ".ADMIN_URL."/pages/index.php");
} else {
  $team_id = $_GET['team_id'];
}

// Include WB admin wrapper script
require(LEPTON_PATH.'/modules/admin.php');

require('module_settings.default.php');
require('module_settings.php');

// Load Language file
if(LANGUAGE_LOADED) {
	if(!file_exists(LEPTON_PATH.'/modules/team/languages/'.LANGUAGE.'.php')) {
		require_once(LEPTON_PATH.'/modules/team/languages/EN.php');
	} else {
		require_once(LEPTON_PATH.'/modules/team/languages/'.LANGUAGE.'.php');
	}
}

$query_content = $database->query("SELECT * FROM ".TABLE_PREFIX."mod_team_members WHERE team_id = '$team_id'");
$fetch_content = $query_content->fetchRow();

?>
<form name="modify" action="<?php echo LEPTON_URL; ?>/modules/team/save_member.php" method="post" style="margin: 0;">
	<input type="hidden" name="section_id" value="<?php echo $section_id; ?>">
	<input type="hidden" name="page_id" value="<?php echo $page_id; ?>">
	<input type="hidden" name="team_id" value="<?php echo $team_id; ?>">
	
	<table cellpadding="4" cellspacing="0" border="0" width="100%">
	<tr valign="top">
	<td width="160">
	<div style="margin-bottom:10px; width:150px;"><?php echo $TEXT['GROUP']; ?>:<br/>
	  
	  			<select style="width:150px;" name="group">
				<option value="0"><?php echo $TEXT['NONE']; ?></option>
				<?php
				$query = $database->query("SELECT * FROM ".TABLE_PREFIX."mod_team_groups WHERE section_id = '$section_id' ORDER BY position ASC");
				if($query->numRows() > 0) {
					// Loop through groups
					while($group = $query->fetchRow()) {
					  ?>
					  <option value="<?php echo $group['group_id']; ?>"<?php if($fetch_content['group_id'] == $group['group_id']) { echo ' selected'; } ?>><?php echo stripslashes($group['group_name']); ?></option>
					  <?php
					}
				}
				?>
				</select>
	  	</div>
		<?php echo $TMTEXT['SORTER'].":<br/>"; ?>
		<input type="text" name="m_sort" value="<?php echo stripslashes($fetch_content['m_sort']); ?>" style="width:150;" maxlength="7" /><br/>	
		<?php 
		echo '<font size="1">'.$TMTEXT['SORTERHELP'].'</font><br/><br/>';
	
		echo $TEXT['IMAGE'].":"; 
			// this piece of code scans the given directory and creates the selector
			  $query_content = $database->query("SELECT pic_loc FROM ".TABLE_PREFIX."mod_team_settings WHERE section_id = '$section_id'");
			  if($query_content->numRows() > 0) {
			    $fetch_settings = $query_content->fetchRow();
			    $pic_loc = $fetch_settings['pic_loc'];
			  }
			  if ($pic_loc == "") { $file_dir = "";} else { $file_dir= LEPTON_PATH . $pic_loc; }
			  $picfile = $fetch_content['picture'];
			  if ($picfile == "" OR $pic_loc == "") { $previewpic =  LEPTON_URL . "/modules/team/nopic.gif"; } else { $previewpic =  LEPTON_URL . $pic_loc.'/'.$picfile; }
			  $check_pic_dir=is_dir($file_dir);
			  if ($check_pic_dir== true) {
			    $pic_dir=opendir($file_dir);
			    echo "<select style=\"width:150px;\" name=\"picture\" onChange=\"javascript:changepic()\">\n";
			    echo "<option value=\"\">None selected</option>\n";
				$all_images = array();
			    while ($file=readdir($pic_dir)) {
			      if ($file != "." && $file != "..") {
			        if (1 == preg_match("/.gif|.GIF|.jpg|.JPG|.png|.PNG|.jpeg|.JPEG/",$file)) {					
						$all_images[] = $file;
			        }
			      }
			    }
				natsort($all_images);
				foreach($all_images as $file){
					echo "<option value=\"".$file."\"";
			        if($picfile == $file) { 
						echo " Selected"; 
						} 
			        echo ">".$file."</option>\n"; 
				}
			    echo "</select>\n";
			  } else { Echo $TMTEXT['DIRECTORY'].$pic_loc.$TMTEXT['NOT_EXIST']; }
			  
			  
			  ?>
			 
			 
		<img src="<?php echo $previewpic; ?>" width="90" height="120" alt="preview" name="memberpic" id="memberpic" />
		<!-- hier JS -->
		
		
		</td>
		<td>
		
		<div style="margin-bottom:10px;"><?php echo $TEXT['NAME']; ?>:<br/><input type="text" name="m_name" value="<?php echo stripslashes($fetch_content['m_name']); ?>" style="width: 99%;" maxlength="255" /></div>
		<div style="margin-bottom:10px;"><?php echo $TMTEXT['CAPACITY']; ?>:<br/><input type="text" name="m_capacity" value="<?php echo stripslashes($fetch_content['m_capacity']); ?>" style="width: 99%;" maxlength="255" /></div>
		<div style="margin-bottom:10px;"><?php echo $TMTEXT['DESCRIPTION']; ?>:<br/><textarea name="description" style="width:99%; height: 80px;"><?php echo stripslashes(htmlspecialchars($fetch_content['description'])); ?></textarea></div>
		<div style="margin-bottom:10px;"><?php echo $TEXT['EMAIL']; ?>:<br/><input type="text" name="email" value="<?php echo stripslashes($fetch_content['email']); ?>" style="width: 70%;" /></div>
		<div style="margin-bottom:10px;"><?php echo $TMTEXT['PHONE']; ?>:<br/><input type="text" name="phone" value="<?php echo stripslashes($fetch_content['phone']); ?>" style="width: 70%;" /></div>
		
		<?php 
		if ($display_extra >= 1) { $div_stile = 'style="margin-bottom:10px;"' ;} else { $div_stile = 'style="display:none"' ;}
		echo '<div '.$div_stile.'>'.$TMTEXT['EXTRA1'].':<br/><textarea name="m_extra1" style="width:99%; height: 80px;">'.stripslashes(htmlspecialchars($fetch_content['m_extra1'])).'</textarea></div>'; 
		
		if ($display_extra >= 2) { $div_stile = 'style="margin-bottom:10px;"' ;} else { $div_stile = 'style="display:none"' ;}
		echo '<div '.$div_stile.'>'.$TMTEXT['EXTRA2'].':<br/><textarea name="m_extra2" style="width:99%; height: 80px;">'.stripslashes(htmlspecialchars($fetch_content['m_extra2'])).'</textarea></div>'; 
		
		echo '<p>'; if ($html_allowed != 1) {echo $TMTEXT['HTMLNOTALLOWED']; } else {echo $TMTEXT['HTMLALLOWED']; } echo '</p>';
		?>
		
		<div><?php echo $TEXT['ACTIVE']; ?>:<br/>
	  			<input type="radio" name="active" id="active_true" value="1" <?php if($fetch_content['active'] == 1) { echo ' checked'; } ?> />
	  			<a href="javascript: toggle_checkbox('active_true');"><?php echo $TEXT['YES']; ?></a>
	  			&nbsp;
	  			<input type="radio" name="active" id="active_false" value="0" <?php if($fetch_content['active'] == 0) { echo ' checked'; } ?> />
	  			<a href="javascript: toggle_checkbox('active_false');"><?php echo $TEXT['NO']; ?></a>
	  	</div>
		
<script type="text/javascript">
				function changepic() {
				var bildname = document.modify.picture.options[document.modify.picture.selectedIndex].value;
				document.images['memberpic'].src = "<?php echo LEPTON_URL.$pic_loc.'/"' ?> + bildname;
		} 
		</script> 
		
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td align="left">
	  		<input name="save" type="submit" value="<?php echo $TEXT['SAVE'].' '.$TMTEXT['MEMBER']; ?>" style="width: 200px; margin-top: 5px;"></form>
		</td>
		<td align="right">
			<input type="button" value="<?php echo $TEXT['CANCEL']; ?>" onclick="javascript: window.location = '<?php echo ADMIN_URL; ?>/pages/modify.php?page_id=<?php echo $page_id; ?>';" style="width: 100px; margin-top: 5px;" />
		</td>
	</tr>
</table>
</td></tr></table>
<?php

// Print admin footer
$admin->print_footer();

?>