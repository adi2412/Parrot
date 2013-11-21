<?php meta_header(); ?>

<div class="wrap">
	<div class="menu" align="right">
		<a href="<?php echo get_createlink(); ?>"><button>Create a new discussion</button></a>
		<!-- log in / out button-->
		<a href="<?php echo session_link(); ?>"><button><?php echo session_text(); ?></button></a>
	</div>
	<?php // the loop ?>
	<?php $discussions = get_discussions(); ?>
	<?php for ($i = 0; $i < count($discussions); $i++) : ?>
		<div class="discussion-preview">
			<a href="<?php echo get_discussionLink($discussions[$i]['title']); ?>"><h2><?php echo $discussions[$i]['title']; ?></h2></a>
			<div class="details">
	    		<div class="col"><h3>By <?php echo $discussions[$i]['author']; ?></h3></div>
	    		<div class="col"></div>
	    		<div class="col"></div>
	    		<div class="lastcol"></div>
			</div>
		</div>
		<hr>
	<?php endfor; ?>
	<?php // end of the loop ?>
</div>

<?php meta_footer(); ?>