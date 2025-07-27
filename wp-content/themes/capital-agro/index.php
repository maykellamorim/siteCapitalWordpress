<?php
/**
 * Template principal do tema Capital Agro Investors
 *
 * @package Capital_Agro
 */

get_header(); ?>

<!-- Seção Hero -->
<section id="home" class="hero-section">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-lg-8 mx-auto text-center" data-aos="fade-up" data-aos-duration="1000">
                <h1 class="display-4 fw-bold text-white mb-4"><?php echo get_theme_mod('capital_agro_hero_title', 'Excelência em soluções agroindustriais'); ?></h1>
                <p class="lead text-white mb-5"><?php echo get_theme_mod('capital_agro_hero_subtitle', 'Transformando o agronegócio com inovação e sustentabilidade'); ?></p>
                <a href="#solucoes" class="btn btn-primary btn-lg">Conheça nossos serviços</a>
            </div>
        </div>
    </div>
</section>

<!-- Seção Sobre -->
<section id="sobre" class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right" data-aos-duration="1000">
                <?php 
                $sobre_image = get_theme_mod('capital_agro_sobre_image', get_template_directory_uri() . '/assets/img/laboratorio.jpg');
                ?>
                <img src="<?php echo esc_url($sobre_image); ?>" alt="Sobre a CAPITAL" class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1000">
                <h2 class="section-title">Sobre Nós</h2>
                <div class="title-underline"></div>
                <p class="lead">Tecnologia e alta performance são nossas premissas.</p>
                <p>A Capital Agro Investors conta com uma rede de profissionais de diversas instituições de pesquisa no Brasil e outros países, especializados em diversas áreas do conhecimento para entregar os melhores resultados técnicos e financeiros aos nossos clientes.</p>
                <p>Com o maior centro de pesquisas de fertilizantes do país, a Capital desenvolve tecnologias em nutrição de plantas e fisiologia vegetal para mais de 5 países. Exportamos nosso conhecimento para atender demandas de clima tropical e clima temperado.</p>
                <div class="row mt-4">
                    <div class="col-md-4 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-box me-3">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Segurança</h5>
                                <p class="mb-0">Profissionais dos principais institutos de pesquisa nacionais e internacionais</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-box me-3">
                                <i class="fas fa-award"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Qualidade</h5>
                                <p class="mb-0">Alto padrão tecnológico e processos inovadores</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-box me-3">
                                <i class="fas fa-headset"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Suporte</h5>
                                <p class="mb-0">Suporte intenso com técnicas inovadoras para posicionar sua empresa à frente do mercado</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Seção Culturas Atendidas -->
<section id="culturas" class="py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h2 class="section-title" data-aos="fade-up">Culturas Atendidas</h2>
                <div class="title-underline mx-auto"></div>
                <p class="lead" data-aos="fade-up" data-aos-delay="100">Nossos fertilizantes atuam em diversas culturas</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php 
                $culturas_query = get_capital_agro_culturas(9);
                if ($culturas_query->have_posts()) : 
                    $culturas = array();
                    while ($culturas_query->have_posts()) : $culturas_query->the_post();
                        $culturas[] = array(
                            'title' => get_the_title(),
                            'image' => get_the_post_thumbnail_url(get_the_ID(), 'medium') ?: get_template_directory_uri() . '/assets/img/placeholder.jpg'
                        );
                    endwhile;
                    wp_reset_postdata();
                    
                    // Divide as culturas em grupos de 3 para o carrossel
                    $cultura_chunks = array_chunk($culturas, 3);
                ?>
                <div id="culturasCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2500">
                    <div class="carousel-inner">
                        <?php foreach ($cultura_chunks as $index => $chunk) : ?>
                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                            <div class="row justify-content-center">
                                <?php foreach ($chunk as $cultura) : ?>
                                <div class="col-6 col-md-4">
                                    <div class="cultura-card text-center">
                                        <img src="<?php echo esc_url($cultura['image']); ?>" alt="<?php echo esc_attr($cultura['title']); ?>" class="img-fluid cultura-img">
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php else : ?>
                <!-- Fallback para quando não há culturas cadastradas -->
                <div id="culturasCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2500">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row justify-content-center">
                                <div class="col-6 col-md-4">
                                    <div class="cultura-card text-center">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/milho.jpg" alt="Milho" class="img-fluid cultura-img">
                                    </div>
                                </div>
                                <div class="col-6 col-md-4">
                                    <div class="cultura-card text-center">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/soja.jpg" alt="Soja" class="img-fluid cultura-img">
                                    </div>
                                </div>
                                <div class="col-6 col-md-4 d-none d-md-block">
                                    <div class="cultura-card text-center">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/café.jpg" alt="Café" class="img-fluid cultura-img">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Seção Segmentos de Atuação -->
