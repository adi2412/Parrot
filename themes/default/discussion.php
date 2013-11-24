<?php get_header(); ?>

<div class="wrap">
	<div class="menu" align="right">
		<?php discussion_menu($slug); ?>
		<!-- log in / out button-->
		<a href="<?php echo session_link(); ?>"><button><?php echo session_text(); ?></button></a>
	</div>
	<?php while(have_discussion()) : thediscussion() ?>
		<div class="discussion">
		<div class="title">
			<h4><?php echo the_title(); ?></h4>
			<div class="details">
				<div class="col"><h3>By <?php echo the_author(); ?></h3></div>
	    		<div class="col"><h3>In <?php echo the_category(); ?></h3></div>
	    		<div class="col"></div>
	    		<div class="lastcol"><h3><?php echo the_time(); ?></h3></div>
			</div>
			<p>
				<?php echo the_content(); ?>
			</p>
			<hr>

			<div class="reply">
				<?php while(have_replies()) : thereply() ?>
					<div class="content">
						<div class="details">
							<div class="col"><h3>By <?php echo reply_author(); ?></h3></div>
		    				<div class="col"></div>
		    				<div class="lastcol"><h3><?php echo reply_time(); ?></h3></div>
						</div>
						<?php echo reply_content(); ?>
						</div>
					<hr>
				<?php endwhile; ?>
			</div>

			<div class="reply">
				<?php reply_form('Reply'); ?>
			</div>
		<?php endwhile; ?>
	</div>
</div>

<?php get_footer(); ?>