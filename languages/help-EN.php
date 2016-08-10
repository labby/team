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

// Help file in German
?>
<h2>Help for the Team Module</h2>
<p>[Sorry for my poor english... maybe someone makes a better translation?]</p>
<p>Fields: photo, name, capacity, description, email, phone. <br>
  Additional:
  extra1 und extra2: These fields are for free use. The icons are defined in
    frontend.css.<br/>
  The email-adresses are hidden from spambots by javascript.<br>
  If eMail starts with &quot;http&quot;, it is shown as link</p>
<p>The photo has a fixed size (default: 90 x 120px) and must be uploaded to
  media directory /team-members/ . The size can be changed in field options
  -&gt; <code><?php echo $TMTEXT['BMLOOP']; ?></code> If you dont want to have
  a picture, remove the img-tag from this field. Otherwise (if no photo) the
  picture /modules/team/nopic.gif
  will be used.</p>
<p>The field <?php echo $TMTEXT['SORTER']; ?>:<br>
Using the name for sorting, there would be a problem with names like &quot;Dr.
Zuse&quot;
  - the name ist sorted by &quot;D&quot;. Use &quot;zu&quot; in this field to
  sort this name right by &quot;Z&quot;<br>
With <code><?php echo $TMTEXT['SORT_BY_ORDER']; ?></code> the team members are
sorted by position (use the arrow buttons)</p>
<h3>Important for admins:</h3>
<p>There is a file <strong>module_settings.php</strong> , where some special
  options
can be defined.</p>
<p><strong>Placeholders:</strong></p>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>Header:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="17%">[GROUPNAME]</td>
    <td width="83%">Name of the group</td>
  </tr>
  <tr>
    <td>[GROUPDESC]</td>
    <td>Description</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Team-Eintrag:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>[PICTURE]</td>
    <td>Compte path to the picture</td>
  </tr>
  <tr>
    <td>[NAME]</td>
    <td>Name</td>
  </tr>
  <tr>
    <td>[CAPACITY]</td>
    <td>What he/she does</td>
  </tr>
  <tr>
    <td>[DESCRIPTION]</td>
    <td>Description</td>
  </tr>
  <tr>
    <td>[MAIL]</td>
    <td>Mail (contains &quot;@&quot;) OR URL (starts &quot;http://&quot;).
      Additional text will be used as linktext.</td>
  </tr>
  <tr>
    <td>[PHONE]</td>
    <td>Phone</td>
  </tr>
  <tr>
    <td>[EXTRA1]<br>
      [EXTRA2] <br>
    </td>
    <td>The 2 fields can be deactivatet in module_settings.php</td>
  </tr>
  <tr>
    <td>[TEAM_ID]</td>
    <td>Unique number</td>
  </tr>
  <tr>
    <td>[COUNT]</td>
    <td>0 ..N Is counted about the whole page (view.php)</td>
  </tr>
  <tr>
    <td>[ROW]</td>
    <td>0 or 1: Use it, to alternate classes</td>
  </tr>
  <tr>
    <td>[ROW2]</td>
    <td>Like [ROW], but: 0,1,2,0,1,2</td>
  </tr>
</table>
<p>&nbsp;</p>
<p><strong>Options:</strong></p>
<p><code><?php echo $TMTEXT['PIC_LOC']; ?></code> - Location, where the pictures
  are.</p>
<p><code><?php echo $TEXT['HEADER']; ?></code> Since V 1.4 empty, only
  frontend.js is used</p>
<p><code><?php echo $TMTEXT['GPHEADER']; ?></code> - Per group<br>
Default:<br>
&lt;div class=&quot;team-head&quot;&gt;<br>
&lt;
h2&gt;[GROUPNAME]&lt;/h2&gt;<br>
&lt;
p&gt;[GROUPDESC]&lt;/p&gt;<br>
&lt;
/div&gt;</p>
<p><code><?php echo $TMTEXT['TMLOOP']; ?></code> - this is per member:<br>
Default:<br>
&lt;table width=&quot;90%&quot; class=&quot;team-member&quot;&gt;<br>
&lt;
tr valign=&quot;top&quot;&gt;&lt;td width=&quot;100&quot;&gt;<br>
&lt;
img src=&quot;[PICTURE]&quot; width=&quot;90&quot; height=&quot;120&quot; alt=&quot;&quot; /&gt;&lt;/td&gt;&lt;td
align=&quot;left&quot;&gt;<br>
&lt;
h3 class=&quot;team-name&quot;&gt;[NAME]&lt;/h3&gt;<br>
&lt;
h4 class=&quot;team-capa&quot;&gt;[CAPACITY]&lt;/h4&gt;<br>
&lt;
div class=&quot;team-desc&quot;&gt;[DESCRIPTION]&lt;/div&gt;<br>
&lt;
ul&gt;[MAIL][PHONE][EXTRA1][EXTRA2]&lt;/ul&gt;<br>
&lt;
/td&gt;&lt;/tr&gt;&lt;/table&gt;</p>
<p><strong>Important: </strong>[MAIL] ... is generated as &lt;li class=&quot;...&quot;&gt;. </p>
