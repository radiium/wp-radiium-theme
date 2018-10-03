<?php

function radiium_get_all_categories() {
    $category = array();
    foreach (get_categories() as $cat) {
        array_push($category, $cat->name);
    }
    return $category;
}

function radiium_get_post_categories() {
    $category = array();
    foreach (get_the_category() as $cat) {
        array_push($category, '"'.$cat->name.'"');
    }
    return join(',', $category);
}

function radiium_get_post_gallery_count() {
    $gallery = get_post_gallery(0, false);
    return count($gallery['src']);
}
?>

<div class="postsGridWrapper">

    <div class="postControls">
        <div class="postFilters">
            <div class="postControlsLabel">Filter :</div>
            <input class="postFilterBtn postFilterAllBtn postBtn activ" type="button" value="All"  data-filter="all"></button>

            <?php foreach (get_categories() as $cat) { ?>
                <input class="postFilterBtn postBtn" type="button" value="<?php echo $cat->name ?>" data-filter="<?php echo $cat->name ?>"></button>
            <?php } ?>
        </div>

        <div class="postSorters">
            <div class="postControlsLabel">sort :</div>
            <input class="postShuffleBtn postBtn" type="button" value="Shuffle"></button>
            <input class="postReverseBtn postBtn" type="button" value="Reverse"></button>
        </div>
    </div>


    <div class="postsGrid">
        <div class="sizer"></div>

        <?php while ( have_posts()) : the_post(); ?>

            <figure class="postItem" data-groups='[<?php echo radiium_get_post_categories() ?>]'>
                    <a class="postItemLink" href="<?php the_permalink() ?>" title="<?php the_title() ?>">
                    <div class="postItemThumb">
                        <?php
                        $thumb = has_post_thumbnail() ? the_post_thumbnail( 'large' ) : '<div class="postItemThumbReplace"></div>';
                        echo $thumb;
                        ?>
                            <div class="overlay absoluteHW flexCol"></div>
                            <div class="postInfos absoluteHW flexCol">
                                <div class="postTitle"><?php the_title() ?></div>
                                <div class="postCount">
                                    <?php
                                    $count = radiium_get_post_gallery_count();
                                    if ($count > 1) {
                                        echo $count.' items';
                                    } else {
                                        echo $count.' item';
                                    } ?>
                                </div>
                            </div>


                        </div>
                    </a>
                        <!--
                        <figcaption><?php the_title() ?></figcaption>
                        -->
                    </figure>
        <?php endwhile; ?>

    </div>
</div>
