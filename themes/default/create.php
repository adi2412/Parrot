<?php get_header(); ?>

<div class="wrap">
	<div class="menu" align="right">
		<div class="gear-holder" align="right"><img src="<?php echo get_theme_directory(); ?>/imgs/gear.png" class="gear"/></div>
		<div class="inner" id="options">
			<select name="category" form="post">
				<?php while(have_category()) : thecategory() ?>
					<option value="<?php echo cat_title(); ?>"><?php echo cat_title(); ?></option>
				<?php endwhile; ?>
			</select>
			<input value="Submit" type="submit" class="submit" form="post"/>
			<a href="<?php echo session_link(); ?>" class="clear"><button><?php echo session_text(); ?></button></a>
		</div>
	</div>
	<?php msg_read(); ?>
	<form id="post" name="input" action="<?php echo get_submitLink(); ?>" method="post">
		<input placeholder="Title" name="title" class="boxsizingBorder" required autocomplete="off"/>
		<textarea rows="10" placeholder="Just type..." name="content" class="boxsizingBorder" required></textarea>
	</form>
</div>

<?php get_footer(); ?>