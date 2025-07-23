module.exports = {
  plugins: [
    require('postcss-preset-env')({
      browsers: 'last 2 versions',
      stage: 3,
      features: {
        'nesting-rules': true,
        'custom-properties': true,
        'color-mod-function': true,
        'custom-media-queries': true
      }
    }),
    // Adicione autoprefixer para garantir compatibilidade entre navegadores
    require('autoprefixer'),
    // Opcional: adicione cssnano para minificação adicional em produção
    process.env.NODE_ENV === 'production' ? require('cssnano')({ 
      preset: ['default', {
        discardComments: {
          removeAll: true,
        },
        normalizeWhitespace: true,
      }]
    }) : null,
  ].filter(Boolean)
};