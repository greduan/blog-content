---
title: How to run a Promises array in a series
layout: post.hbs
date: 2016-06-17
---

Put the following code in a file and run it with Node.js:

```javascript
var calls = [];

var promises = [
  new Promise(function (resolve) {
    setTimeout(function () {
      calls.push('first');

      resolve();
    }, 100);
  }),
  new Promise(function (resolve) {
    calls.push('second');

    resolve();
  }),
];

setTimeout(function () {
  console.log(calls);
}, 100);
```

Please be aware the following code is bad practice, I'm creating a side-effect
with a Promise, and side-effects like that can be hard to debug.

Why did `calls` have content?  And why was it `['second', 'first']` and not the
other way around?  That's because of how Promises behave, they execute as soon
as the JS engine goes over them, not when you call `.then()` on them, and the
first one runs (approximately) 100ms after the second one because of the
`setTimeout`.

So then, can we somehow run Promises synchronously?  Even if that sorta defeats
the point of Promises?  Yes you can.

You can game the JS engine a bit.

Try running the following:

```javascript
var Promise = require('bluebird');

var calls = [];

var promises = [
  function () {
    return new Promise(function (resolve) {
      setTimeout(function () {
        calls.push('first');

        resolve();
      }, 100);
    });
  },
  function () {
    return new Promise(function (resolve) {
      calls.push('second');

      resolve();
    });
  },
];

Promise
  .each(promises, function (promise) {
    return promise();
  })
  .then(function () {
    console.log(calls);
  });
```

The output is `['first', 'second']`!  How are the Promises running
synchronously?

The answer is simple, first, they are now defined inside function, the
function's contents aren't executed until the function is invoked, which is done
by the `Promise.each`, and the way `Promise.each` works is that if you return a
then-able it will wait until the then-able resolves in order to continue with
the next thing in the loop.

And that's it, because we're not executing the function until the previous
function's output's then-able resolves, the Promises are run in order.

It's a simple yet clever trick.  Many thanks to my coworker
[@pateketrueke][pate] for figuring this stuff out with me.

[pate]: https://twitter.com/pateketrueke
