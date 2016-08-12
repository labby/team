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
if(defined('WB_PATH') == false) { exit("Cannot access this file directly"); }



// Load Language file
if(LANGUAGE_LOADED) {
    require_once(WB_PATH.'/modules/team/languages/EN.php');
    if(file_exists(WB_PATH.'/modules/team/languages/'.LANGUAGE.'.php')) {
        require_once(WB_PATH.'/modules/team/languages/'.LANGUAGE.'.php');
    }
}

// Load settings file
include ('module_settings.default.php');
include ('module_settings.php');

// check if frontend.css file needs to be included into the <body></body> of view.php
if (defined('MOD_FRONTEND_CSS_REGISTERED') AND (MOD_FRONTEND_CSS_REGISTERED == true)) {
	//OK - do nothing, do not include, if exist or not
} else {	
	//first, we can only include, if it exist:
	if (file_exists(WB_PATH .'/modules/team/frontend.css')) {
		if ($use_frontend_css > 0) { //embed or link?
			if ($use_frontend_css > 1) {  //embed				
				echo "\n<style type=\"text/css\">\n<!--\n"; include (WB_PATH .'/modules/team/frontend.css'); echo "-->\n</style>\n";
			} else {  //link
				echo "\n".'<link rel="stylesheet" type="text/css" href="'.WB_URL.'/modules/team/frontend.css" />'."\n"; 
			}	
		}
	
	}
}


// Get header and footer
$query_content = $database->query("SELECT * FROM ".TABLE_PREFIX."mod_team_settings WHERE section_id = '$section_id'");
if($query_content->numRows() > 0) {
	$fetch_settings = $query_content->fetchRow();	
	$hide_email = stripslashes($fetch_settings['hide_email']);
	$pic_loc = $fetch_settings['pic_loc'];
	$sort_grp_name = $fetch_settings['sort_grp_name'];
	$sort_nogrp_team = $fetch_settings['sort_nogrp_team'];
} else {	
	$hide_email = 1;
	$pic_loc = '';
}

