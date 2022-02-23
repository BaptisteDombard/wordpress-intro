<?php get_header(); ?>
<?php if (have_posts()): while (have_posts()):the_post(); ?>
    <main class="layout singlePost">
        <h2 class="singlePost__title"><?php get_the_title()?></h2>
        <figure class="singlePost__fig">
            <?= get_the_post_thumbnail(null, 'medium_large', ['class' => 'singleTrip__thumbnail'])?>
        </figure>
        <div class="singlePost__content">
            <?php the_content();?>
        </div>
        <aside class="singlePost__details">
            <h3 class="singlePost__subtitle">Détails du voyage</h3>
            <dl class="singlePost__definitions">
                <dt class="singlePost__label">Date de départ</dt>
                <dd class="singlePost__data">
                    <time class="singlePost__time" datetime="<?=date('c', strtotime(get_field('departure_date', false, false))); ?>">
                        <?=ucfirst(date_i18n('F, Y', strtotime(get_field('departure_date', false, false)))); ?></time>
                </dd>
                <dt class="singlePost__label">Date de retour</dt>
                <dd class="singlePost__data">
                    <?php if (get_field('return_date')):?>
                        <time class="singlePost__time" datetime="<?=date('c', strtotime(get_field('return_date', false, false))); ?>">
                            <?=ucfirst(date_i18n('F, Y', strtotime(get_field('return_date', false, false)))); ?></time>
                    <?php else:?>
                        <span class="singlePost__empty">Aucune date de retour de prévue pour le moment</span>
                    <?php endif;?>
                </dd>
            </dl>
        </aside>
    </main>
<?php endwhile; endif;?>
<?php get_footer(); ?>