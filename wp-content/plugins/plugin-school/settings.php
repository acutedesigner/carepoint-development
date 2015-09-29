<div class="wrap">
	<div id="icon-options-general" class="icon32"><br></div>
	<h2>pluginSchool Settings</h2>
	
	<form method="post" action="options.php" id="pSsettingsForm">
	
		<?php
			settings_fields(self::PREFIX.'Settings');
		?>
		
		<h3 class="title">Default date format</h3>
		<p>If the shortcode [dateToday] does not have any settings, this is the format that will be used.</p>

		<table class="form-table">
			<tbody>	
				<tr valign="top">
					<th scope="row">
						<label for="dateFormatString">Date Format String</label>
					</th>
					<td>
						<input id="dateFormatString" 
							name="<?php echo self::PREFIX; ?>dateTodayFormat" 
							type="text" 
							value="<?php echo get_option(self::PREFIX.'dateTodayFormat'); ?>"
						/>
						<p id="dateFormatStringMessage" class="description">If this is blank, nothing will be shown.</p>
						<p class="description">Click <a href="http://php.net/manual/en/function.date.php" target="_blank">here</a> to see the PHP.net website for all the date format codes.</p>
					</td>
				</tr>
			</tbody>
		</table>

		<p class="submit">
			<input type="submit" id="submit" class="button button-primary" value="Save Changes">
		</p>

	</form>

</div>