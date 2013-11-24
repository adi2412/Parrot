<?php get_header(); ?>

<div class="wrap">
	<div class="menu" align="right">
		<a href="<?php echo get_createlink(); ?>"><button>Create a new discussion</button></a>
		<a href="<?php echo session_link(); ?>"><button><?php echo session_text(); ?></button></a>
	</div>
	<?php while(have_discussion()) : thediscussion() ?>
		<div class="discussion-preview">
			<a href="<?php echo the_link(); ?>"><h2><?php echo the_title(); ?></h2></a>
			<div class="details">
	    		<div class="col"><h3>By <?php echo the_author(); ?></h3></div>
	    		<div class="col"><h3>In <?php echo the_category(); ?></div>
	    		<div class="col"></div>
	    		<div class="lastcol"></div>
			</div>
		</div>
		<hr>
	<?php endwhile; ?>
</div>

<?php get_footer(); ?>