//Compatibility to older versions: Is the function showteammail allready defined in the header?
if (strpos($fetch_settings['header'], 'showteammail') === false) {
	//No, check if frontend.js is loaded:
	if (defined('MOD_FRONTEND_JAVASCRIPT_REGISTERED') AND (MOD_FRONTEND_JAVASCRIPT_REGISTERED == true)) {
		//OK - do nothing, do not include, if exist or not
	} else {
	//Not in header and not loaded:
		echo '
	<script type=\"text/javascript\">
	<!--
	function showteammail(n,d) {
	var mail = n+\'@\'+d;
	document.write(\'<a href=\"mailto:\'+ mail + \'\">\'+ mail + \'</\'+\'a>\');
	} // -->
	</script>
	';
	}
}

// Sorting groups by group_name or position
if ($sort_grp_name == "1") {
	$sort_grp = "group_name";
} else {
	$sort_grp = "position";
}

// Print header
echo stripslashes($fetch_settings['header']);

$output = ''; //use as flag
$teamcount = 0;

// Loop through groups
$theq = "SELECT * FROM ".TABLE_PREFIX."mod_team_groups WHERE section_id = '$section_id' AND active = '1' ORDER BY $sort_grp ASC";
$query_groups = $database->query($theq);

if($query_groups->numRows() > 0) {

	//Group Header
	echo stripslashes($fetch_settings['theader']);
	
	while($group = $query_groups->fetchRow()) {
		$group_id = $group['group_id'];

		
		$vars = array( '[GROUPNAME]', '[GROUPDESC]', '[GROUPQUERY]' );
		$values = array (stripslashes($group['group_name']), nl2br(stripslashes($group['group_desc'])), $theq);
		echo str_replace($vars, $values, stripslashes($fetch_settings['tloop']));
		
		// Sort member by m_sort,m_name or position
		$sort_by_name = $group['sort_by_name'];
		if ($sort_by_name == "1") { $sort_by = "m_sort,m_name"; } else { 	$sort_by = "position"; }
		

		// Query the members in this group
		$query_team = $database->query("SELECT * FROM ".TABLE_PREFIX."mod_team_members WHERE section_id = '$section_id' AND group_id = '".$group_id."' AND active = '1' ORDER BY ".$sort_by." ASC");
		if($query_team->numRows() > 0) {			
			
			// Loop through all links in this group		
			while($teammember = $query_team->fetchRow()) {
				
				
				$team_id = $teammember['team_id'];
				$m_name = stripslashes($teammember['m_name']);
				$m_capacity = stripslashes($teammember['m_capacity']);				
				$description = nl2br(stripslashes($teammember['description']));
				
				
				$m_link = stripslashes($teammember['email']);
				$email = "";
				if ($m_link != '') { 
					require_once(WB_PATH.'/modules/team/functions.inc.php');
					$email = convert_team_link ($m_link, $hide_email);					
					$email = "<$member_listtag class=\"team-mail\">$email</$member_listtag>\n";
				}
				
				$phone = $teammember['phone'];
				if ($phone != '') { $phone = "<$member_listtag class=\"team-phone\">".stripslashes($phone)."</$member_listtag>\n"; }
				$m_extra1 = $teammember['m_extra1'];
				if ($m_extra1 != '') { $m_extra1 = "<$member_listtag class=\"team-extra1\">".nl2br(stripslashes($m_extra1))."</$member_listtag>\n"; }
				$m_extra2 = $teammember['m_extra2'];
				if ($m_extra2 != '') { $m_extra2 = "<$member_listtag class=\"team-extra2\">".nl2br(stripslashes($m_extra2))."</$member_listtag>\n"; }
				
				
				$team_pic = $teammember['picture'];
				if ($team_pic == '') { 
					$team_pic = WB_URL. '/modules/team/nopic.gif'; 
				} else {
					$team_pic = WB_URL . $pic_loc . '/' . $team_pic;
				}
				
				
				
				$vars = array( '[PICTURE]', '[NAME]', '[CAPACITY]', '[DESCRIPTION]', '[MAIL]', '[PHONE]', '[EXTRA1]', '[EXTRA2]', '[TEAM_ID]', '[COUNT]', '[ROW]', '[ROW2]' );
				$values = array ($team_pic, $m_name, $m_capacity, $description, $email, $phone, $m_extra1, $m_extra2, $team_id, $teamcount, ($teamcount % 2), ($teamcount % 3) );
	
				$output = str_replace($vars, $values, stripslashes($fetch_settings['bloop']));
				$output = str_replace('<ul></ul>', '', $output); //Fixing validation error: empty '<ul></ul>'
				//output the set based upon $tloop template					
				echo $output;
				$teamcount++;
				
			}
		}
		//Group Footer
		echo stripslashes($fetch_settings['tfooter']);
		
	}
	
}

// Now loop through any members not in groups

// Sorting nogroup links by m_name or position
if ($sort_nogrp_team == "1") {
	$sort_nogrp = "m_sort";
} else {
	$sort_nogrp = "position";
}

$query_team = $database->query("SELECT * FROM ".TABLE_PREFIX."mod_team_members WHERE section_id = '$section_id' AND group_id = '0' AND active = '1' ORDER BY $sort_nogrp ASC");

if($query_team->numRows() > 0) {
	
	//Group-Header
	echo stripslashes($fetch_settings['theader']);	
	if ($output != '') {
		$gname = $TMTEXT['NOGROUP'];
		} else  {
			$gname = '';
		}
	$vars = array( '[GROUPNAME]', '[GROUPDESC]');
	$values = array ($gname, '');
	//output the set based upon $tloop template			
	echo str_replace($vars, $values, stripslashes($fetch_settings['tloop']));
	
	
	while($teammember = $query_team->fetchRow()) {		
				
				
				$team_id = $teammember['team_id'];
		
				$m_name = stripslashes($teammember['m_name']);
				$m_capacity = stripslashes($teammember['m_capacity']);				
				$description = nl2br(stripslashes($teammember['description']));
				
				
				//from 'members':
				//m_link: could be: Mail, Link or Text
				$m_link = stripslashes($teammember['email']);
				$email = "";
				if ($m_link != '') { 
					require_once(WB_PATH.'/modules/team/functions.inc.php');
					$email = convert_team_link ($m_link, $hide_email);					
					$email = "<$member_listtag class=\"team-mail\">$email</$member_listtag>\n";
				}
				
				
				
				$phone = $teammember['phone'];
				if ($phone != '') { $phone = "<$member_listtag class=\"team-phone\">".stripslashes($phone)."</$member_listtag>\n"; }
				$m_extra1 = $teammember['m_extra1'];
				if ($m_extra1 != '') { $m_extra1 = "<$member_listtag class=\"team-extra1\">".nl2br(stripslashes($m_extra1))."</$member_listtag>\n"; }
				$m_extra2 = $teammember['m_extra2'];
				if ($m_extra2 != '') { $m_extra2 = "<$member_listtag class=\"team-extra2\">".nl2br(stripslashes($m_extra2))."</$member_listtag>\n"; }
				
				
				$team_pic = $teammember['picture'];
				if ($team_pic == '') { 
					$team_pic = WB_URL. '/modules/team/nopic.gif'; 
				} else {
					$team_pic = WB_URL . $pic_loc . '/' . $team_pic;
				}
				
				
				
				$vars = array( '[PICTURE]', '[NAME]', '[CAPACITY]', '[DESCRIPTION]', '[MAIL]', '[PHONE]', '[EXTRA1]', '[EXTRA2]', '[TEAM_ID]', '[COUNT]', '[ROW]', '[ROW2]' );
				$values = array ($team_pic, $m_name, $m_capacity, $description, $email, $phone, $m_extra1, $m_extra2, $team_id, $teamcount, ($teamcount % 2), ($teamcount % 3) );
				
				$output = str_replace($vars, $values, stripslashes($fetch_settings['bloop']));
				$output = str_replace('<ul></ul>', '', $output); //Fixing validation error: empty '<ul></ul>'
									
				echo $output;
				$teamcount++;
				
	
	}
	//Group Footer
	echo stripslashes($fetch_settings['tfooter']);
}
?>
<?php

// Print footer
echo stripslashes($fetch_settings['footer']);

?>