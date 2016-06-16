'use strict'

var Metalsmith = require('metalsmith'),
  drafts = require('metalsmith-drafts'),
  markdown = require('metalsmith-markdown-remarkable'),
  layouts = require('metalsmith-layouts'),
  path = require('metalsmith-path'),
  collections = require('metalsmith-collections'),
  watch = require('metalsmith-watch');

Metalsmith(__dirname)
  .source('src')
  .destination('_site')
  .use(drafts())
  .use(collections({
    posts: {
      sortBy: 'date',
      reverse: true,
    },
  }))
  .use(markdown('commonmark'))
  .use(path())
  .use(layouts({
    engine: 'atpl',
    partials: 'partials',
  }))
  .use(watch({
    paths: {
      '${source}/**/*': true,
      'layouts/**/*': '**/*',
      'partials/**/*': '**/*',
    },
    livereload: false,
  }))
  .build(function (err) {
    if (err) {
      throw err;
    }
  });
