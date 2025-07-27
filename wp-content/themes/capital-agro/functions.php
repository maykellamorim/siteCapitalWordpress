<?php
/**
 * Funções do tema Capital Agro Investors
 *
 * @package Capital_Agro
 */

// Evitar acesso direto
if (!defined('ABSPATH')) {
    exit;
}

// Incluir arquivo do customizer
require_once get_template_directory() . '/customizer.php';

// Incluir arquivo de configuração inicial
require_once get_template_directory() . '/setup.php';

/**
 * Configuração do tema
 */
function capital_agro_setup() {
    // Adiciona suporte a título dinâmico
    add_theme_support('title-tag');
    
    // Adiciona suporte a imagens destacadas
    add_theme_support('post-thumbnails');
    
    // Adiciona suporte a menus
    add_theme_support('menus');
    
    // Adiciona suporte a HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Adiciona suporte a logo personalizado
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // Registra menus
    register_nav_menus(array(
        'primary' => __('Menu Principal', 'capital-agro'),
        'footer'  => __('Menu do Rodapé', 'capital-agro'),
    ));
    
    // Adiciona suporte a cores personalizadas
    add_theme_support('custom-background');
    add_theme_support('customize-selective-refresh-widgets');
}
add_action('after_setup_theme', 'capital_agro_setup');

/**
 * Enfileira scripts e estilos
 */
function capital_agro_scripts() {
    // CSS do tema
    wp_enqueue_style('capital-agro-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Bootstrap CSS
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css', array(), '5.3.0');
    
    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
    
    // AOS CSS
    wp_enqueue_style('aos', 'https://unpkg.com/aos@2.3.1/dist/aos.css', array(), '2.3.1');
    
    // CSS personalizado do site original
    wp_enqueue_style('capital-agro-custom', get_template_directory_uri() . '/assets/css/style.css', array('capital-agro-style'), '1.0.0');
    
    // Bootstrap JS
    wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array(), '5.3.0', true);
    
    // AOS JS
    wp_enqueue_script('aos', 'https://unpkg.com/aos@2.3.1/dist/aos.js', array(), '2.3.1', true);
    
    // JavaScript personalizado
    wp_enqueue_script('capital-agro-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery', 'aos'), '1.0.0', true);
    
    // Localização para AJAX
    wp_localize_script('capital-agro-main', 'capital_agro_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('capital_agro_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'capital_agro_scripts');

/**
 * Registra áreas de widgets
 */
function capital_agro_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar Principal', 'capital-agro'),
        'id'            => 'sidebar-1',
        'description'   => __('Adicione widgets aqui.', 'capital-agro'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Rodapé 1', 'capital-agro'),
        'id'            => 'footer-1',
        'description'   => __('Área de widgets do rodapé 1.', 'capital-agro'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="widget-title">',
        'after_title'   => '</h5>',
    ));
    
    register_sidebar(array(
        'name'          => __('Rodapé 2', 'capital-agro'),
        'id'            => 'footer-2',
        'description'   => __('Área de widgets do rodapé 2.', 'capital-agro'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="widget-title">',
        'after_title'   => '</h5>',
    ));
    
    register_sidebar(array(
        'name'          => __('Rodapé 3', 'capital-agro'),
        'id'            => 'footer-3',
        'description'   => __('Área de widgets do rodapé 3.', 'capital-agro'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="widget-title">',
        'after_title'   => '</h5>',
    ));
}
add_action('widgets_init', 'capital_agro_widgets_init');

/**
 * Customiza o comprimento do excerpt
 */
function capital_agro_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'capital_agro_excerpt_length', 999);

/**
 * Customiza o "read more" do excerpt
 */
function capital_agro_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'capital_agro_excerpt_more');

/**
 * Adiciona classes personalizadas ao body
 */
function capital_agro_body_classes($classes) {
    if (!is_admin_bar_showing()) {
        $classes[] = 'no-admin-bar';
    }
    return $classes;
}
add_filter('body_class', 'capital_agro_body_classes');

/**
 * Registra tipos de post personalizados
 */
