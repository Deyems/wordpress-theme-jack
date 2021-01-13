const path = require( 'path' );
const config = {
    entry: './app/index.js',
    mode: 'development',
    output: {
        filename: 'bundle.js',
        path: path.resolve( __dirname, 'dist' ),
    },
    module: {
        rules: [
            {
                use: 'babel-loader',
                test: /\.js$/
            }
        ]
    },
}

module.exports = config;