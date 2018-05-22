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

if(defined('WB_URL')) {
	
	$database->query("DROP TABLE IF EXISTS `".TABLE_PREFIX."mod_team_members`");
	$mod_team = 'CREATE TABLE `'.TABLE_PREFIX.'mod_team_members` ( '
					 . '`team_id` INT NOT NULL AUTO_INCREMENT,'
					 . '`section_id` INT NOT NULL DEFAULT \'0\','
					 . '`page_id` INT NOT NULL DEFAULT \'0\','
					 . '`group_id` INT NOT NULL DEFAULT \'0\','
					 . '`position` INT NOT NULL DEFAULT \'0\','
					 . '`active` INT NOT NULL DEFAULT \'0\','
					 . '`m_sort` VARCHAR(255) NOT NULL DEFAULT \'\','
					 . '`m_name` VARCHAR(255) NOT NULL DEFAULT \'\','
					 . '`m_capacity` VARCHAR(255) NOT NULL DEFAULT \'\','
					 . '`description` TEXT NOT NULL,'
					 . '`email` VARCHAR(255) NOT NULL DEFAULT \'\','
					 . '`phone` VARCHAR(255) NOT NULL DEFAULT \'\','
					 . '`m_extra1` TEXT NOT NULL,'
 					 . '`m_extra2` TEXT NOT NULL,'					 
					 . '`m_searchstring` TEXT NOT NULL DEFAULT \'\','
					 . '`picture` VARCHAR(255) NOT NULL DEFAULT \'\','
					 . 'PRIMARY KEY (team_id)'
                . ' )';
	$database->query($mod_team);

	$database->query("DROP TABLE IF EXISTS `".TABLE_PREFIX."mod_team_groups`");
	$mod_team = 'CREATE TABLE `'.TABLE_PREFIX.'mod_team_groups` ( '
					 . '`group_id` INT NOT NULL AUTO_INCREMENT,'
					 . '`section_id` INT NOT NULL DEFAULT \'0\','
					 . '`page_id` INT NOT NULL DEFAULT \'0\','
					 . '`position` INT NOT NULL DEFAULT \'0\','
					 . '`active` INT NOT NULL DEFAULT \'0\','
					 . '`group_name` VARCHAR(255) NOT NULL DEFAULT \'\','
					 . '`group_desc` TEXT NOT NULL DEFAULT \'\','
					 . '`sort_by_name` TINYINT(1) NOT NULL DEFAULT \'0\','
					 . 'PRIMARY KEY (group_id)'
                . ' )';
	$database->query($mod_team);
	
	$database->query("DROP TABLE IF EXISTS `".TABLE_PREFIX."mod_team_settings`");
	$mod_team = 'CREATE TABLE `'.TABLE_PREFIX.'mod_team_settings` ( '
					 . '`section_id` INT NOT NULL DEFAULT \'0\','
					 . '`page_id` INT NOT NULL DEFAULT \'0\','
					 . '`header` TEXT NOT NULL,'
					 . '`footer` TEXT NOT NULL,'
					 . '`theader` TEXT NOT NULL,'
					 . '`tloop` TEXT NOT NULL,'
					 . '`tfooter` TEXT NOT NULL,'
					 . '`bheader` TEXT NOT NULL,'
					 . '`bloop` TEXT NOT NULL,'
					 . '`bfooter` TEXT NOT NULL,'
					 . '`pic_loc` VARCHAR(255) NOT NULL DEFAULT \'\','
					 . '`sort_grp_name` TINYINT(1) NOT NULL DEFAULT \'0\','
					 . '`sort_nogrp_team` TINYINT(1) NOT NULL DEFAULT \'0\','
					 . '`hide_email` TINYINT(1) NOT NULL DEFAULT \'0\','
					 . 'PRIMARY KEY (section_id)'
                . ' )';
	$database->query($mod_team);
	
	// Insert info into the search table
	// Module query info
	
	$field_info = array();
	$field_info['page_id'] = 'page_id';
	$field_info['title'] = 'page_title';
	$field_info['link'] = 'link';
	$field_info['description'] = 'description';
	$field_info['modified_when'] = 'modified_when';
	$field_info['modified_by'] = 'modified_by';
	$field_info = serialize($field_info);
	$database->query("INSERT INTO ".TABLE_PREFIX."search (name,value,extra) VALUES ('module', 'team', '$field_info')");
	// Query start
	
	$query_start_code = "SELECT [TP]pages.page_id, [TP]pages.page_title,	[TP]pages.link, [TP]pages.description, [TP]pages.modified_when, [TP]pages.modified_by FROM [TP]mod_team_members, [TP]mod_team_groups, [TP]mod_team_settings, [TP]pages WHERE ";
	$database->query("INSERT INTO ".TABLE_PREFIX."search (name,value,extra) VALUES ('query_start', '$query_start_code', 'team')");

	// Query body
	$query_body_code = "
	[TP]pages.page_id = [TP]mod_team_members.page_id AND [TP]mod_team_members.m_searchstring [O] \'[W][STRING][W]\' AND [TP]pages.searching = \'1\' OR
	[TP]pages.page_id = [TP]mod_team_groups.page_id AND [TP]mod_team_groups.group_name [O] \'[W][STRING][W]\' AND [TP]pages.searching = \'1\' OR
	[TP]pages.page_id = [TP]mod_team_groups.page_id AND [TP]mod_team_groups.group_desc  [O] \'[W][STRING][W]\' AND [TP]pages.searching = \'1\'
	";	
	$database->query("INSERT INTO ".TABLE_PREFIX."search (name,value,extra) VALUES ('query_body', '$query_body_code', 'team')");

	// Query end
	$query_end_code = "";	

	$database->query("INSERT INTO ".TABLE_PREFIX."search (name,value,extra) VALUES ('query_end', '$query_end_code', 'team')");
	
	// Insert blank rows (there needs to be at least on row for the search to work)
	$database->query("INSERT INTO ".TABLE_PREFIX."mod_team_members (section_id,page_id) VALUES ('0', '0')");
	$database->query("INSERT INTO ".TABLE_PREFIX."mod_team_groups (section_id,page_id) VALUES ('0', '0')");
	$database->query("INSERT INTO ".TABLE_PREFIX."mod_team_settings (section_id,page_id) VALUES ('0', '0'");
	
	//______________________________________________


	//Add folder for images to media dir
	require_once(WB_PATH.'/framework/functions.php');
	make_dir(WB_PATH.MEDIA_DIRECTORY.'/team-members');
	
}

?>