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
function radiium_get_post_tags() {
    $tags = array();
    foreach (get_the_tags() as $cat) {
        array_push($tags, '"'.$cat->name.'"');
    }
    return join(',', $tags);
}

function radiium_get_post_gallery_count() {
    $gallery = get_post_gallery(0, false);
    return count($gallery['src']);
}

function radiium_generate_filterbar($label, $items) {
    $output = '';
    $output .= '<div class="filtersContainer">';
    $output .= '<div class="postControlsLabel">'.$label.' :</div>';
    $output .= '<div class="postControlsItems">';
    $output .= '<input class="postFilterBtn postFilterAllBtn postBtn activ" type="button" value="All"  data-filter="all"></button>';
    foreach ($items as $cat) {
        $output .= '<input class="postFilterBtn postBtn" type="button" value="'.$cat->name.'" data-filter="'.$cat->name.'"></button>';
    }
    $output .= '</div>';
    $output .= '</div>';
    return $output;
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
                <div class="postControlsLabel"><?php _e('Sort :', 'radiium')?></div>
                <div class="postControlsItems">
                    <input class="postShuffleBtn postBtn" type="button" value="Shuffle"></button>
                    <input class="postReverseBtn postBtn" type="button" value="Reverse"></button>
                </div>
            </div>

            <!-- Filters by categories -->
            <?php echo radiium_generate_filterbar( __('Categories', 'radiium'), get_categories()); ?>

            <!-- Filters by tags -->
            <?php echo radiium_generate_filterbar( __('Tags', 'radiium') , get_tags()); ?>

        </div>
    </div>




    <style>

    </style>

    <!-- Posts grid -->
    <div class="postsList">

    <?php
        global $query_string;
        query_posts ('posts_per_page=20');
        while ( have_posts()) : the_post();
    ?>

        <!-- Post item -->
        <figure class="postsListItem hidenItem"
            data-groups='[<?php echo radiium_get_post_categories().','.radiium_get_post_tags() ?>]'
            >
        <a class="postItemLink" href="<?php the_permalink() ?>" title="<?php the_title() ?>">

            <div class="thumb">
            <?php
            $thumb = has_post_thumbnail() ? the_post_thumbnail( 'large', array('draggable'=>'false') ) : '<div class="postItemThumbReplace"></div>';
            echo $thumb;
            ?>
            </div>

            <div class="postInfos <?php echo $userAgentClass?>">
                <span class="postTitle"><?php the_title() ?>&nbsp;</span>
                <!--
                <span>&nbsp; - &nbsp;</span>
                -->
                <span class="postCount">&nbsp;
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
