<?php

	$html_allowed = 1;  //1: All fields may contain HTML. 0: No HTML (htmlspecialchars();)	
	$display_extra = 2; //Use/Display 2 extra fields:  0: no, 1: [EXTRA1] only, 2: [EXTRA1] and [EXTRA2]	
	$hide_email_default = 1; //Default 1: Mask e-Mail Adresses with javascript
	$pic_loc_default = MEDIA_DIRECTORY.'/team-members'; //Default picture directory
	

	$use_frontend_css = 0; //0: no, 1: link, 2: embed
	//ACHTUNG: $use_frontend_css ist überflüssig/wird ignoriert, wenn register_frontend_modfiles aktiviert ist.
	//NOTE: $use_frontend_css will be ignored, when register_frontend_modfiles is active.
	
	$member_listtag = 'li'; // You should not change this

//------------------------------------------------------------	
	
	//Default for the options:
	
$header = '<!-- Module Header -->
';
$footer = '<!-- Module Footer -->
';

$theader = '';
$tloop = '<div class="team-head">
<h2>[GROUPNAME]</h2>
<p>[GROUPDESC]</p>
</div>
';
$tfooter = '<!-- Group Footer -->';

$bheader = '';
$bloop = '<table width="90%" class="team-member">
<tr valign="top"><td width="100">
<img src="[PICTURE]" width="90" height="120" alt="" /></td><td align="left">
<h3 class="team-name">[NAME]</h3>
<h4 class="team-capa">[CAPACITY]</h4>
<div class="team-desc">[DESCRIPTION]</div>
<ul>[MAIL][PHONE][EXTRA1][EXTRA2]</ul>
</td></tr></table>
';
$bfooter = '';

?>
