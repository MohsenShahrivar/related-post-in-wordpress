<?php
$terms = get_the_terms( $post->ID , 'category');
$term_names = wp_list_pluck($terms,'name');
$post_query = new WP_Query( array(
    'post_type' => 'post',
    'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'field' => 'name',
            'terms' => $term_names,
            'operator'=> 'IN' //Or 'AND' or 'NOT IN'
        )),
    'posts_per_page' => 10,
    'ignore_sticky_posts' => 1,
    'orderby' => 'rand',
    'post__not_in'=>array($post->ID)
) );

if ( $post_query->have_posts() ) : ?>
    <div id="related-post-based-post-tag" class="my-4 my-lg-5">
        <?php while ( $post_query->have_posts() ) : $post_query->the_post(); ?>
            <div class="card">
                <header>
                    <img src="<?php echo get_post_thumbnail_url(); ?>" class="img-controller">
                    <h4><?php the_title(); ?></h4>
                </header>
                <div><?php echo get_the_excerpt(); ?></div>
            </div> <!--  .card  -->
        <?php endwhile; wp_reset_query(); ?>
    </div> <!--  #related-post-based-post-tag  -->
<?php endif; ?>
