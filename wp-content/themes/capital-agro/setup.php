<?php
/**
 * Arquivo de configuração inicial do tema Capital Agro
 * Execute este arquivo uma vez após a ativação do tema
 *
 * @package Capital_Agro
 */

// Evitar acesso direto
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Configuração inicial do tema
 */
function capital_agro_initial_setup() {
    
    // Criar páginas padrão se não existirem
    capital_agro_create_default_pages();
    
    // Configurar menu padrão
    capital_agro_setup_default_menu();
    
    // Criar posts de exemplo para tipos personalizados
    capital_agro_create_sample_content();
    
    // Configurar opções do tema
    capital_agro_set_default_options();
    
    // Marcar como configurado
    update_option('capital_agro_setup_complete', true);
}

/**
 * Criar páginas padrão
 */
function capital_agro_create_default_pages() {
    $pages = array(
        'home' => array(
            'title' => 'Home',
            'content' => 'Página inicial do site Capital Agro Investors.',
            'template' => 'page-home.php'
        ),
        'sobre' => array(
            'title' => 'Sobre',
            'content' => 'Conheça mais sobre a Capital Agro Investors e nossa história no agronegócio.',
        ),
        'contato' => array(
            'title' => 'Contato',
            'content' => 'Entre em contato conosco. Estamos prontos para atender suas necessidades.',
        ),
        'trabalhe-conosco' => array(
            'title' => 'Trabalhe Conosco',
            'content' => 'Faça parte da nossa equipe. Envie seu currículo e venha crescer conosco.',
        ),
        'politica-privacidade' => array(
            'title' => 'Política de Privacidade',
            'content' => 'Nossa política de privacidade e proteção de dados.',
        ),
        'termos-uso' => array(
            'title' => 'Termos de Uso',
            'content' => 'Termos e condições de uso do nosso site.',
        )
    );
    
    foreach ($pages as $slug => $page_data) {
        // Verificar se a página já existe
        $existing_page = get_page_by_path($slug);
        
        if (!$existing_page) {
            $page_id = wp_insert_post(array(
                'post_title'   => $page_data['title'],
                'post_content' => $page_data['content'],
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_name'    => $slug
            ));
            
            // Definir template se especificado
            if (isset($page_data['template'])) {
                update_post_meta($page_id, '_wp_page_template', $page_data['template']);
            }
            
            // Definir página inicial
            if ($slug === 'home') {
                update_option('page_on_front', $page_id);
                update_option('show_on_front', 'page');
            }
        }
    }
}

/**
 * Configurar menu padrão
 */
function capital_agro_setup_default_menu() {
    // Verificar se o menu já existe
    $menu_exists = wp_get_nav_menu_object('Menu Principal');
    
    if (!$menu_exists) {
        // Criar menu
        $menu_id = wp_create_nav_menu('Menu Principal');
        
        // Itens do menu
        $menu_items = array(
            array('title' => 'Home', 'url' => home_url('/')),
            array('title' => 'Sobre', 'url' => home_url('/sobre')),
            array('title' => 'Culturas', 'url' => home_url('/#culturas')),
            array('title' => 'Segmentos', 'url' => home_url('/#segmentos')),
            array('title' => 'Soluções', 'url' => home_url('/#solucoes')),
            array('title' => 'Parceiros', 'url' => home_url('/#parceiros')),
            array('title' => 'Trabalhe Conosco', 'url' => home_url('/trabalhe-conosco')),
            array('title' => 'Contato', 'url' => home_url('/#contato'))
        );
        
        foreach ($menu_items as $item) {
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title'  => $item['title'],
                'menu-item-url'    => $item['url'],
                'menu-item-status' => 'publish'
            ));
        }
        
        // Atribuir menu ao local
        $locations = get_theme_mod('nav_menu_locations');
        $locations['primary'] = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }
}

/**
 * Criar conteúdo de exemplo
 */
function capital_agro_create_sample_content() {
    
    // Culturas de exemplo
    $culturas = array(
        array(
            'title' => 'Soja',
            'content' => 'Soluções especializadas para o cultivo de soja, desde o plantio até a colheita.',
            'icon' => 'fas fa-seedling'
        ),
        array(
            'title' => 'Milho',
            'content' => 'Fertilizantes e consultoria técnica para maximizar a produtividade do milho.',
            'icon' => 'fas fa-corn'
        ),
        array(
            'title' => 'Algodão',
            'content' => 'Produtos específicos para o cultivo sustentável do algodão.',
            'icon' => 'fas fa-cotton'
        ),
        array(
            'title' => 'Cana-de-açúcar',
            'content' => 'Soluções completas para o setor sucroenergético.',
            'icon' => 'fas fa-leaf'
        )
    );
    
    foreach ($culturas as $cultura) {
        // Verificar se já existe
        $existing = get_posts(array(
            'post_type' => 'culturas',
            'title' => $cultura['title'],
            'post_status' => 'any',
            'numberposts' => 1
        ));
        
        if (empty($existing)) {
            $post_id = wp_insert_post(array(
                'post_title'   => $cultura['title'],
                'post_content' => $cultura['content'],
                'post_status'  => 'publish',
                'post_type'    => 'culturas'
            ));
            
            // Adicionar meta fields
            update_post_meta($post_id, '_cultura_icone', $cultura['icon']);
        }
    }
    
    // Soluções de exemplo
    $solucoes = array(
        array(
            'title' => 'Fertilizantes Especiais',
            'content' => 'Linha completa de fertilizantes desenvolvidos especificamente para cada tipo de cultura e solo.'
        ),
        array(
            'title' => 'Consultoria Técnica',
            'content' => 'Acompanhamento técnico especializado para otimizar a produtividade e sustentabilidade.'
        ),
        array(
            'title' => 'Análise de Solo',
            'content' => 'Serviços completos de análise de solo para recomendações precisas de adubação.'
        ),
        array(
            'title' => 'Treinamentos',
            'content' => 'Capacitação técnica para produtores e profissionais do agronegócio.'
        )
    );
    
    foreach ($solucoes as $solucao) {
        $existing = get_posts(array(
            'post_type' => 'solucoes',
            'title' => $solucao['title'],
            'post_status' => 'any',
            'numberposts' => 1
        ));
        
        if (empty($existing)) {
            wp_insert_post(array(
                'post_title'   => $solucao['title'],
                'post_content' => $solucao['content'],
                'post_status'  => 'publish',
                'post_type'    => 'solucoes'
            ));
        }
    }
    
    // Parceiros de exemplo
    $parceiros = array(
        array(
            'title' => 'Empresa Parceira 1',
            'content' => 'Descrição do parceiro e da parceria estabelecida.'
        ),
        array(
            'title' => 'Empresa Parceira 2',
            'content' => 'Descrição do parceiro e da parceria estabelecida.'
        ),
        array(
            'title' => 'Empresa Parceira 3',
            'content' => 'Descrição do parceiro e da parceria estabelecida.'
        )
    );
    
    foreach ($parceiros as $parceiro) {
        $existing = get_posts(array(
            'post_type' => 'parceiros',
            'title' => $parceiro['title'],
            'post_status' => 'any',
            'numberposts' => 1
        ));
        
        if (empty($existing)) {
            wp_insert_post(array(
                'post_title'   => $parceiro['title'],
                'post_content' => $parceiro['content'],
                'post_status'  => 'publish',
                'post_type'    => 'parceiros'
            ));
        }
    }
}

