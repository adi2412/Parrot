<?php get_header(); ?>

<div class="wrap">
    <div class="menu" align="right">
        <div class="gear-holder" align="right"><img src="<?php echo get_theme_baseurl(); ?>/img/gear.png" class="gear"/></div>
        <div class="inner" id="options">
            <a href="<?php echo Parrot::getInstance()->getUrl("discussion/create"); ?>" class="clear"><button>Create a new discussion</button></a>
            <a href="<?php echo Parrot::getInstance()->getUrl("login"); ?>" class="clear"><button><?php echo session_text(); ?></button></a>
        </div>
    </div>
    <?php while (have_discussion()) : thediscussion() ?>
        <div class="discussion-preview">
            <a href="<?php echo the_link(); ?>">
                <h2 align="left">
                    <?php if (is_sticky()) : ?>
                        <img src="<?php echo get_theme_baseurl(); ?>/img/pin.png" class="small-img"/>
                    <?php endif; ?>
                    <?php echo the_title(); ?>
                </h2>
            </a>
            <div class="details">
                <div class="col"><h3>By <?php echo the_author(); ?></h3></div>
                <div class="col"><h3>In <?php echo the_category(); ?></div>
                <div class="col"><h3><?php echo get_reply_count_text(); ?></h3></div>
                <div class="lastcol"><h3><?php echo the_time(); ?></h3></div>
            </div>
        </div>
        <hr>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>
