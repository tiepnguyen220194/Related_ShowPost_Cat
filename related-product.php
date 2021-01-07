<?php
	//$glb_ctp_product biến toàn cục
	//$glb_tax_product biến toàn cục
	global $post;
	$terms = get_the_terms( $post->ID , $glb_tax_product, 'string');
	$term_ids = wp_list_pluck($terms,'term_id');
	$query = new WP_Query( array(
		'post_type' => $glb_ctp_product,
		'tax_query' => array(
			array(
				'taxonomy' => $glb_tax_product,
				'field' => 'id',
				'terms' => $term_ids,
				'operator'=> 'IN'
			 )),
		'posts_per_page' => 4,
		'orderby' => 'date',
		'post__not_in'=>array($post->ID)
	) );
?>


<aside class="related-product">

	<div class="caption-text">
		<span class="text"><h3>Sản phẩm liên quan</h3></span>
	</div>

	<?php if($query->have_posts()) : while ($query->have_posts() ) : $query->the_post(); ?>

		<div class="title">
	        <a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>">
	      	    <h4><?php the_title(); ?></h4>
	        </a>
	    </div>

	<?php endwhile; wp_reset_postdata(); else: echo ''; endif; ?>

</aside>