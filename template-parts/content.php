<?php

echo '<div class="postsGridWrapper">';
echo '<div class="postsGrid">';
while ( have_posts()) : the_post();

    echo '<div class="postItem">';
    ?>

    <a class="postItemLink" href="<?php the_permalink() ?>" title="<?php the_title() ?>">
        <div class="postItemThumb">
            <?php
            $thumb = has_post_thumbnail() ? the_post_thumbnail( 'large' ) : '<div class="postItemThumbReplace"></div>';
            echo $thumb;
            ?>
            <div class="overlay absoluteHW flexCol"></div>
            <div class="postTitle absoluteHW flexCol"><?php the_title() ?></div>
        </div>
    </a>

    <?php
    echo '</div>';

endwhile;
echo '</div>';
echo '</div>';

?>
