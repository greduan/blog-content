'use strict'

var Metalsmith = require('metalsmith'),
	md = require('metalsmith-markdown'),
	temp = require('metalsmith-templates')

var ms = Metalsmith(__dirname)
.source('./src')
.destination('./_site')
.use(md())
.use(temp({
	engine: 'swig',
	directory: 'templates'
}))
.build(function (err) {
	if (err) {
		throw err;
	}
})
