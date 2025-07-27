<?php
/**
 * Footer do tema Capital Agro Investors
 *
 * @package Capital_Agro
 */
?>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="footer-widget">
                    <?php if (is_active_sidebar('footer-1')) : ?>
                        <?php dynamic_sidebar('footer-1'); ?>
                    <?php else : ?>
                        <h5>Sobre a Capital Agro</h5>
                        <p>Somos uma empresa especializada em soluções agroindustriais, oferecendo produtos e serviços de alta qualidade para o agronegócio brasileiro.</p>
                        <?php 
                        if (has_custom_logo()) {
                            the_custom_logo();
                        } else {
                            echo '<img src="' . get_template_directory_uri() . '/assets/img/Capital_logo.jpg" alt="' . get_bloginfo('name') . '" class="footer-logo">';
                        }
                        ?>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-6 mb-4">
                <div class="footer-widget">
                    <?php if (is_active_sidebar('footer-2')) : ?>
                        <?php dynamic_sidebar('footer-2'); ?>
                    <?php else : ?>
                        <h5>Links Rápidos</h5>
                        <ul class="footer-links">
                            <li><a href="#home">Home</a></li>
                            <li><a href="#sobre">Sobre</a></li>
                            <li><a href="#culturas">Culturas</a></li>
                            <li><a href="#segmentos">Segmentos</a></li>
                            <li><a href="#solucoes">Soluções</a></li>
                            <li><a href="#parceiros">Parceiros</a></li>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="footer-widget">
                    <?php if (is_active_sidebar('footer-3')) : ?>
                        <?php dynamic_sidebar('footer-3'); ?>
                    <?php else : ?>
                        <h5>Contato</h5>
                        <div class="contact-info">
                            <?php 
                            $telefone = get_option('capital_agro_telefone', '(11) 99999-9999');
                            $email = get_option('capital_agro_email', 'contato@capitalagro.com.br');
                            $endereco = get_option('capital_agro_endereco', 'São Paulo, SP');
                            ?>
                            <p><i class="fas fa-phone"></i> <?php echo esc_html($telefone); ?></p>
                            <p><i class="fas fa-envelope"></i> <?php echo esc_html($email); ?></p>
                            <p><i class="fas fa-map-marker-alt"></i> <?php echo esc_html($endereco); ?></p>
                        </div>
                        
                        <div class="social-links mt-3">
                            <a href="#" class="social-link" aria-label="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="footer-widget">
                    <h5>Newsletter</h5>
                    <p>Receba nossas novidades e atualizações do mercado agroindustrial.</p>
                    
                    <!-- Formulário de Newsletter -->
                    <form class="newsletter-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                        <input type="hidden" name="action" value="capital_agro_newsletter">
                        <?php wp_nonce_field('capital_agro_newsletter_nonce', 'newsletter_nonce'); ?>
                        <div class="input-group">
                            <input type="email" name="newsletter_email" class="form-control" placeholder="Seu e-mail" required>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <hr class="footer-divider">
        
        <div class="row">
            <div class="col-md-6">
                <p class="copyright">
                    &copy; <?php echo date('Y'); ?> <?php echo get_bloginfo('name'); ?>. Todos os direitos reservados.
                </p>
            </div>
            <div class="col-md-6">
                <div class="footer-menu">
                    <a href="#">Política de Privacidade</a>
                    <a href="#">Termos de Uso</a>
                    <a href="#">Cookies</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Botão WhatsApp Flutuante -->
<div class="whatsapp-float">
    <a href="https://wa.me/5511999999999?text=Olá! Gostaria de saber mais sobre os serviços da Capital Agro." 
       target="_blank" 
       class="whatsapp-button" 
       aria-label="Falar no WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>
</div>

<!-- Botão Voltar ao Topo -->
<button id="backToTop" class="back-to-top" aria-label="Voltar ao topo">
    <i class="fas fa-chevron-up"></i>
</button>

<?php wp_footer(); ?>

<script>
// Botão voltar ao topo
document.addEventListener('DOMContentLoaded', function() {
    const backToTopButton = document.getElementById('backToTop');
    
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTopButton.style.display = 'block';
        } else {
            backToTopButton.style.display = 'none';
        }
    });
    
    backToTopButton.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});

// Smooth scroll para links internos
document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('a[href^="#"]');
    
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#' && href.length > 1) {
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    const offsetTop = target.offsetTop - 80; // Ajuste para navbar fixa
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });
});
</script>

</body>
</html>

<?php
/**
 * Processar formulário de newsletter
 */
add_action('admin_post_capital_agro_newsletter', 'capital_agro_process_newsletter');
add_action('admin_post_nopriv_capital_agro_newsletter', 'capital_agro_process_newsletter');

function capital_agro_process_newsletter() {
    // Verificar nonce
    if (!wp_verify_nonce($_POST['newsletter_nonce'], 'capital_agro_newsletter_nonce')) {
        wp_die('Erro de segurança.');
    }
    
    $email = sanitize_email($_POST['newsletter_email']);
    
    if (!is_email($email)) {
        wp_redirect(add_query_arg('newsletter', 'error', wp_get_referer()));
        exit;
    }
    
    // Aqui você pode integrar com um serviço de email marketing
    // Por exemplo: MailChimp, ConvertKit, etc.
    
    // Por enquanto, vamos apenas salvar no banco de dados
    global $wpdb;
    $table_name = $wpdb->prefix . 'capital_agro_newsletter';
    
    $result = $wpdb->insert(
        $table_name,
        array(
            'email' => $email,
            'date_subscribed' => current_time('mysql')
        ),
        array('%s', '%s')
    );
    
    if ($result) {
        wp_redirect(add_query_arg('newsletter', 'success', wp_get_referer()));
    } else {
        wp_redirect(add_query_arg('newsletter', 'error', wp_get_referer()));
    }
    exit;
}

/**
 * Criar tabela de newsletter na ativação do tema
 */
function capital_agro_create_newsletter_table() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'capital_agro_newsletter';
    
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        email varchar(100) NOT NULL,
        date_subscribed datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY email (email)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

// Executar na ativação do tema
add_action('after_switch_theme', 'capital_agro_create_newsletter_table');
?>