<div class="block-atoz-index">
	<div class="container">
		<ul>
			<?php

			foreach (range('a', 'z') as $letter) {
    			echo '<li><a '.($letter == substr( get_query_var( 'letter' ), 0,1)? 'class="active"' : NULL).' href="'.get_site_url().'/tag/'.$letter.'">'.ucfirst($letter).'</a></li>' . "\n";
			}

			?>
		</ul>
		<form action="">
			<select class="select-style" name="atoz" id="">
				<option >A to Z index search</option>
				<option value="">A</option>
				<option value="">B</option>
				<option value="">C</option>
				<option value="">D</option>
				<option value="">E</option>
				<option value="">F</option>
				<option value="">G</option>
				<option value="">H</option>
				<option value="">I</option>
				<option value="">J</option>
				<option value="">K</option>
				<option value="">L</option>
				<option value="">M</option>
				<option value="">N</option>
				<option value="">O</option>
				<option value="">P</option>
				<option value="">Q</option>
				<option value="">R</option>
				<option value="">S</option>
				<option value="">T</option>
				<option value="">U</option>
				<option value="">V</option>
				<option value="">W</option>
				<option value="">X</option>
				<option value="">Y</option>
				<option value="">Z</option>
			</select>
		</form>		
	</div>
</div>