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
<h2>Hilfe f&uuml;r das Team Module</h2>
<p>Das Modul erleichtert die Erstellung von Mitglieder/Mitarbeiter-Beschreibungen;
  mit den Feldern: Foto, Name, Funktion, Beschreibung, eMail, Telefon. <br>
  Zus&auml;tzlich:
  Extra1 und Extra2: Diese Felder k&ouml;nnen frei verwendet werden. Die dazu
  passenden Icons werden in der frontend.css definiert.<br/>
  Die eMail-Adressen k&ouml;nnen mit Javascript vor Spambots versteckt werden.<br>
  Wenn eMail mit &quot;http&quot; beginnt, wird der Inhalt als Link interpretiert.</p>
<p>Das Foto hat eine fixe Gr&ouml;&szlig;e (Voreinstellung: 90 x 120px) und sollte
  in das Medienverzeichnis/team-members/ hochgeladen werden. Die Gr&ouml;&szlig;e
  kann im Feld Options -&gt; <code><?php echo $TMTEXT['BMLOOP']; ?></code> eingestellt
  werden.Wenn kein Foto erw&uuml;nscht ist, muss der img-Tag in diesem Feld entfernt
  werden. Ansonsten wird - wenn kein Foto angegeben ist, das Bild /modules/team/nopic.gif
  verwendet, das beliebig angepasst werden kann.</p>
<p>Das Feld <?php echo $TMTEXT['SORTER']; ?>:<br>
  Die Sortierung nach Name w&uuml;rde zb Dr. Zuse <em>vor</em> Gernot Amon reihen.
  Weil das ung&uuml;nstig ist, werden bei der Einstellung <?php echo $TMTEXT['SORT_BY_NAME']; ?> die
  Mitglieder nach dem Datenfeld <?php echo $TMTEXT['SORTER']; ?> sortiert. Einige
  Buchstaben reichen aus, Gro&szlig;/klein Schreibung ist egal.<br>
In der Einstellung <code><?php echo $TMTEXT['SORT_BY_ORDER']; ?></code> werden
Mitglieder/Mitarbeiter in der Reihenfolge gezeigt, die mit den Pfeilschaltern
eingestellt wurde.</p>
<h3>Wichtig f&uuml;r Administratoren:</h3>
<p>Einige Einstellungen wurden in die Datei <strong>module_settings.php</strong> als php-Code
  ausgelagert. <br>
Die Variablen und Einstellungen sind dort beschreiben.</p>
<p>Weiters befindet sich die Datei frontend.css im Modul-Verzeichnis, sowie einige
  Bilder, die im CSS verwendet werden.</p>
<p><strong>Verf&uuml;gbare Platzhalter:</strong></p>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>Header:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="17%">[GROUPNAME]</td>
    <td width="83%">Name der Gruppe</td>
  </tr>
  <tr>
    <td>[GROUPDESC]</td>
    <td>Beschreibung dazu</td>
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
    <td>Vollst&auml;ndiger Pfad zum Bild</td>
  </tr>
  <tr>
    <td>[NAME]</td>
    <td>Name</td>
  </tr>
  <tr>
    <td>[CAPACITY]</td>
    <td>Funktion</td>
  </tr>
  <tr>
    <td>[DESCRIPTION]</td>
    <td>Beschreibung</td>
  </tr>
  <tr>
    <td>[MAIL]</td>
    <td>Mail (enth&auml;lt &quot;@&quot;) oder URL (beginnt mit &quot;http://&quot;). Weiterem
      Text wird zum Linktext.</td>
  </tr>
  <tr>
    <td>[PHONE]</td>
    <td>Telefon</td>
  </tr>
  <tr>
    <td>[EXTRA1]<br>
    [EXTRA2]      <br></td>
    <td>Diese beiden Felder k&ouml;nnen in der Datei /modules/team/module_settings.php
      aktiviert werden.</td>
  </tr>
  <tr>
    <td>[TEAM_ID]</td>
    <td>Eindeutige Nummer des Datensatzes</td>
  </tr>
  <tr>
    <td>[COUNT]</td>
    <td>0 bis.. Wird &uuml;ber die ganze Seite (view.php) durchgez&auml;hlt</td>
  </tr>
  <tr>
    <td>[ROW]</td>
    <td>0 oder 1: Verwendbar, um damit abwechselnde CSS-Klassen zu definieren</td>
  </tr>
  <tr>
    <td>[ROW2]</td>
    <td>Wie [ROW], aber: 0,1,2,0,1,2 - F&uuml;r 3er Gruppen.</td>
  </tr>
</table>
<p>&nbsp;</p>
<p><strong>Wichtige Angaben in den Optionen:</strong></p>
<p><code><?php echo $TMTEXT['PIC_LOC']; ?></code> - Der Ort an dem die Bilder
gespeichert sind.</p>
<p><code><?php echo $TEXT['HEADER']; ?></code> Seit Version 1.4 default leer.
  Die fr&uuml;here Javascript Funktion &quot;showteammail&quot; wird &uuml;ber frontend.js eingebunden.</p>
<p><code><?php echo $TMTEXT['GPHEADER']; ?></code> - Dies ist der Bereich oberhalb
  der Gruppe.<br>
Standardeinstellung:<br>
&lt;div class=&quot;team-head&quot;&gt;<br>
&lt;
h2&gt;[GROUPNAME]&lt;/h2&gt;<br>
&lt;
p&gt;[GROUPDESC]&lt;/p&gt;<br>
&lt;
/div&gt;</p>
<p><code><?php echo $TMTEXT['TMLOOP']; ?></code> - Hier wird die Ausgabe der
einzelnen Datens&auml;tze generiert.<br>
Standardeinstellung:<br>
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
<p><strong>Wichtig: </strong>[MAIL] usw. wird mit &lt;li class=&quot;...&quot;&gt; generiert. Leere Felder werden
  nicht ausgegeben.</p>
<p>Die meisten anderen Felder sind leer bzw enthalten nur &lt;!-- Kommentare--&gt;,
k&ouml;nnen aber frei ver&auml;ndert werden.</p>
