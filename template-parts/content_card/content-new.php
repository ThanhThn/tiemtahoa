<a href="<?php echo get_the_permalink(); ?>" class="card--new">
    <div class="thumbnail">
        <?php the_post_thumbnail(); ?>
    </div>
    <div class="content">
        <h5>
            <?php echo the_title() ?>
        </h5>
        <span class="author">
            <span>
                <?php the_author() ?>
            </span>
        </span>
        <span class="time">
            <?php the_time('F j, Y') ?>
        </span>
    </div>
</a>