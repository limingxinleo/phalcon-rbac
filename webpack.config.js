/**
 * Created by limx on 2017/1/26.
 */
var webpack = require('webpack');
var ExtractTextPlugin = require("extract-text-webpack-plugin");
module.exports = {
    entry: {
        main: __dirname + "/asset/main.js",
        vendor: ["jquery", "bootstrap"]
    },//已多次提及的唯一入口文件
    output: {
        path: __dirname + "/public",//打包后的文件存放的地方
        filename: "[name].js"//打包后输出文件的文件名
    },
    module: {
        loaders: [
            {
                test: /\.css$/,
                loader: ExtractTextPlugin.extract("style-loader", "css-loader")
            },
            {
                test: /\.scss$/,
                loader: "style!css!sass"
            },
            {
                test: /\.less$/,
                loader: "style!css!less"
            },
            {
                test: /\.(eot|woff|ttf|woff2)$/, loader: "file-loader"
            },
            {
                test: /\.svg$/, loader: 'svg-loader'
            },
        ]
    },
    plugins: [
        new webpack.optimize.CommonsChunkPlugin({
            names: ['vendor']
        }),
        new ExtractTextPlugin("styles.css"),
    ]
}