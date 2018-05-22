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
require(LEPTON_PATH.'/modules/admin.php');

// Load Language file
if(LANGUAGE_LOADED) {
    require_once(LEPTON_PATH.'/modules/team/languages/EN.php');
    if(file_exists(LEPTON_PATH.'/modules/team/languages/'.LANGUAGE.'.php')) {
        require_once(LEPTON_PATH.'/modules/team/languages/'.LANGUAGE.'.php');
    }
}

// Get header and footer
$query_content = $database->query("SELECT * FROM ".TABLE_PREFIX."mod_team_settings WHERE section_id = '$section_id'");
$fetch_content = $query_content->fetchRow();

?>


<form name="edit" action="<?php echo LEPTON_URL; ?>/modules/team/save_settings.php" method="post" style="margin: 0;">

	<input type="hidden" name="section_id" value="<?php echo $section_id; ?>">
	<input type="hidden" name="page_id" value="<?php echo $page_id; ?>">

	<table class="row_a" cellpadding="2" cellspacing="0" border="0" width="100%">
		<tr>
			<td colspan="2"><strong><?php echo $TMTEXT['MNSETTINGS']; ?></strong></td>
		</tr>
		<tr>
			<td width="30%" valign="top"><?php echo $TMTEXT['PIC_LOC']; ?>:</td>
			<td>
				<?php
				$pic_loc1 = stripslashes($fetch_content['pic_loc']);
				if ($pic_loc1 == '') { $pic_loc1 = MEDIA_DIRECTORY.'/team'; };
				?>
				<input name="pic_loc" type="text" value="<?php echo $pic_loc1; ?>" style="width: 98%;">
			</td>
		</tr>
		<tr>
			<td width="30%" valign="top"><?php echo $TMTEXT['HIDEMAIL']; ?>:</td>
			<td>
			<? $hide_email = stripslashes($fetch_content['hide_email']); ?>
			
			<select name="hide_email">
				<option value ="0" <? if ($hide_email == 0) { echo "selected"; } echo '>'.$TEXT['NO']; ?></option>
				<option value ="1" <? if ($hide_email == 1) { echo "selected"; } ?> >javascript</option>
			</select>
		</tr>
		<tr>
			<td><?php echo $TMTEXT['SORT_GRP_BY']; ?>:</td>
			<td>
				<input type="radio" name="sort_grp_name" id="active_false" value="0" <?php if($fetch_content['sort_grp_name'] == 0) { echo ' checked'; } ?> />
				<a href="#" onclick="javascript: document.getElementById('sort_grp_name_false').checked = true;">
				<?php echo $TMTEXT['SORT_BY_ORDER']; ?>
				</a>
				-
				<input type="radio" name="sort_grp_name" id="active_true" value="1" <?php if($fetch_content['sort_grp_name'] == 1) { echo ' checked'; } ?> />
				<a href="#" onclick="javascript: document.getElementById('sort_grp_name_true').checked = true;">
				<?php echo $TMTEXT['SORT_GRP_BY_NAME']; ?>
				</a>
			</td>
		</tr>
		<tr>
			<td><?php echo $TMTEXT['SORT_NOGRP_BY']; ?>:</td>
			<td>
				<input type="radio" name="sort_nogrp_team" id="active_false" value="0" <?php if($fetch_content['sort_nogrp_team'] == 0) { echo ' checked'; } ?> />
				<a href="#" onclick="javascript: document.getElementById('sort_nogrp_team_false').checked = true;">
				<?php echo $TMTEXT['SORT_BY_ORDER']; ?>
				</a>
				-
				<input type="radio" name="sort_nogrp_team" id="active_true" value="1" <?php if($fetch_content['sort_nogrp_team'] == 1) { echo ' checked'; } ?> />
				<a href="#" onclick="javascript: document.getElementById('sort_nogrp_team_true').checked = true;">
				<?php echo $TMTEXT['SORT_BY_NAME']; ?>
				</a>
			</td>
		</tr>
	</table>
	<hr />
	<table class="row_a" cellpadding="2" cellspacing="0" border="0" width="100%" style="margin-top: 3px;">
		<tr>
			<td colspan="2"><strong><?php echo $TMTEXT['LTSETTINGS']; ?></strong></td>
		</tr>
		<tr>
			<td width="30%" valign="top"><?php echo $TEXT['HEADER']; ?>:</td>
			<td>
				<textarea name="header" style="width: 98%; height: 50px;"><?php echo stripslashes(htmlspecialchars($fetch_content['header'])); ?></textarea>
		</tr>
		<tr>
			<td width="30%" valign="top"><?php echo $TEXT['FOOTER']; ?>:</td>
			<td>
				<textarea name="footer" style="width: 98%; height: 50px;"><?php echo stripslashes(htmlspecialchars($fetch_content['footer'])); ?></textarea>
		</tr>
		<tr><td colspan="2"><hr/>
		</td>
		</tr>
		<tr>
			<td width="30%" valign="top" class="newsection"><?php echo $TMTEXT['GPHEADER']; ?></td>
			<td class="newsection"><textarea name="tloop" style="width:98%; height: 200px;"><?php echo stripslashes(htmlspecialchars($fetch_content['tloop'])); ?></textarea>
</td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
		  <td><hr/>
	      </td>
	  </tr>
		<tr>
			<td width="30%" valign="top"><?php echo $TMTEXT['TMLOOP']; ?></td>
			<td><textarea name="bloop" style="width:98%; height: 200px;"><?php echo stripslashes(htmlspecialchars($fetch_content['bloop'])); ?></textarea>
</td>
		</tr>
		<tr><td width="30%">&nbsp;</td><td><hr/></td></tr>
		<tr>
			<td width="30%" valign="top" class="newsection"><?php echo $TMTEXT['GPFOOTER']; ?></td>
			<td class="newsection"><textarea name="tfooter" style="width:98%; height: 50px;"><?php echo stripslashes(htmlspecialchars($fetch_content['tfooter'])); ?></textarea>
</td>
		</tr>
		<tr>
			<td colspan="2" valign="top"><hr>
</td>
		</tr>
	</table>

	<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr>
			<td align="left">
				<input name="save" type="submit" value="<?php echo $TEXT['SAVE']; ?>" style="width: 100px; margin-top: 5px;"></form>
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