<section id="segmentos" class="py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h2 class="section-title" data-aos="fade-up">Segmentos de Atuação</h2>
                <div class="title-underline mx-auto"></div>
                <p class="lead" data-aos="fade-up" data-aos-delay="100">Conheça as áreas onde a CAPITAL faz a diferença</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="segment-icon mb-3">
                            <i class="fas fa-seedling"></i>
                        </div>
                        <h4 class="card-title">Fertilizantes</h4>
                        <p class="card-text">Desenvolvimento e fabricação de fertilizantes de alta performance para diferentes culturas e solos.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="segment-icon mb-3">
                            <i class="fas fa-microscope"></i>
                        </div>
                        <h4 class="card-title">Consultoria</h4>
                        <p class="card-text">Análise de solo, recomendações técnicas e consultoria especializada para otimização da produção agrícola.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="segment-icon mb-3">
                            <i class="fas fa-tractor"></i>
                        </div>
                        <h4 class="card-title">Tecnologia Agrícola</h4>
                        <p class="card-text">Implementação de soluções tecnológicas para aumentar a eficiência e produtividade no campo.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Seção Soluções -->
<section id="solucoes" class="py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h2 class="section-title" data-aos="fade-up">Nossas Soluções</h2>
                <div class="title-underline mx-auto"></div>
                <p class="lead" data-aos="fade-up" data-aos-delay="100">Soluções completas para o agronegócio</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="solution-item">
                    <div class="solution-icon">
                        <i class="fas fa-flask"></i>
                    </div>
                    <h4>Desenvolvimento de Fertilizantes</h4>
                    <p>Empresa responsável pelo desenvolvimento de fertilizantes exclusivos para nossos clientes, com capacidade de desenvolver qualquer tecnologia em nutrição de plantas.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="solution-item">
                    <div class="solution-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h4>Análise de Solo</h4>
                    <p>Diagnóstico preciso das condições do solo para recomendações personalizadas de correção e adubação.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="solution-item">
                    <div class="solution-icon">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <h4>Produtos Personalizados</h4>
                    <p>Produtos desenvolvidos que atendem as necessidades de cada região, adequando a cada situação através de análises multidisciplinares.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="solution-item">
                    <div class="solution-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4>Consultoria Técnica</h4>
                    <p>Acompanhamento técnico especializado para otimização dos resultados no campo.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="500">
                <div class="solution-item">
                    <div class="solution-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h4>Treinamentos e Consultoria</h4>
                    <p>Treinamentos em diversas áreas para as equipes e consultoria ao sistema de vendas das empresas, desde o desenvolvimento até o destino final.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="600">
                <div class="solution-item">
                    <div class="solution-icon">
                        <i class="fas fa-recycle"></i>
                    </div>
                    <h4>Soluções Sustentáveis</h4>
                    <p>Produtos e práticas que aliam produtividade e respeito ao meio ambiente.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Seção Soluções -->
<section id="solucoes" class="py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h2 class="section-title" data-aos="fade-up">Nossas Soluções</h2>
                <div class="title-underline mx-auto"></div>
                <p class="lead" data-aos="fade-up" data-aos-delay="100">Soluções completas para o agronegócio</p>
            </div>
        </div>
        <div class="row">
            <?php 
            $solucoes_query = get_capital_agro_solucoes(6);
            if ($solucoes_query->have_posts()) :
                $delay = 100;
                while ($solucoes_query->have_posts()) : $solucoes_query->the_post();
            ?>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                <div class="solution-item">
                    <div class="solution-icon">
                        <i class="fas fa-flask"></i>
                    </div>
                    <h4><?php the_title(); ?></h4>
                    <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                </div>
            </div>
            <?php 
                $delay += 100;
                endwhile;
                wp_reset_postdata();
            else :
                // Fallback para soluções padrão
                $solucoes_default = array(
                    array('icon' => 'fas fa-flask', 'title' => 'Desenvolvimento de Fertilizantes', 'desc' => 'Empresa responsável pelo desenvolvimento de fertilizantes exclusivos para nossos clientes, com capacidade de desenvolver qualquer tecnologia em nutrição de plantas.'),
                    array('icon' => 'fas fa-chart-line', 'title' => 'Análise de Solo', 'desc' => 'Diagnóstico preciso das condições do solo para recomendações personalizadas de correção e adubação.'),
                    array('icon' => 'fas fa-seedling', 'title' => 'Produtos Personalizados', 'desc' => 'Produtos desenvolvidos que atendem as necessidades de cada região, adequando a cada situação através de análises multidisciplinares.'),
                    array('icon' => 'fas fa-users', 'title' => 'Consultoria Técnica', 'desc' => 'Acompanhamento técnico especializado para otimização dos resultados no campo.'),
                    array('icon' => 'fas fa-graduation-cap', 'title' => 'Treinamentos e Consultoria', 'desc' => 'Treinamentos em diversas áreas para as equipes e consultoria ao sistema de vendas das empresas, desde o desenvolvimento até o destino final.'),
                    array('icon' => 'fas fa-recycle', 'title' => 'Soluções Sustentáveis', 'desc' => 'Produtos e práticas que aliam produtividade e respeito ao meio ambiente.')
                );
                
                $delay = 100;
                foreach ($solucoes_default as $solucao) :
            ?>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                <div class="solution-item">
                    <div class="solution-icon">
                        <i class="<?php echo $solucao['icon']; ?>"></i>
                    </div>
                    <h4><?php echo $solucao['title']; ?></h4>
                    <p><?php echo $solucao['desc']; ?></p>
                </div>
            </div>
            <?php 
                $delay += 100;
                endforeach;
            endif; 
            ?>
        </div>
    </div>
