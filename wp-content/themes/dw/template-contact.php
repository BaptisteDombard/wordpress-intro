<?php /* Template Name: Contact page template*/?>

<?php get_header(); ?>
<?php if (have_posts()): while (have_posts()):the_post(); ?>
    <main class="layout contact">
        <h2 class="contact__title">Contactez-moi</h2>
        <figure class="contact__fig">
            <?= get_the_post_thumbnail(null, 'medium_large', ['class' => 'singleTrip__thumbnail'])?>
        </figure>
        <div class="contact__content">
            <?php the_content();?>
        </div>
        <div class="contact__form">
            <?= apply_filters('the_content', '[contact-form-7 id="40" title="Formulaire de contact"]')?>
        </div>
    </main>
<?php endwhile; endif;?>
<?php get_footer(); ?>
