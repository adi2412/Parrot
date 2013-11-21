<?php meta_header(); ?>

<div class="wrap">
	<div class="menu" align="right">
		<?php discussion_menu($slug); ?>
		<!-- log in / out button-->
		<a href="<?php echo session_link(); ?>"><button><?php echo session_text(); ?></button></a>
	</div>
	<?php $discussion = get_discussion($slug); ?>
	<div class="discussion">
		<div class="title">
			<h4><?php echo $discussion['title']; ?></h4>
			<div class="details">
				<div class="col"><h3>By <?php echo $discussion['author']; ?></h3></div>
	    		<div class="col"></div>
	    		<div class="col"></div>
	    		<div class="lastcol"><h3><?php echo $discussion['time']; ?></h3></div>
			</div>
			<p>
				<?php echo Parsedown::instance()->parse($discussion['content']); ?>
			</p>
			<hr>
		</div>
		<!-- foreach goes here -->
		<div class="reply">
			<?php $replies = get_replies($discussion['title']); ?>
			<?php foreach ($replies as $reply) : ?>
				<div class="content">
					<div class="details">
						<div class="col"><h3>By <?php echo $reply['author']; ?></h3></div>
	    				<div class="col"></div>
	    				<div class="lastcol"><h3><?php echo $reply['time']; ?></h3></div>
					</div>
					<?php echo Parsedown::instance()->parse($reply['content']); ?>
				</div>
				<hr>
			<?php endforeach; ?>
		</div>

		<div class="reply">
			<?php // create a new reply form with button text 'Reply' ?>
			<?php reply_form($discussion['title'], 'Reply'); ?>
		</div>
	</div>
</div>

<?php meta_footer(); ?>