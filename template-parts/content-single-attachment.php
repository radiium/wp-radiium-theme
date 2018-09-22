<?php
    $imgFull = wp_get_attachment_image_src( get_the_ID(), 'full' );

    $radiium_tech = get_post_meta( get_the_ID(), 'radiium_tech', true );
    $radiium_format = get_post_meta( get_the_ID(), 'radiium_format', true );
    $radiium_year = get_post_meta( get_the_ID(), 'radiium_year', true );

    $alt = $radiium_tech.' - '.$radiium_format.'- '.$radiium_year;
?>

<?php ?>

<div class="attachWrapper">
    <div class="attachInfos">
        <div class="attachTitle"><?php echo $radiium_tech ?></div>
        <div class="attachMeta"><?php echo $radiium_format.' '.$radiium_year ?></div>
    </div>

    <div class="attachImg">
        <img src="<?php echo $imgFull[0] ?>" alt="$alt">
    </div>
</div>