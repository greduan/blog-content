const path = require('path')
const Metalsmith = require('metalsmith')
const collections = require('metalsmith-collections')
const markdown = require('metalsmith-markdown')
const layouts = require('metalsmith-layouts')
const mPath = require('metalsmith-path')
const drafts = require('metalsmith-drafts')

const fecha = require('fecha')

Metalsmith(__dirname)
  .source(path.resolve(__dirname, 'src'))
  .destination(path.resolve(__dirname, 'public'))
  .clean(true)
  .use(markdown())
  .use(collections({
    blogPosts: {
      pattern: ['blog/*.html', '!blog/index.html'],
      reverse: true,
      refer: false,
    },
  }))
  .use(drafts())
  .use(layouts({
    engine: 'handlebars',
    engineOptions: {
      helpers: {
        formatDate: (date) =>
          `<time datetime="${date}">${fecha.format(date, 'YYYY-MM-DD')}</time>`,
      },
    },
  }))
  .use(mPath({
    baseDirectory: '/',
  }))
  .build(err => {
    if (err) {
      throw err
    }
  })
