<?php /* Template Name: Contact page template*/?>

<?php get_header(); ?>
<?php if (have_posts()): while (have_posts()):the_post(); ?>
    <main class="layout contact">
        <h2 class="contact__title"><?php get_the_title()?></h2>
        <figure class="contact__fig">
            <?= get_the_post_thumbnail(null, 'medium_large', ['class' => 'singleTrip__thumbnail'])?>
        </figure>
        <div class="contact__content">
            <?php the_content();?>
        </div>
    </main>
<?php endwhile; endif;?>
<?php get_footer(); ?>
