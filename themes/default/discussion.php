<?php get_header(); ?>

<div class="wrap">
	<div class="menu" align="right">
		<div class="gear-holder" align="right"><img src="<?php echo get_theme_directory(); ?>/imgs/gear.png" class="gear"/></div>
		<div class="inner" id="options">
			<?php discussion_menu($slug); ?>
			<!-- log in / out button-->
			<a href="<?php echo session_link(); ?>" class="clear"><button><?php echo session_text(); ?></button></a>
		</div>
	</div>
	<?php while(have_discussion()) : thediscussion() ?>
		<div class="discussion">
		<div class="title">
			<h4><?php echo the_title(); ?></h4>
			<div class="details">
				<div class="col">
					<h3 style="display: inline-block;">By <?php echo the_author(); ?></h3>
					<?php if (auth::checkAdmin(the_author())) : ?>
						<div class="badge">Admin</div>
					<?php endif; ?>
					<?php if (auth::checkMod(the_author())) : ?>
						<div class="badge">Mod</div>
					<?php endif; ?>
				</div>
	    		<div class="col"><h3>In <?php echo the_category(); ?></h3></div>
	    		<div class="col"><h3><?php echo get_reply_count_text(); ?></h3></div>
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
		    				<div class="col"><?php echo reply_delete_button(); ?></div>
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