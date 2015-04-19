'use strict'

var Metalsmith = require('metalsmith'),
	md = require('metalsmith-markdown'),
	temp = require('metalsmith-templates'),
	path = require('metalsmith-path'),
	coll = require('metalsmith-collections')

var ms = Metalsmith(__dirname)
.source('./src')
.destination('./_site')
.use(md())
.use(path())
.use(coll({
	posts: {
		patterh: '*.html',
		sortBy: 'date',
	}
}))
.use(temp({
	engine: 'swig',
	directory: 'templates',
}))
.build(function (err) {
	if (err) {
		throw err
	}
})
