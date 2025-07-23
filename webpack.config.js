const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const CopyPlugin = require('copy-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const WorkboxPlugin = require('workbox-webpack-plugin');

module.exports = (env, argv) => {
  const isProduction = argv.mode === 'production';
  
  return {
    entry: {
      main: './assets/js/main.js',
      analytics: './assets/js/analytics.js'
    },
    output: {
      filename: 'assets/js/[name].[contenthash].js',
      path: path.resolve(__dirname, 'dist'),
      publicPath: '/'
    },
    devServer: {
      static: {
        directory: path.join(__dirname, '/'),
      },
      compress: true,
      port: 9000,
      hot: true,
      open: true,
      historyApiFallback: true
    },
    module: {
      rules: [
        {
          test: /\.js$/,
          exclude: /node_modules/,
          use: {
            loader: 'babel-loader',
            options: {
              presets: ['@babel/preset-env']
            }
          }
        },
        {
          test: /\.css$/,
          use: [
            isProduction ? MiniCssExtractPlugin.loader : 'style-loader',
            'css-loader',
            'postcss-loader'
          ]
        },
        {
          test: /\.(png|jpg|jpeg|gif|ico)$/i,
          type: 'asset/resource',
          generator: {
            filename: 'assets/img/[name].[hash][ext]'
          }
        },
        {
          test: /\.svg$/,
          type: 'asset/resource',
          generator: {
            filename: 'assets/img/[name].[hash][ext]'
          }
        },
        {
          test: /\.(woff|woff2|eot|ttf|otf)$/i,
          type: 'asset/resource',
          generator: {
            filename: 'assets/fonts/[name].[hash][ext]'
          }
        }
      ]
    },
    plugins: [
      new CleanWebpackPlugin(),
      new HtmlWebpackPlugin({
        template: './index.html',
        minify: isProduction ? {
          collapseWhitespace: true,
          removeComments: true,
          removeRedundantAttributes: true,
          removeScriptTypeAttributes: true,
          removeStyleLinkTypeAttributes: true,
          useShortDoctype: true
        } : false
      }),
      isProduction && new MiniCssExtractPlugin({
        filename: 'assets/css/[name].[contenthash].css'
      }),
      new CopyPlugin({
        patterns: [
          { from: 'robots.txt', to: '' },
          { from: 'sitemap.xml', to: '' },
          { from: 'manifest.json', to: '' },
          { from: '.htaccess', to: '' },
          { from: 'assets/img', to: 'assets/img' }
        ]
      }),
      isProduction && new WorkboxPlugin.GenerateSW({
        clientsClaim: true,
        skipWaiting: true,
        maximumFileSizeToCacheInBytes: 5 * 1024 * 1024, // 5MB
        runtimeCaching: [
          {
            urlPattern: /\.(?:png|jpg|jpeg|svg|gif|ico)$/,
            handler: 'CacheFirst',
            options: {
              cacheName: 'images',
              expiration: {
                maxEntries: 60,
                maxAgeSeconds: 30 * 24 * 60 * 60 // 30 dias
              }
            }
          },
          {
            urlPattern: /\.(?:css|js)$/,
            handler: 'StaleWhileRevalidate',
            options: {
              cacheName: 'static-resources',
              expiration: {
                maxEntries: 30,
                maxAgeSeconds: 7 * 24 * 60 * 60 // 7 dias
              }
            }
          },
          {
            urlPattern: /^https:\/\/cdn\.jsdelivr\.net\//,
            handler: 'StaleWhileRevalidate',
            options: {
              cacheName: 'cdn-resources',
              expiration: {
                maxEntries: 20,
                maxAgeSeconds: 14 * 24 * 60 * 60 // 14 dias
              }
            }
          },
          {
            urlPattern: /^https:\/\/unpkg\.com\//,
            handler: 'StaleWhileRevalidate',
            options: {
              cacheName: 'unpkg-resources',
              expiration: {
                maxEntries: 20,
                maxAgeSeconds: 14 * 24 * 60 * 60 // 14 dias
              }
            }
          },
          {
            urlPattern: /^https:\/\/cdnjs\.cloudflare\.com\//,
            handler: 'StaleWhileRevalidate',
            options: {
              cacheName: 'cdnjs-resources',
              expiration: {
                maxEntries: 20,
                maxAgeSeconds: 14 * 24 * 60 * 60 // 14 dias
              }
            }
          }
        ]
      })
    ].filter(Boolean),
    optimization: {
      minimizer: [
        new TerserPlugin({
          terserOptions: {
            format: {
              comments: false,
            },
            compress: {
              drop_console: isProduction,
            },
          },
          extractComments: false,
        }),
        new CssMinimizerPlugin()
      ],
      splitChunks: {
        chunks: 'all',
        cacheGroups: {
          vendor: {
            test: /[\\/]node_modules[\\/]/,
            name: 'vendors',
            chunks: 'all'
          }
        }
      }
    },
    performance: {
      hints: isProduction ? 'warning' : false,
      maxAssetSize: 512000, // 500KB
      maxEntrypointSize: 512000 // 500KB
    }
  };
};