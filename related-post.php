<?php
    global $post;
    $categories = get_the_category($post->ID);

    $category_ids = array();
    foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
    $args=array(
	    'category__in' => $category_ids,
	    'post__not_in' => array($post->ID),
	    'posts_per_page'=> 4,
	    'ignore_sticky_posts'=>1
    );
    $query = new wp_query( $args );
?>


<aside class="related-post">

	<div class="caption-text">
		<span class="text"><h3>Tin liên quan</h3></span>
	</div>

	<?php if($query->have_posts()) : while ($query->have_posts() ) : $query->the_post(); ?>

	    <div class="title">
	        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
	      	    <h4><?php the_title(); ?></h4>
	        </a>
	    </div>

	<?php endwhile; wp_reset_postdata(); else: echo ''; endif; ?>

</aside>