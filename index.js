'use strict'

var Metalsmith = require('metalsmith'),
  drafts = require('metalsmith-drafts'),
  markdown = require('metalsmith-markdown-remarkable'),
  layouts = require('metalsmith-layouts'),
  path = require('metalsmith-path'),
  collection = require('metalsmith-collections'),
  watch = require('metalsmith-watch');

Metalsmith(__dirname)
  .source('./src')
  .destination('./_site')
  .use(drafts())
  .use(markdown())
  .use(path())
  .use(layouts({
    engine: 'swig',
    directory: 'templates',
  }))
  .use(watch({
    paths: {
      '${source}/**/*': true,
      'templates/**/*': '**/*',
    },
    livereload: false,
  }))
  .build(function (err) {
    if (err) {
      throw err;
    }
  });
