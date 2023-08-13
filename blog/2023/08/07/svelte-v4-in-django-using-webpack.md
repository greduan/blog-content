---
title: Svelte v4 In Django Using Webpack
layout: blogpost
date: 2023-08-07
---

December last year I wrote a blog post for [using Svelte components in a Django app using Rollup](https://greduan.com/blog/2022/12/22/using-svelte-components-in-a-django-app) which was cool, but with the latest version of Svelte, Svelte 4, it stopped working.

This blog post adds on to that one.

It always produces code like this:

```javascript
(function (internal) {
  // ...
})(internal);
```

Where of course `internal` isn't defined in the global scope. So that approach no longer works.

So I come back with a solution using Webpack.

It supports TypeScript and Svelte. It extracts the basic CSS styles as well, from the `<style></style>` tags in your Svelte files.

## Tailwind

_It does not compile Tailwind styles._

Your Django setup, will compile these for you, just add your `**/*.svelte` files to the Tailwind config.

So in my config it looks something like:

```
module.exports = {
    content: [
        ...
        '../../**/*.svelte',
        ...
    ],
    theme: {
        ...
    },
    plugins: [
        ...
    ],
}

```

Although that setup doesn't understand `@apply` calls within the `<style></style>` tags in your Svelte components. For that you will have to update the Webpack config.

## The Webpack setup

The `webpack.config.js`:

```javascript
const path = require('path');  
const sveltePreprocess = require('svelte-preprocess');  
  
module.exports = {  
  mode: 'development',  
  devtool: 'eval-source-map',  
  entry: './src/demo.ts',  
  module: {  
    rules: [  
      {  
        test: /\.tsx?$/,  
        use: 'ts-loader',  
        exclude: /node_modules/,  
      },  
      {  
        test: /\.(html|svelte)$/,  
        use: {  
          loader: 'svelte-loader',  
          options: {  
            preprocess: sveltePreprocess(),  
          },  
        },  
      },  
      {  
        // required to prevent errors from Svelte on Webpack 5+  
        test: /node_modules\/svelte\/.*\.mjs$/,  
        resolve: {  
          fullySpecified: false  
        }  
      },  
    ],  
  },  
  resolve: {  
    extensions: ['.tsx', '.ts', '.js', '.svelte'],  
    mainFields: ['svelte', 'browser', 'module', 'main'],  
    conditionNames: ['svelte', 'browser'],  
    alias: {  
      svelte: path.resolve('node_modules', 'svelte/src/runtime'),  
    },  
  },  
  output: {  
    path: path.resolve(__dirname, 'static', 'js', 'svelte'),  
    filename: 'demo.js',  
    chunkFilename: 'demo.[id].js',  
  },  
};
```

Of course adjust for your own needs.

The `tsconfig.json` I came to:

```json
{  
  "compilerOptions": {  
    "outDir": "./static/js/svelte/",  
    "noImplicitAny": true,  
    "module": "es6",  
    "target": "es6",  
    "allowJs": true,  
    "moduleResolution": "node",  
    "types": [  
      "svelte"  
    ]
  },  
  "extends": "@tsconfig/svelte/tsconfig.json"  
}
```

And the required dependencies, I share with you the `pnpm` command:

```shell
pnpm i -D @tsconfig/svelte svelte svelte-loader svelte-preprocess ts-loader typescript webpack webpack-cli 
```

To run this of course you'd use simply `npx webpack` or `webpack` in one of your scripts, I suggest you use `--watch`, so I have something like this in my `package.json`:

```json 
"scripts": {  
  "build": "webpack",  
  "watch": "webpack --watch"  
}
```

I hope that's useful, and it brings some value for you.