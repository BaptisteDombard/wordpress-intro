<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= 'TODO' ?></title>
    <link rel="stylesheet" type="text/css" href="<?= dw_mix('css/style.css'); ?>" />
    <script type="text/javascript" src="<?= dw_mix('js/script.js'); ?>"></script>
</head>
<body>
<header class="header">
    <h1 class="header__title"><?= get_bloginfo('name'); ?></h1>
    <p class="header__tagline"><?= get_bloginfo('description'); ?></p>

    <nav class="header__nav nav">
        <h2 class="nav__title"><?= __('Navigation principale', 'dw');?></h2>
        <?php // wp_nav_menu([
        //     'menu' => 'primary',
        //     'container_class' => 'nav__container',
        //     'menu_class' => 'nav__links',
        //     'menu_id' => 'navigation',
        //     'walker' => new PrimaryMenuWalker(),
        // ]); ?>

        <!--<ul class="nav__container">
            <?php /*foreach(dw_get_menu_items('primary') as $link): */?>
                <li class="<?/*= $link->getBemClasses('nav__item'); */?>">
                    <a  href="<?/*= $link->url; */?>"
                        <?/*= $link->title ? ' title="' . $link->title . '"' : ''; */?>
                        class="nav__link"
                    >
                        <?/*= $link->label; */?>
                    </a>
                    <?php /*if($link->hasSubItems()): */?>
                        <ul class="nav__subcontainer">
                            <?php /*foreach($link->subitems as $sub): */?>
                                <li class="<?/*= $sub->getBemClasses('nav__subitem'); */?>">
                                    <a  href="<?/*= $sub->url; */?>"
                                        <?/*= $sub->title ? ' title="' . $sub->title . '"' : ''; */?>
                                        class="nav__link"
                                    >
                                        <?/*= $sub->label; */?>
                                    </a>
                                </li>
                            <?php /*endforeach; */?>
                        </ul>
                    <?php /*endif; */?>
                </li>
            <?php /*endforeach; */?>
        </ul>-->
    </nav>
    <form role="search" class="header__search search" method="get" action="<?= get_home_url();?>">
        <div class="search__container">
            <label for="s" class="search__label"><?= __('Votre recherche', 'dw');?></label>
            <input type="text" name="s" id="s" class="search__input" value="<?= get_search_query();?>">
            <button class="search__btn">Rechercher</button>
        </div>
    </form>
</header>