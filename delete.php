ammember['m_extra2']);
				
				$team_pic = $teammember['picture'];
				if ($team_pic == '') { $team_pic = 'nopic.jpg'; }
				$team_pic = WB_URL . $pic_loc . '/' . $team_pic;
				
				
				
				$vars = array( '[PICTURE]', '[NAME]', '[POSITION]', '[DESCRIPTION]', '[MAIL]', '[PHONE]', '[EXTRA1]', '[EXTRA2]' );
				$values = array ($team_pic, $m_name, $m_capacity, $description, $email, $phone, $m_extra1, $m_extra2);
	
				//output the set based upon $tloop template			
				echo str_replace($vars, $values, stripslashes($fetch_settings['bloop']));
				
				//Should we print the bookmark footer?
				if ( $teammembercount == $cellcount ) { 
					echo stripslashes($fetch_settings['bfooter']);
					$teammembercount = 1; 
				} else {
					$teammembercount++;
				}
			}
			
			// ??? Should I do something with below section?
			if ( $teammembercount !== 1) { 
				echo stripslashes($fetch_settings['bfooter']);
			}
		}
	}
	
	echo stripslashes($fetch_settings['tfooter']);

}

// Now loop through any links not in groups

// Sorting nogroup links by m_name or position
if ($sort_nogrp_team == "1") {
	$sort_nogrp = "group_na