/**
 * Configurar opções padrão do tema
 */
function capital_agro_set_default_options() {
    // Configurações da empresa
    $default_options = array(
        'capital_agro_telefone' => '(11) 99999-9999',
        'capital_agro_email' => 'contato@capitalagro.com.br',
        'capital_agro_endereco' => 'São Paulo, SP, Brasil',
        'capital_agro_whatsapp' => '5511999999999'
    );
    
    foreach ($default_options as $option => $value) {
        if (!get_option($option)) {
            update_option($option, $value);
        }
    }
    
    // Configurações do customizer
    $customizer_defaults = array(
        'capital_agro_hero_title' => 'Soluções Agroindustriais de Excelência',
        'capital_agro_hero_subtitle' => 'Especialistas em fertilizantes e consultoria para o agronegócio brasileiro',
        'capital_agro_about_title' => 'Sobre a Capital Agro',
        'capital_agro_about_text' => 'Somos uma empresa especializada em soluções agroindustriais, oferecendo produtos e serviços de alta qualidade para o agronegócio brasileiro. Nossa missão é contribuir para o aumento da produtividade e sustentabilidade no campo.'
    );
    
    foreach ($customizer_defaults as $option => $value) {
        if (!get_theme_mod($option)) {
            set_theme_mod($option, $value);
        }
    }
}

/**
 * Executar configuração inicial na ativação do tema
 */
function capital_agro_after_setup_theme() {
    // Verificar se já foi configurado
    if (!get_option('capital_agro_setup_complete')) {
        // Aguardar um pouco para garantir que o WordPress esteja totalmente carregado
        wp_schedule_single_event(time() + 10, 'capital_agro_delayed_setup');
    }
}
add_action('after_switch_theme', 'capital_agro_after_setup_theme');

/**
 * Executar configuração com delay
 */
function capital_agro_delayed_setup() {
    capital_agro_initial_setup();
}
add_action('capital_agro_delayed_setup', 'capital_agro_delayed_setup');

/**
 * Adicionar página de configuração no admin
 */
function capital_agro_admin_menu() {
    add_theme_page(
        'Configuração Capital Agro',
        'Configuração do Tema',
        'manage_options',
        'capital-agro-setup',
        'capital_agro_setup_page'
    );
}
add_action('admin_menu', 'capital_agro_admin_menu');

/**
 * Página de configuração no admin
 */
function capital_agro_setup_page() {
    if (isset($_POST['run_setup'])) {
        capital_agro_initial_setup();
        echo '<div class="notice notice-success"><p>Configuração inicial executada com sucesso!</p></div>';
    }
    
    $setup_complete = get_option('capital_agro_setup_complete');
    
    ?>
    <div class="wrap">
        <h1>Configuração do Tema Capital Agro</h1>
        
        <?php if ($setup_complete): ?>
            <div class="notice notice-info">
                <p>A configuração inicial já foi executada.</p>
            </div>
        <?php endif; ?>
        
        <div class="card">
            <h2>Configuração Inicial</h2>
            <p>Execute a configuração inicial para:</p>
            <ul>
                <li>Criar páginas padrão</li>
                <li>Configurar menu principal</li>
                <li>Criar conteúdo de exemplo</li>
                <li>Definir opções padrão</li>
            </ul>
            
            <form method="post">
                <p>
                    <input type="submit" name="run_setup" class="button button-primary" value="Executar Configuração Inicial" />
                </p>
            </form>
        </div>
        
        <div class="card">
            <h2>Próximos Passos</h2>
            <ol>
                <li>Vá em <strong>Aparência > Personalizar</strong> para configurar cores, textos e imagens</li>
                <li>Configure suas informações de contato em <strong>Aparência > Personalizar > Informações da Empresa</strong></li>
                <li>Adicione seu logo em <strong>Aparência > Personalizar > Identidade do Site</strong></li>
                <li>Crie ou edite suas culturas, soluções e parceiros nos respectivos menus</li>
                <li>Configure widgets do rodapé em <strong>Aparência > Widgets</strong></li>
            </ol>
        </div>
    </div>
    <?php
}
?>