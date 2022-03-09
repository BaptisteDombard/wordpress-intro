<!doctype html>
<html lang=fr>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test de wordpress</title>
</head>
<body>
    <header class="header">
        <h1 class="header__title"><?= get_bloginfo('name'); ?></h1>
        <p class="header__tagline"><?= get_bloginfo('description') ?></p>

        <nav class="header__nav nav">
            <h2 class="nav__title">Navigation principale</h2>
<!--            --><?php //wp_nav_menu([
//                    'menu' => 'primary',
//                    'container_class' => 'nav_container',
//                    'menu_class' => 'nav_links',
//                    'menu_id' => 'navigation',
//                    'walker' => new PrimaryMenuWalker(),
//                    ])?>
            <ul class="nav__container">
                <?php foreach (dw_get_menu_items('primary') as $link): ?>
                <li class="<?= $link->getBemClasses('')?>">
                    <a href="<?= $link->url; ?>"
                       <?= $link->title ? ' title="' . $link->title . '"' : '';?>
                       class="nav__link"><?= $link->label; ?></a>
                    <?php if ($link->hasSubItems):?>
                    <?php endif;?>
                </li>
                <?php endforeach;?>
            </ul>
        </nav>
    </header>
