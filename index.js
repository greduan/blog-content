'use strict'

var Metalsmith = require('metalsmith'),
	md = require('metalsmith-markdown')

var ms = Metalsmith(__dirname)
.use(md())
.build(function (err) {
	if (err) {
		throw err;
	}
})
