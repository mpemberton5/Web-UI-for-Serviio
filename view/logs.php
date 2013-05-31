<ul id="logsFileTab" class="shadetabs">
	<li><a href="#" rel="logs1" class="selected"><?php echo tr('tab_log_file','Serviio log file')?></a></li>
</ul>

<div style="border:1px solid gray; width:98%; margin-bottom: 1em; padding: 10px">
	<div id="logs1" class="tabcontent">
		<?php echo tr('tab_logs_file_description','The below shows the content of the Serviio generated log file. File location must be set in config.php (incl. filename).')?>
		<br>
		<br>
		<table>
			<tr>
				<td><?php echo tr('tab_logs_file_location','Location of Serviio log file')?>:&nbsp;</td>
				<td><input type="text" id="logfile" name="logfile" size="60" value="<?php echo $serviio_log?>" disabled></td>
			</tr>
		</table>
		<div align="right">
			<span id="savingMsg" class="savingMsg"></span>
			<input type="submit" id="refresh" name="refresh" value="<?php echo tr('button_refresh','Refresh')?>" onclick=indexes.expandit(7) class="ui-button ui-widget ui-state-default ui-corner-all btn-small" />
			<br>
		</div>
	</div>
</div>

<ul id="logsContentTab" class="shadetabs">
	<li><a href="#" rel="logs2" class="selected"><?php echo tr('tab_log_content','Log file content')?></a></li>
</ul>

<div style="border:1px solid gray; width:98%; margin-bottom: 1em; padding: 10px">
	<div id="logs2" class="tabcontent">
		<br>
			<?php
				if (!empty($serviio_log)) {
				$log = $serviio_log;
				$file = fopen( $log, "r") or exit('<strong><span style="color:#FF0000;text-align:left;"> echo tr('tab_log_open_error','Unable to open Serviio log file!') </span></strong>');
				//Output a line of the file until the end is reached
				while(!feof($file))
				{
					echo fgets($file). "<br>";
				}
				fclose($file);
				}
				else {
					echo tr('tab_log_empty','Variable "serviio_log" in config.php is empty.');
				}
			?>
		<br>
	</div>
</div>