</section>

<!-- Seção Parceiros -->
<section id="parceiros" class="py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h2 class="section-title" data-aos="fade-up">Nossos Parceiros</h2>
                <div class="title-underline mx-auto"></div>
                <p class="lead" data-aos="fade-up" data-aos-delay="100">Instituições de pesquisa e universidades que confiam em nosso trabalho</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php 
                $parceiros_query = get_capital_agro_parceiros();
                if ($parceiros_query->have_posts()) :
                    $parceiros = array();
                    while ($parceiros_query->have_posts()) : $parceiros_query->the_post();
                        $parceiros[] = array(
                            'title' => get_the_title(),
                            'image' => get_the_post_thumbnail_url(get_the_ID(), 'medium') ?: get_template_directory_uri() . '/assets/img/placeholder.jpg'
                        );
                    endwhile;
                    wp_reset_postdata();
                    
                    $parceiro_chunks = array_chunk($parceiros, 4);
                ?>
                <div id="parceirosCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                    <div class="carousel-inner">
                        <?php foreach ($parceiro_chunks as $index => $chunk) : ?>
                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                            <div class="row justify-content-center align-items-center">
                                <?php foreach ($chunk as $parceiro) : ?>
                                <div class="col-6 col-md-3 mb-3">
                                    <div class="parceiro-card text-center">
                                        <img src="<?php echo esc_url($parceiro['image']); ?>" alt="<?php echo esc_attr($parceiro['title']); ?>" class="img-fluid parceiro-img">
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#parceirosCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#parceirosCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Próximo</span>
                    </button>
                </div>
                <?php else : ?>
                <!-- Fallback para quando não há parceiros cadastrados -->
                <div id="parceirosCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-6 col-md-3 mb-3">
                                    <div class="parceiro-card text-center">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/parceiros/EMBRAPA.png" alt="EMBRAPA" class="img-fluid parceiro-img">
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-3">
                                    <div class="parceiro-card text-center">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/parceiros/ESALQ.png" alt="ESALQ" class="img-fluid parceiro-img">
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-3 d-none d-md-block">
                                    <div class="parceiro-card text-center">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/parceiros/UFV.png" alt="UFV" class="img-fluid parceiro-img">
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-3 d-none d-md-block">
                                    <div class="parceiro-card text-center">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/parceiros/UFES.png" alt="UFES" class="img-fluid parceiro-img">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-6 col-md-3 mb-3">
                                    <div class="parceiro-card text-center">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/parceiros/UNESP.png" alt="UNESP" class="img-fluid parceiro-img">
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-3">
                                    <div class="parceiro-card text-center">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/parceiros/UFERRJ.png" alt="UFERRJ" class="img-fluid parceiro-img">
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-3 d-none d-md-block">
                                    <div class="parceiro-card text-center">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/parceiros/IFES.png" alt="IFES" class="img-fluid parceiro-img">
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-3 d-none d-md-block">
                                    <div class="parceiro-card text-center">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/parceiros/AUGUSTE.png" alt="AUGUSTE" class="img-fluid parceiro-img">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-6 col-md-3 mb-3">
                                    <div class="parceiro-card text-center">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/parceiros/GEORGAUGUST.png" alt="GEORG AUGUST" class="img-fluid parceiro-img">
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-3">
                                    <div class="parceiro-card text-center">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/parceiros/CENA.png" alt="CENA" class="img-fluid parceiro-img">
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-3 d-none d-md-block">
                                    <div class="parceiro-card text-center">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/parceiros/FOOD.png" alt="FOOD" class="img-fluid parceiro-img">
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-3 d-none d-md-block">
                                    <div class="parceiro-card text-center">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/parceiros/SABANCI.jpg" alt="SABANCI" class="img-fluid parceiro-img">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Controles do carrossel -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#parceirosCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#parceirosCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Próximo</span>
                    </button>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Seção Trabalhe Conosco -->
