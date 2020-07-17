const webpack = require('webpack')
const CssExtract = require('mini-css-extract-plugin')

module.exports = {
  mode: 'development',
  entry: {
    app: './assets/entries/app.js'
  },
  output: {
    path: __dirname + '/../../web/assets',
    filename: '[name].js',
    publicPath: '/assets/',
    jsonpFunction: 'songclip-plus'
  },
  module: {
    rules: [
      {
        test: /\.scss$/,
        use: [CssExtract.loader, 'css-loader', 'sass-loader']
      },
      {
        test: /\.png$/,
        use: {
          loader: 'file-loader',
          options: {
            name: '[name].[ext]'
          }
        }
      }
    ]
  },
  plugins: [
    new CssExtract({
      filename: '[name].css'
    })
  ]
}