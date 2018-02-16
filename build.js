const path = require('path')
const Metalsmith = require('metalsmith')
const collections = require('metalsmith-collections')
const markdown = require('metalsmith-markdown')
const layouts = require('metalsmith-layouts')
const mPath = require('metalsmith-path')

Metalsmith(__dirname)
  .source(path.resolve(__dirname, 'src'))
  .destination(path.resolve(__dirname, 'dist'))
  .clean(true)
  .use(markdown())
  // .use(collections({
  //   posts: 'blog/*.html',
  // }))
  // .use(layouts({
  //   engine: 'handlebars',
  // }))
  // .use(mPath({
  //   baseDirectory: '/',
  // }))
  .build(err => {
    if (err) {
      throw err
    }
  })
