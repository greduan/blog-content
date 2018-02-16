'use strict'

var metalsmith = require('metalsmith'),
  drafts = require('metalsmith-drafts'),
  markdown = require('metalsmith-markdown-remarkable'),
  layouts = require('metalsmith-layouts'),
  path = require('metalsmith-path'),
  collections = require('metalsmith-collections'),
  feed = require('metalsmith-feed'),
  watch = require('metalsmith-watch');

metalsmith(__dirname)
  .source('src')
  .destination('_site')
  .metadata({
    site: {
      title: 'Greduan\'s Blog',
      url: 'http://blog.greduan.com',
      author: 'Eduardo Lavaque',
    },
  })
  .use(drafts())
  .use(collections({
    posts: {
      sortBy: 'date',
      reverse: true,
      refer: false,
    },
  }))
  .use(markdown('commonmark'))
  .use(path())
  .use(feed({
    collection: 'posts',
    limit: false,
  }))
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