<section id="trabalhe-conosco" class="py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h2 class="section-title" data-aos="fade-up">Trabalhe Conosco</h2>
                <div class="title-underline mx-auto"></div>
                <p class="lead" data-aos="fade-up" data-aos-delay="100">Faça parte da nossa equipe de especialistas em soluções agroindustriais</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                <div class="trabalhe-conosco-info p-4 bg-white rounded shadow-sm">
                    <h4 class="mb-4">Por que trabalhar na Capital?</h4>
                    <div class="d-flex mb-3">
                        <div class="trabalhe-icon me-3">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Inovação</h5>
                            <p>Trabalhe com as mais avançadas tecnologias em nutrição de plantas e fisiologia vegetal</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="trabalhe-icon me-3">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Equipe Especializada</h5>
                            <p>Faça parte de uma rede de profissionais de diversas instituições de pesquisa</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="trabalhe-icon me-3">
                            <i class="fas fa-globe"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Alcance Internacional</h5>
                            <p>Participe de projetos que atendem mais de 5 países</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="trabalhe-icon me-3">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Crescimento Profissional</h5>
                            <p>Desenvolva sua carreira no maior centro de pesquisas de fertilizantes do país</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <form class="trabalhe-form p-4 bg-white rounded shadow-sm">
                    <h4 class="mb-4">Envie seu currículo</h4>
                    <div class="mb-3">
                        <label for="nome-candidato" class="form-label">Nome Completo</label>
                        <input type="text" class="form-control" id="nome-candidato" placeholder="Seu nome completo" required>
                    </div>
                    <div class="mb-3">
                        <label for="email-candidato" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email-candidato" placeholder="Seu e-mail" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefone-candidato" class="form-label">Telefone</label>
                        <input type="tel" class="form-control" id="telefone-candidato" placeholder="Seu telefone">
                    </div>
                    <div class="mb-3">
                        <label for="area-interesse" class="form-label">Área de Interesse</label>
                        <select class="form-select" id="area-interesse" required>
                            <option value="">Selecione uma área</option>
                            <option value="pesquisa">Pesquisa e Desenvolvimento</option>
                            <option value="vendas">Vendas e Marketing</option>
                            <option value="producao">Produção</option>
                            <option value="qualidade">Controle de Qualidade</option>
                            <option value="consultoria">Consultoria Técnica</option>
                            <option value="administrativo">Administrativo</option>
                            <option value="outros">Outros</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="curriculo" class="form-label">Currículo (PDF)</label>
                        <input type="file" class="form-control" id="curriculo" accept=".pdf" required>
                    </div>
                    <div class="mb-3">
                        <label for="mensagem-candidato" class="form-label">Mensagem (Opcional)</label>
                        <textarea class="form-control" id="mensagem-candidato" rows="4" placeholder="Conte-nos um pouco sobre você e seus objetivos profissionais"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Enviar Currículo</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Seção Contato -->
<section id="contato" class="py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h2 class="section-title" data-aos="fade-up">Entre em Contato</h2>
                <div class="title-underline mx-auto"></div>
                <p class="lead" data-aos="fade-up" data-aos-delay="100">Estamos prontos para atender às suas necessidades</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                <div class="contact-info p-4 bg-white rounded shadow-sm">
                    <h4 class="mb-4">Informações de Contato</h4>
                    <div class="d-flex mb-3">
                        <div class="contact-icon me-3">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Endereço</h5>
                            <p><?php echo get_theme_mod('capital_agro_address', 'Entre em contato para mais informações<br>sobre nossa localização'); ?></p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="contact-icon me-3">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Telefone</h5>
                            <p><?php echo get_theme_mod('capital_agro_phone', 'Entre em contato via WhatsApp'); ?></p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="contact-icon me-3">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">E-mail</h5>
                            <p><?php echo get_theme_mod('capital_agro_email', 'contato@capitalagroinvestors.com.br'); ?></p>
                        </div>
                    </div>
                    <div class="social-media mt-4">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <form class="contact-form p-4 bg-white rounded shadow-sm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" placeholder="Seu nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" placeholder="Seu e-mail" required>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Assunto</label>
                        <input type="text" class="form-control" id="subject" placeholder="Assunto da mensagem">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Mensagem</label>
                        <textarea class="form-control" id="message" rows="5" placeholder="Sua mensagem" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Enviar Mensagem</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Botão WhatsApp -->
<a href="https://wa.me/5500000000000" class="whatsapp-btn" target="_blank">
    <i class="fab fa-whatsapp"></i>
</a>

<?php get_footer(); ?>