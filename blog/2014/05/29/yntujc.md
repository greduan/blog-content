---
title: You need to understand JavaScript callbacks
layout: blogpost
date: 2014-05-29
---

**Notice: This post is irrelevant nowadays, had I learnt JS data and objects
correctly since the beginning this wouldn't have been a real problem.  Promises
are WAY better anyway.**

Here I will share something I realized I learnt only after learning it.  That is
the fact that if you want to program fluently in JS you need to understand and
know by heart JavaScript's callbacks.

I do want to point out that I did know callbacks were important, but I didn't
realize just how powerless you are when programming in JS and you don't know
your callbacks.

So that's the lesson I've learned.  Now I'm going to teach to you what callbacks
are.

Let's start with the definition of callback, in terms of JS. A "callback" is, in
the simplest of the English language, what to do after the function has been
executed. That is the callback.

So let's look at the code:

``` javascript
function x(a, callback) {
	var b = a + 5;
	return callback(a);
}
```

What that code does is add `a` and `5` and give them to the callback.  So this
function would be used the following way:

``` javascript
x(5, function(bap){
	console.log(bap); // returns 10
});
```

Do you see the connection that is happening?  Before I go on I just want to make
a couple of points.  The callback should be an anonymous function, I'm not sure
if this is required or not but after reading a lot of code this is the only way
that I've seen it, so I'm assuming it's the only way possible.  Please correct
me if I'm wrong.  Secondly, the name of the argument that you use in the
anonymous function can be named anything, also the variable that you give to
callback can be named anything.

OK so to explain what is happening here, it's basically running function `x()`
which is assigning the value of `5 + 5` to a var `b` and that var `b` is being
passed to the callback.  The callback receives the value of `b` and names it
`bap` (in this example) and then logs to the console the value of `bap`.

They're as simple as that, but I never saw an explanation like this.  I did
understand that callbacks were what was done after the function was executed and
the results were available, but I never understood the process that it took in
order to give the anonymous function the value and what values were used by the
anonymous function.

I hope this post helps you understand callbacks, even if just a little.  Please
correct me if I said anything bad or incorrect.
