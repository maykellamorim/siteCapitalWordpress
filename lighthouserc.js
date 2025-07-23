module.exports = {
  ci: {
    collect: {
      // Configurações para coleta de dados do Lighthouse
      url: ['http://localhost:9000/'],
      numberOfRuns: 3,
      settings: {
        // Configurações personalizadas do Lighthouse
        preset: 'desktop',
        throttling: {
          // Configurações de throttling para simular conexões mais lentas
          cpuSlowdownMultiplier: 4,
          rttMs: 40,
          throughputKbps: 10240,
        },
        // Desativar auditorias específicas, se necessário
        skipAudits: [],
      },
    },
    upload: {
      // Configurações para upload de resultados
      target: 'temporary-public-storage',
    },
    assert: {
      // Configurações para asserções de qualidade
      preset: 'lighthouse:recommended',
      assertions: {
        // Requisitos mínimos para cada categoria
        'categories:performance': ['warn', { minScore: 0.8 }],
        'categories:accessibility': ['warn', { minScore: 0.9 }],
        'categories:best-practices': ['warn', { minScore: 0.9 }],
        'categories:seo': ['warn', { minScore: 0.9 }],
        'categories:pwa': ['warn', { minScore: 0.7 }],
        
        // Auditorias específicas
        'first-contentful-paint': ['warn', { maxNumericValue: 2000 }],
        'interactive': ['warn', { maxNumericValue: 3500 }],
        'max-potential-fid': ['warn', { maxNumericValue: 100 }],
        'cumulative-layout-shift': ['warn', { maxNumericValue: 0.1 }],
        'largest-contentful-paint': ['warn', { maxNumericValue: 2500 }],
        
        // Desativar algumas auditorias específicas que podem não ser relevantes
        'uses-http2': 'off',
        'uses-long-cache-ttl': 'off',
        'canonical': 'off',
        'maskable-icon': 'off',
      },
    },
    server: {
      // Configurações do servidor para testes
      port: 9000,
      command: 'npm start',
    },
  },
};