<?php $uri_array = explode("/", $_SERVER['REQUEST_URI']); ?>
<div class="block-atoz-index" <?php echo ( in_array("tag", $uri_array) ? 'style="display: block;"': NULL); ?> >
	<div class="container">
		<ul>
			<?php
				foreach (range('a', 'z') as $letter)
				{
					echo '<li><a '.($letter == substr( get_query_var( 'letter' ), 0,1)? 'class="active"' : NULL).' href="'.get_site_url().'/tag/'.$letter.'">'.ucfirst($letter).'</a></li>' . "\n";
				}
			?>
		</ul>
		<form action="">
			<select class="select-style" name="atoz" id="">
				<option>Search the A to Z index</option>
				<?php 
					foreach (range('a', 'z') as $letter)
					{
						echo '<option '.($letter == substr( get_query_var( 'letter' ), 0,1)? 'selected' : NULL).' value="'.$letter.'">'.ucfirst($letter).'</option>'; 
					}
				?>
			</select>
		</form>		
	</div>
</div>