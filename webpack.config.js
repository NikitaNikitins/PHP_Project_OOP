var path = require('path')
var webpack = require('webpack')
//const UglifyJsPlugin = require("uglifyjs-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const {
    VueLoaderPlugin
} = require('vue-loader')
//const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");

module.exports = {
    entry: {
        common: [
            "jquery",
            "bootstrap-loader",
            'event-source-polyfill',
            'vue',
            'axios',
            'vue-router',
            "main.js"
        ]
    },
    output: {
        path: path.resolve(__dirname, './dist'),
        publicPath: '/dist/',
        filename: 'build.js'
    },
    module: {
        rules: [{
                parser: {
                    amd: false
                }
            },
            {
                test: /\.(sc|c)ss$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    {
                        loader: "css-loader",
                        options: {
                            sourceMap: true
                        }
                    },
                    {
                        loader: "postcss-loader",
                        options: {
                            sourceMap: true
                        }
                    },
                    {
                        loader: "resolve-url-loader",
                        options: {
                            sourceMap: true
                        }
                    },
                    {
                        loader: "sass-loader",
                        options: {
                            sourceMap: true
                        }
                    }
                ]
            },
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            },
            {
                test: /\.js$/,
                loader: 'babel-loader',
                exclude: /node_modules/
            },
            // copy images and fonts from source folder into output directory
            {
                test: /\.(png|jpg|ico|woff2?|svg|ttf|eot|otf|)$/,
                exclude: /public\\components\\svg\\*/,
                use: [{
                    loader: "url-loader",
                    options: {
                        limit: 1000,
                        name: "assets/[path][name].[ext]"
                    }
                }]
            },
            // JS linter
            {
                test: /\.js$/,
                include: /public/,
                use: [{
                    loader: "eslint-loader",
                    options: {
                        configFile: path.join(__dirname, ".eslintrc")
                    }
                }],
                enforce: "pre"
            },
            //vue-svg-loader
            {
                test: /\.svg$/,
                loader: 'vue-svg-loader',
                options: {
                    svgo: {
                        plugins: [{
                            removeDoctype: true
                        }, {
                            removeComments: true
                        }]
                    }
                }
            }
        ]
    },
    resolve: {
        symlinks: false, //required for "npm link" to work
        modules: ['public', 'node_modules'],
        extensions: ['.js', '.vue'],
        alias: {
            vue: 'vue/dist/vue.js',
            'components': path.resolve(__dirname, './public/components')
        }
    },

    optimization: {
        splitChunks: {
            chunks: 'async'
        }
    },

    devServer: {
        historyApiFallback: true,
        noInfo: true,
        overlay: true
    },
    performance: {
        hints: false
    },
    devtool: '#eval-source-map',

    plugins: [
        new VueLoaderPlugin(),
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery'
        }),
        new MiniCssExtractPlugin({
            filename: "build.css",
            chunkFilename: "build.css"
        }),
        new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/)
    ]
}

if (process.env.NODE_ENV === 'production') {
    module.exports.mode = 'production';
    module.exports.devtool = '#source-map';
    // http://vue-loader.vuejs.org/en/workflow/production.html
    const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
    module.exports.plugins = (module.exports.plugins || []).concat([
        new webpack.DefinePlugin({
            'process.env': {
                NODE_ENV: '"production"'
            }
        }),
        new UglifyJsPlugin({
            uglifyOptions: {
                warnings: false,
                ie8: false,
                output: {
                    comments: false
                }
            }
        }),
        new webpack.LoaderOptionsPlugin({
            minimize: true
        })
    ])
}