function capital_agro_custom_post_types() {
    // Culturas
    register_post_type('culturas', array(
        'labels' => array(
            'name' => 'Culturas',
            'singular_name' => 'Cultura',
            'add_new' => 'Adicionar Nova',
            'add_new_item' => 'Adicionar Nova Cultura',
            'edit_item' => 'Editar Cultura',
            'new_item' => 'Nova Cultura',
            'view_item' => 'Ver Cultura',
            'search_items' => 'Buscar Culturas',
            'not_found' => 'Nenhuma cultura encontrada',
            'not_found_in_trash' => 'Nenhuma cultura encontrada na lixeira'
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-carrot',
        'rewrite' => array('slug' => 'culturas'),
    ));
    
    // Soluções
    register_post_type('solucoes', array(
        'labels' => array(
            'name' => 'Soluções',
            'singular_name' => 'Solução',
            'add_new' => 'Adicionar Nova',
            'add_new_item' => 'Adicionar Nova Solução',
            'edit_item' => 'Editar Solução',
            'new_item' => 'Nova Solução',
            'view_item' => 'Ver Solução',
            'search_items' => 'Buscar Soluções',
            'not_found' => 'Nenhuma solução encontrada',
            'not_found_in_trash' => 'Nenhuma solução encontrada na lixeira'
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-lightbulb',
        'rewrite' => array('slug' => 'solucoes'),
    ));
    
    // Parceiros
    register_post_type('parceiros', array(
        'labels' => array(
            'name' => 'Parceiros',
            'singular_name' => 'Parceiro',
            'add_new' => 'Adicionar Novo',
            'add_new_item' => 'Adicionar Novo Parceiro',
            'edit_item' => 'Editar Parceiro',
            'new_item' => 'Novo Parceiro',
            'view_item' => 'Ver Parceiro',
            'search_items' => 'Buscar Parceiros',
            'not_found' => 'Nenhum parceiro encontrado',
            'not_found_in_trash' => 'Nenhum parceiro encontrado na lixeira'
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-groups',
        'rewrite' => array('slug' => 'parceiros'),
    ));
}
add_action('init', 'capital_agro_custom_post_types');

/**
 * Adiciona campos personalizados
 */
function capital_agro_add_meta_boxes() {
    add_meta_box(
        'cultura_info',
        'Informações da Cultura',
        'capital_agro_cultura_meta_box',
        'culturas',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'capital_agro_add_meta_boxes');

function capital_agro_cultura_meta_box($post) {
    wp_nonce_field('capital_agro_cultura_meta', 'capital_agro_cultura_nonce');
    
    $icone = get_post_meta($post->ID, '_cultura_icone', true);
    $descricao_curta = get_post_meta($post->ID, '_cultura_descricao_curta', true);
    
    echo '<table class="form-table">';
    echo '<tr><th><label for="cultura_icone">Ícone SVG:</label></th>';
    echo '<td><input type="text" id="cultura_icone" name="cultura_icone" value="' . esc_attr($icone) . '" class="regular-text" /></td></tr>';
    echo '<tr><th><label for="cultura_descricao_curta">Descrição Curta:</label></th>';
    echo '<td><textarea id="cultura_descricao_curta" name="cultura_descricao_curta" rows="3" class="large-text">' . esc_textarea($descricao_curta) . '</textarea></td></tr>';
    echo '</table>';
}

function capital_agro_save_cultura_meta($post_id) {
    if (!isset($_POST['capital_agro_cultura_nonce']) || !wp_verify_nonce($_POST['capital_agro_cultura_nonce'], 'capital_agro_cultura_meta')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['cultura_icone'])) {
        update_post_meta($post_id, '_cultura_icone', sanitize_text_field($_POST['cultura_icone']));
    }
    
    if (isset($_POST['cultura_descricao_curta'])) {
        update_post_meta($post_id, '_cultura_descricao_curta', sanitize_textarea_field($_POST['cultura_descricao_curta']));
    }
}
add_action('save_post', 'capital_agro_save_cultura_meta');

/**
 * Customizador do WordPress
 */
function capital_agro_customize_register($wp_customize) {
    // Seção de informações da empresa
    $wp_customize->add_section('capital_agro_company_info', array(
        'title'    => __('Informações da Empresa', 'capital-agro'),
        'priority' => 30,
    ));
    
    // Telefone
    $wp_customize->add_setting('capital_agro_phone', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('capital_agro_phone', array(
        'label'   => __('Telefone', 'capital-agro'),
        'section' => 'capital_agro_company_info',
        'type'    => 'text',
    ));
    
    // Email
    $wp_customize->add_setting('capital_agro_email', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('capital_agro_email', array(
        'label'   => __('Email', 'capital-agro'),
        'section' => 'capital_agro_company_info',
        'type'    => 'email',
    ));
    
    // Endereço
    $wp_customize->add_setting('capital_agro_address', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('capital_agro_address', array(
        'label'   => __('Endereço', 'capital-agro'),
        'section' => 'capital_agro_company_info',
        'type'    => 'textarea',
    ));
}
add_action('customize_register', 'capital_agro_customize_register');

/**
 * Função para obter culturas
 */
function get_capital_agro_culturas($limit = -1) {
    $args = array(
        'post_type'      => 'culturas',
        'posts_per_page' => $limit,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order',
        'order'          => 'ASC'
    );
    
    return new WP_Query($args);
}

/**
 * Função para obter soluções
 */
function get_capital_agro_solucoes($limit = -1) {
    $args = array(
        'post_type'      => 'solucoes',
        'posts_per_page' => $limit,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC'
    );
    
    return new WP_Query($args);
}

/**
 * Função para obter parceiros
 */
function get_capital_agro_parceiros($limit = -1) {
    $args = array(
        'post_type'      => 'parceiros',
        'posts_per_page' => $limit,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order',
        'order'          => 'ASC'
    );
    
    return new WP_Query($args);
}