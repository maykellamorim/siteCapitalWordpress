<?php
/**
 * Header do tema Capital Agro Investors
 *
 * @package Capital_Agro
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php if (is_front_page()) : ?>
    <title><?php echo get_bloginfo('name'); ?> | <?php echo get_bloginfo('description'); ?></title>
    <?php endif; ?>
    
    <!-- Meta tags para SEO -->
    <meta name="description" content="<?php echo get_bloginfo('description'); ?>">
    <meta name="keywords" content="agroindustrial, fertilizantes, consultoria agrícola, soluções agroindustriais">
    <meta name="author" content="<?php echo get_bloginfo('name'); ?>">
    
    <!-- Favicon -->
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon.svg" type="image/svg+xml">
    
    <!-- PWA Support -->
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/manifest.json">
    <meta name="theme-color" content="#0D4F27">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="CAPITAL Agro">
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Navbar -->
<nav class="navbar fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?php echo home_url(); ?>">
            <?php 
            if (has_custom_logo()) {
                the_custom_logo();
            } else {
                echo '<img src="' . get_template_directory_uri() . '/assets/img/Capital_logo.jpg" alt="' . get_bloginfo('name') . '" class="logo">';
            }
            ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon-custom">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class'     => 'navbar-nav ms-auto',
                'container'      => false,
                'fallback_cb'    => 'capital_agro_fallback_menu',
                'walker'         => new Capital_Agro_Walker_Nav_Menu()
            ));
            ?>
        </div>
    </div>
</nav>

<?php
/**
 * Menu fallback quando não há menu configurado
 */
function capital_agro_fallback_menu() {
    echo '<ul class="navbar-nav ms-auto">';
    echo '<li class="nav-item"><a class="nav-link" href="#home">Home</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="#sobre">Sobre</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="#culturas">Culturas</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="#segmentos">Segmentos</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="#solucoes">Soluções</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="#parceiros">Parceiros</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="#trabalhe-conosco">Trabalhe Conosco</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="#contato">Contato</a></li>';
    echo '</ul>';
}

/**
 * Walker personalizado para o menu de navegação
 */
class Capital_Agro_Walker_Nav_Menu extends Walker_Nav_Menu {
    
    // Start Level - wrap the list
    function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }
    
    // End Level - close the list
    function end_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
    
    // Start Element - start the list item
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="nav-item ' . esc_attr($class_names) . '"' : ' class="nav-item"';
        
        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        
        $output .= $indent . '<li' . $id . $class_names .'>';
        
        $attributes = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
        $attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target     ) .'"' : '';
        $attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn        ) .'"' : '';
        $attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url        ) .'"' : '';
        
        $item_output = isset($args->before) ? $args->before : '';
        $item_output .= '<a class="nav-link"' . $attributes .'>';
        $item_output .= (isset($args->link_before) ? $args->link_before : '') . apply_filters('the_title', $item->title, $item->ID) . (isset($args->link_after) ? $args->link_after : '');
        $item_output .= '</a>';
        $item_output .= isset($args->after) ? $args->after : '';
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
    
    // End Element - end the list item
    function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= "</li>\n";
    }
}
?>