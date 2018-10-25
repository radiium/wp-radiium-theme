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

$userAgentClass = '';
        if (wp_is_mobile()) {
            $userAgentClass = 'mobile';
        } else {
            $userAgentClass = 'desktop';
        }
?>

<div class="postsGridWrapper">

    <!-- Controls -->
    <div class="postControlsWrapper">

        <!-- Toggle controls -->
        <div class="toggleFiltersBtn" title="Filters">
            <img src="<?php echo get_site_url() ?>/wp-content/themes/radiium/assets/images/filters.png" alt="">
        </div>


        <div class="postControls" style="display: none;">

            <!-- Sorters -->
            <div class="sortersContainer">
                <div class="postControlsLabel">sort :</div>
                <div class="postControlsItems">
                    <input class="postShuffleBtn postBtn" type="button" value="Shuffle"></button>
                    <input class="postReverseBtn postBtn" type="button" value="Reverse"></button>
                </div>
            </div>

            <!-- Filters -->
            <div class="filtersContainer">
                <div class="postControlsLabel">Filter :</div>
                <div class="postControlsItems">
                    <input class="postFilterBtn postFilterAllBtn postBtn activ" type="button" value="All"  data-filter="all"></button>
                    <?php foreach (get_categories() as $cat) { ?>
                        <input class="postFilterBtn postBtn" type="button" value="<?php echo $cat->name ?>" data-filter="<?php echo $cat->name ?>"></button>
                    <?php } ?>
                </div>
            </div>

            <!-- Filters -->
            <div class="filtersContainer">
                <div class="postControlsLabel">Tags :</div>
                <div class="postControlsItems">
                    <input class="postFilterBtn postFilterAllBtn postBtn activ" type="button" value="All"  data-filter="all"></button>
                    <?php foreach (get_tags() as $tag) { ?>
                        <input class="postFilterBtn postBtn" type="button" value="<?php echo $tag->name ?>" data-filter="<?php echo $tag->name ?>"></button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>




    <style>

    </style>

    <!-- Posts grid -->
    <div class="postsList">
    <?php while ( have_posts()) : the_post(); ?>

        <!-- Post item -->
        <figure class="postsListItem hidenItem" data-groups='[<?php echo radiium_get_post_categories() ?>]'>
        <a class="postItemLink" href="<?php the_permalink() ?>" title="<?php the_title() ?>">

            <div class="thumb">
            <?php
            $thumb = has_post_thumbnail() ? the_post_thumbnail( 'large', array('draggable'=>'false') ) : '<div class="postItemThumbReplace"></div>';
            echo $thumb;
            ?>
            </div>

            <div class="postInfos <?php echo $userAgentClass?>">
                <span class="postTitle"><?php the_title() ?></span>
                <span>&nbsp; - &nbsp;</span>
                <span class="postCount">
                    <?php
                    $count = radiium_get_post_gallery_count();
                    if ($count > 1) {
                        echo $count.' items';
                    } else {
                        echo $count.' item';
                    } ?>
                </span>
            </div>
            </a>
        </figure>

    <?php endwhile; ?>
    </div>

</div>
