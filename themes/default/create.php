<?php get_header(); ?>

<div class="wrap">
	<div class="menu" align="right">
		<!-- log in / out button-->
		<a href="<?php echo session_link(); ?>"><button><?php echo session_text(); ?></button></a>
	</div>
	<form name="input" action="<?php echo get_submitLink(); ?>" method="post">
		<input placeholder="Title" name="title" class="boxsizingBorder" required/>
		<textarea rows="15" placeholder="Your thoughts..." name="content" class="boxsizingBorder" required></textarea>
		<input value="Submit" type="submit" class="submit"/>
	</form>
</div>

<?php get_footer(); ?>