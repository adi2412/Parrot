<?php get_header(); ?>

<div class="wrap">
	<div class="menu" align="right">
		<div class="gear-holder" align="right"><img src="<?php echo get_theme_directory(); ?>/imgs/gear.png" class="gear"/></div>
		<div class="inner" id="options">
			<input value="Submit" type="submit" class="submit" form="post"/>
			<a href="<?php echo session_link(); ?>" class="clear"><button><?php echo session_text(); ?></button></a>
		</div>
	</div>
	<?php msg_read(); ?>
	<form id="post" name="input" action="<?php echo get_editLink(); ?>" method="post">
		<input class="boxsizingBorder" autocomplete="off" value="<?php echo discussion_title(); ?>" disabled/>
		<input type="hidden" value="<?php echo discussion_title(); ?>" name="title" />
		<textarea rows="10" placeholder="Just type..." name="content" class="boxsizingBorder" required><?php echo discussion_content(); ?></textarea>
	</form>
</div>

<?php get_footer(); ?>