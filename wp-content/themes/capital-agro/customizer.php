<?php
/**
 * Configurações do Customizer para o tema Capital Agro
 *
 * @package Capital_Agro
 */

/**
 * Adicionar configurações do customizer
 */
function capital_agro_customize_register($wp_customize) {
    
    // Seção de Informações da Empresa
    $wp_customize->add_section('capital_agro_company_info', array(
        'title'    => __('Informações da Empresa', 'capital-agro'),
        'priority' => 30,
    ));
    
    // Telefone
    $wp_customize->add_setting('capital_agro_phone', array(
        'default'           => '(11) 99999-9999',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('capital_agro_phone', array(
        'label'   => __('Telefone', 'capital-agro'),
        'section' => 'capital_agro_company_info',
        'type'    => 'text',
    ));
    
    // Email
    $wp_customize->add_setting('capital_agro_email', array(
        'default'           => 'contato@capitalagro.com.br',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('capital_agro_email', array(
        'label'   => __('Email', 'capital-agro'),
        'section' => 'capital_agro_company_info',
        'type'    => 'email',
    ));
    
    // Endereço
    $wp_customize->add_setting('capital_agro_address', array(
        'default'           => 'São Paulo, SP',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('capital_agro_address', array(
        'label'   => __('Endereço', 'capital-agro'),
        'section' => 'capital_agro_company_info',
        'type'    => 'textarea',
    ));
    
    // WhatsApp
    $wp_customize->add_setting('capital_agro_whatsapp', array(
        'default'           => '5511999999999',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('capital_agro_whatsapp', array(
        'label'       => __('WhatsApp', 'capital-agro'),
        'description' => __('Número no formato: 5511999999999', 'capital-agro'),
        'section'     => 'capital_agro_company_info',
        'type'        => 'text',
    ));
    
    // Seção Hero
    $wp_customize->add_section('capital_agro_hero', array(
        'title'    => __('Seção Hero', 'capital-agro'),
        'priority' => 31,
    ));
    
    // Título Hero
    $wp_customize->add_setting('capital_agro_hero_title', array(
        'default'           => 'Soluções Agroindustriais de Excelência',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('capital_agro_hero_title', array(
        'label'   => __('Título Principal', 'capital-agro'),
        'section' => 'capital_agro_hero',
        'type'    => 'text',
    ));
    
    // Subtítulo Hero
    $wp_customize->add_setting('capital_agro_hero_subtitle', array(
        'default'           => 'Especialistas em fertilizantes e consultoria para o agronegócio brasileiro',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('capital_agro_hero_subtitle', array(
        'label'   => __('Subtítulo', 'capital-agro'),
        'section' => 'capital_agro_hero',
        'type'    => 'textarea',
    ));
    
    // Imagem de fundo Hero
    $wp_customize->add_setting('capital_agro_hero_bg', array(
        'default'           => get_template_directory_uri() . '/assets/img/hero-bg.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'capital_agro_hero_bg', array(
        'label'   => __('Imagem de Fundo', 'capital-agro'),
        'section' => 'capital_agro_hero',
    )));
    
    // Seção Sobre
    $wp_customize->add_section('capital_agro_about', array(
        'title'    => __('Seção Sobre', 'capital-agro'),
        'priority' => 32,
    ));
    
    // Título Sobre
    $wp_customize->add_setting('capital_agro_about_title', array(
        'default'           => 'Sobre a Capital Agro',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('capital_agro_about_title', array(
        'label'   => __('Título da Seção', 'capital-agro'),
        'section' => 'capital_agro_about',
        'type'    => 'text',
    ));
    
    // Texto Sobre
    $wp_customize->add_setting('capital_agro_about_text', array(
        'default'           => 'Somos uma empresa especializada em soluções agroindustriais...',
        'sanitize_callback' => 'wp_kses_post',
    ));
    
    $wp_customize->add_control('capital_agro_about_text', array(
        'label'   => __('Texto da Seção', 'capital-agro'),
        'section' => 'capital_agro_about',
        'type'    => 'textarea',
    ));
    
    // Imagem Sobre
    $wp_customize->add_setting('capital_agro_about_image', array(
        'default'           => get_template_directory_uri() . '/assets/img/sobre.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'capital_agro_about_image', array(
        'label'   => __('Imagem da Seção', 'capital-agro'),
        'section' => 'capital_agro_about',
    )));
    
    // Seção Redes Sociais
    $wp_customize->add_section('capital_agro_social', array(
        'title'    => __('Redes Sociais', 'capital-agro'),
        'priority' => 33,
    ));
    
    // Facebook
    $wp_customize->add_setting('capital_agro_facebook', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('capital_agro_facebook', array(
        'label'   => __('Facebook URL', 'capital-agro'),
        'section' => 'capital_agro_social',
        'type'    => 'url',
    ));
    
    // Instagram
    $wp_customize->add_setting('capital_agro_instagram', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('capital_agro_instagram', array(
        'label'   => __('Instagram URL', 'capital-agro'),
        'section' => 'capital_agro_social',
        'type'    => 'url',
    ));
    
    // LinkedIn
    $wp_customize->add_setting('capital_agro_linkedin', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('capital_agro_linkedin', array(
        'label'   => __('LinkedIn URL', 'capital-agro'),
        'section' => 'capital_agro_social',
        'type'    => 'url',
    ));
    
    // YouTube
    $wp_customize->add_setting('capital_agro_youtube', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('capital_agro_youtube', array(
        'label'   => __('YouTube URL', 'capital-agro'),
        'section' => 'capital_agro_social',
        'type'    => 'url',
    ));
    
    // Seção de Cores
    $wp_customize->add_section('capital_agro_colors', array(
        'title'    => __('Cores do Tema', 'capital-agro'),
        'priority' => 34,
    ));
    
    // Cor Primária
    $wp_customize->add_setting('capital_agro_primary_color', array(
        'default'           => '#0D4F27',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'capital_agro_primary_color', array(
        'label'   => __('Cor Primária', 'capital-agro'),
        'section' => 'capital_agro_colors',
    )));
    
    // Cor Secundária
    $wp_customize->add_setting('capital_agro_secondary_color', array(
        'default'           => '#28a745',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'capital_agro_secondary_color', array(
        'label'   => __('Cor Secundária', 'capital-agro'),
        'section' => 'capital_agro_colors',
    )));
    
    // Cor de Destaque
    $wp_customize->add_setting('capital_agro_accent_color', array(
        'default'           => '#ffc107',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'capital_agro_accent_color', array(
        'label'   => __('Cor de Destaque', 'capital-agro'),
        'section' => 'capital_agro_colors',
    )));
}
add_action('customize_register', 'capital_agro_customize_register');

/**
 * Gerar CSS personalizado baseado nas configurações do customizer
 */
function capital_agro_customizer_css() {
    $primary_color = get_theme_mod('capital_agro_primary_color', '#0D4F27');
    $secondary_color = get_theme_mod('capital_agro_secondary_color', '#28a745');
    $accent_color = get_theme_mod('capital_agro_accent_color', '#ffc107');
    
    $hero_bg = get_theme_mod('capital_agro_hero_bg', get_template_directory_uri() . '/assets/img/hero-bg.jpg');
    
    ?>
    <style type="text/css">
        :root {
            --primary-color: <?php echo esc_attr($primary_color); ?>;
            --secondary-color: <?php echo esc_attr($secondary_color); ?>;
            --accent-color: <?php echo esc_attr($accent_color); ?>;
        }
        
        .hero {
            background-image: linear-gradient(rgba(13, 79, 39, 0.8), rgba(13, 79, 39, 0.8)), url('<?php echo esc_url($hero_bg); ?>');
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .navbar {
            background-color: var(--primary-color);
        }
        
        .section-title {
            color: var(--primary-color);
        }
        
        .icon-box:hover {
            background-color: var(--primary-color);
        }
        
        .culture-card:hover {
            border-color: var(--secondary-color);
        }
        
        .footer {
            background-color: var(--primary-color);
        }
        
        .whatsapp-button {
            background-color: var(--secondary-color);
        }
        
        .back-to-top {
            background-color: var(--primary-color);
        }
        
        .social-link:hover {
            color: var(--accent-color);
        }
    </style>
    <?php
}
add_action('wp_head', 'capital_agro_customizer_css');

/**
 * Função para obter configurações do customizer com fallback
 */
function capital_agro_get_option($option, $default = '') {
    return get_theme_mod($option, $default);
}

/**
 * Adicionar suporte a refresh seletivo no customizer
 */
function capital_agro_customize_selective_refresh($wp_customize) {
    // Verificar se o Customizer suporta refresh seletivo
    if (!isset($wp_customize->selective_refresh)) {
        return;
    }
    
    // Título do site
    $wp_customize->selective_refresh->add_partial('blogname', array(
        'selector'        => '.site-title',
        'render_callback' => function() {
            return get_bloginfo('name');
        },
    ));
    
    // Descrição do site
    $wp_customize->selective_refresh->add_partial('blogdescription', array(
        'selector'        => '.site-description',
        'render_callback' => function() {
            return get_bloginfo('description');
        },
    ));
}
add_action('customize_register', 'capital_agro_customize_selective_refresh');
?>