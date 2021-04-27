const path = require("path");
const webpack = require("webpack");

//const UglifyJsPlugin = require("uglifyjs-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const { VueLoaderPlugin } = require('vue-loader')
//const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");

const outputPath = path.join(__dirname, "build");

module.exports = {
    mode: 'development',
    devtool: 'inline-cheap-module-source-map',

    entry: {
        common: [
            "jquery",
            "bootstrap-loader",
            'event-source-polyfill',
            'vue',
            'axios',
            'vue-router',
            "main-app.js"
        ]
    },
    output: {
        publicPath: "/build/",
            path: outputPath,
            filename: "[name].js",
            chunkFilename: "[name].js"
    },
    
    module: {
        rules: [
            { parser: { amd: false } },

            // JS linter
            {
                test: /\.js$/,
                include: /public/,
                use: [{
                    loader: "eslint-loader",
                    options: { configFile: path.join(__dirname, ".eslintrc") }
                }],
                enforce: "pre"
            },
            { test: /\.vue$/, loader: 'vue-loader' },
            { test: /\.js$/, include: /public/, loader: "babel-loader" },
            {
                test: /\.(css|scss)/,
                use: [
                    MiniCssExtractPlugin.loader,
                    { loader: "css-loader", options: { sourceMap: true } },
                    { loader: "postcss-loader", options: { sourceMap: true } },
                    { loader: "resolve-url-loader", options: { sourceMap: true } },
                    { loader: "sass-loader", options: { sourceMap: true } }
                ]
            },

            // copy images and fonts from source folder into output directory
            {
                test: /\.(png|jpg|ico|woff2?|svg|ttf|eot|otf|)$/,
                exclude: /public\\components\\svg\\*/,
                use: [
                    {
                        loader: "url-loader",
                        options: {
                            limit: 1000,
                            name: "assets/[path][name].[ext]"
                        }
                    }
                ]
            },

            //vue-svg-loader
            {
                test: /\.svg$/,
                loader: 'vue-svg-loader',
                options: { svgo: { plugins: [{ removeDoctype: true }, { removeComments: true }] } }
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

    plugins: [
        new VueLoaderPlugin(),
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery'
        }),
        new MiniCssExtractPlugin({
            filename: "[name].css",
            chunkFilename: "[name].css"
        }),
        new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/)
    ]
}