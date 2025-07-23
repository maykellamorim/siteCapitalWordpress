// Google Analytics 4 Configuration

// Função para inicializar o Google Analytics
function initGoogleAnalytics() {
    // Substitua 'G-XXXXXXXXXX' pelo seu ID de medição do Google Analytics 4
    const MEASUREMENT_ID = 'G-XXXXXXXXXX';
    
    // Carregar o script do Google Analytics
    const script = document.createElement('script');
    script.async = true;
    script.src = `https://www.googletagmanager.com/gtag/js?id=${MEASUREMENT_ID}`;
    document.head.appendChild(script);
    
    // Configurar o Google Analytics
    window.dataLayer = window.dataLayer || [];
    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', MEASUREMENT_ID, {
        'anonymize_ip': true,
        'cookie_expires': 365 * 24 * 60 * 60, // 1 ano em segundos
        'cookie_domain': window.location.hostname,
        'cookie_flags': 'SameSite=None;Secure',
        'page_title': document.title,
        'page_location': window.location.href,
        'send_page_view': true
    });
    
    // Adicionar eventos personalizados
    setupCustomEvents();
}

// Função para configurar eventos personalizados
function setupCustomEvents() {
    // Rastrear cliques em botões de ação
    document.querySelectorAll('.btn-action, .btn-primary, .btn-contact').forEach(button => {
        button.addEventListener('click', function() {
            gtag('event', 'button_click', {
                'event_category': 'engagement',
                'event_label': this.textContent.trim() || 'Botão de ação',
                'value': 1
            });
        });
    });
    
    // Rastrear envios de formulário
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            gtag('event', 'form_submit', {
                'event_category': 'conversion',
                'event_label': 'Formulário de contato',
                'value': 1
            });
        });
    }
    
    // Rastrear cliques no botão de WhatsApp
    const whatsappButton = document.querySelector('.whatsapp-button');
    if (whatsappButton) {
        whatsappButton.addEventListener('click', function() {
            gtag('event', 'whatsapp_click', {
                'event_category': 'conversion',
                'event_label': 'Botão de WhatsApp',
                'value': 1
            });
        });
    }
    
    // Rastrear tempo de permanência na página
    let startTime = new Date().getTime();
    window.addEventListener('beforeunload', function() {
        const endTime = new Date().getTime();
        const timeSpent = Math.round((endTime - startTime) / 1000); // em segundos
        
        gtag('event', 'time_spent', {
            'event_category': 'engagement',
            'event_label': 'Tempo na página',
            'value': timeSpent
        });
    });
    
    // Rastrear rolagem da página
    let maxScroll = 0;
    window.addEventListener('scroll', function() {
        const scrollPercentage = Math.round((window.scrollY / (document.body.scrollHeight - window.innerHeight)) * 100);
        
        if (scrollPercentage > maxScroll) {
            maxScroll = scrollPercentage;
            
            if (maxScroll === 25 || maxScroll === 50 || maxScroll === 75 || maxScroll === 100) {
                gtag('event', 'scroll_depth', {
                    'event_category': 'engagement',
                    'event_label': `Rolagem ${maxScroll}%`,
                    'value': maxScroll
                });
            }
        }
    });
}

// Inicializar o Google Analytics apenas após o consentimento do usuário
function initAnalyticsWithConsent() {
    // Verificar se o usuário já deu consentimento
    const hasConsent = localStorage.getItem('analytics_consent') === 'true';
    
    if (hasConsent) {
        // Se já tiver consentimento, inicializar o Google Analytics
        initGoogleAnalytics();
    } else {
        // Caso contrário, mostrar banner de consentimento
        showConsentBanner();
    }
}

// Função para mostrar o banner de consentimento
function showConsentBanner() {
    // Criar o banner de consentimento
    const banner = document.createElement('div');
    banner.className = 'consent-banner';
    banner.innerHTML = `
        <div class="consent-content">
            <p>Utilizamos cookies e tecnologias semelhantes para melhorar sua experiência em nosso site. Ao clicar em "Aceitar", você concorda com o uso de cookies para análise de dados.</p>
            <div class="consent-buttons">
                <button id="accept-cookies" class="btn btn-primary">Aceitar</button>
                <button id="reject-cookies" class="btn btn-outline-secondary">Recusar</button>
            </div>
        </div>
    `;
    
    // Adicionar o banner ao corpo do documento
    document.body.appendChild(banner);
    
    // Adicionar estilos ao banner
    const style = document.createElement('style');
    style.textContent = `
        .consent-banner {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(13, 79, 39, 0.95);
            color: white;
            padding: 15px;
            z-index: 9999;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.2);
        }
        .consent-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .consent-content p {
            margin: 0;
            padding: 10px 0;
            flex: 1;
            min-width: 300px;
        }
        .consent-buttons {
            display: flex;
            gap: 10px;
            padding: 10px 0;
        }
        @media (max-width: 768px) {
            .consent-content {
                flex-direction: column;
                text-align: center;
            }
            .consent-buttons {
                width: 100%;
                justify-content: center;
            }
        }
    `;
    document.head.appendChild(style);
    
    // Adicionar eventos aos botões
    document.getElementById('accept-cookies').addEventListener('click', function() {
        localStorage.setItem('analytics_consent', 'true');
        banner.remove();
        initGoogleAnalytics();
    });
    
    document.getElementById('reject-cookies').addEventListener('click', function() {
        localStorage.setItem('analytics_consent', 'false');
        banner.remove();
    });
}

// Inicializar o sistema de consentimento quando o DOM estiver carregado
// document.addEventListener('DOMContentLoaded', initAnalyticsWithConsent); // Temporariamente desabilitado