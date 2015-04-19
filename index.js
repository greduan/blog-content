'use strict'

var Metalsmith = require('metalsmith'),
	md = require('metalsmith-markdown'),
	temp = require('metalsmith-templates')

var ms = Metalsmith(__dirname)
.source('./_posts')
.destination('./_site')
.use(md())
.use(temp({
	engine: 'swig',
	directory: './_layouts'
}))
.build(function (err) {
	if (err) {
		throw err;
	}
})
