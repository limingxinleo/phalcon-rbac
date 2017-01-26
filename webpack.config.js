/**
 * Created by limx on 2017/1/26.
 */
var webpack = require('webpack');
module.exports = {
    entry: {
        main: __dirname + "/asset/main.js",
        vendor: ["jquery", "bootstrap"]
    },//已多次提及的唯一入口文件
    output: {
        path: __dirname + "/public",//打包后的文件存放的地方
        filename: "[name].js"//打包后输出文件的文件名
    },
    plugins: [
        new webpack.optimize.CommonsChunkPlugin({
            names: ['vendor']
        })
    ]
}