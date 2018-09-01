---
title: Assigning variables, cognitive load
layout: post.hbs
date: 2018-09-01
---

Something I see I have to point out during code reviews with some degree of
frequency is the concept of code layout and how it affects cognitive load.

I don't remember where I learnt this originally, but it was probably
a combination of articles and it was some time ago, it would thus be hard to
give you a list of sources.

But here is the basic concept of it.

First let's define cognitive load, to be clear.  In this case when I say
cognitve load I'm referring to how many things I have to keep in mind to
understand how a piece of code will be interpreted by the computer.  So there is
some degree of cognitive load I need to have, like which file I'm in, which
function, the function arguments etc.

But, there are things a programmer can do to worsen the cognitive load, and
reversely, to improve it.

In this post we'll explore just variables.  The simple ways in which you can
improve cognitive load by simply using less variables.

Let's start with an easy example:

```javascript
const something = process(data);
return {
  something,
};
```

That is easily refactored to:

```javascript
return {
  something: process(data),
};
```

Why is that better?  Because there is no need for my eyes or my mind to jump
around.  At no point do I need to remember what `something` was assigned to.
It's just there.

Now in that example it happens to be obvious.  Let's look at another example
that is more problematic.

```javascript
const process = data => {
  const partOfTheData = extract(data);

  // 20 lines of code here, partOfTheData is not used..

  const someDataWeJustFetched = await fetch(...);
  const secondPartOfData = extract(someDataWeJustFetched);

  // 20 lines of code here, partOfTheData is not used..

  return {
    // other stuff ...,
    partOfTheData,
    secondPartOfTheData,
  };
};
```

That one may not seem so evil, but it is the same idea.  It could be improved
as:

```javascript
const process = data => {
  // 20 lines of code here.

  const someDataWeJustFetched = await fetch(...);

  // 20 lines of code here.

  return {
    // other stuff ...,
    partOfTheData: extract(data),
    secondPartOfData: extract(someDataWeJustFetched),
  };
};
```

Now that assumes that somehow `someDataWeJustFetched` is used in those 20 lines
of code or something, otherwise we can do even this:

```javascript
const process = data => {
  // 40 lines of code here.

  return {
    partOfTheData: extract(data),
    secondPartOfData: extract(await fetch(...)),
  };
};
```

You see?

The basic concept is as follows:

1. If you can get away with not defining a variable, consider not defining it.
2. Use the direct value instead of a variable where possible.
3. If you must use a variable, define them as close to their usage as possible.

_Note: The following section is not really convincing with its example, so I
want you to think about the point I'm making as opposed to the exact example
I'm showcasing. :)_

Now, somebody will be sharp enough to notice that these examples don't apply to
duplication.  What about deduplication?  I use one variable several times?

Then the conditions change.

Now I swear I read this in an article pointing this out, but I can't find it so
I'll do my best to present the argument.

Let's say you have a function which takes in an argument and returns a result
from it.  At some point, the input has to be squared and it's used in several
spots.

```javascript
const getSomeNumber = inNumber => {
  const squared = inNumber * 2;

  // <use of squared>
  // 20 lines of code.
  // <use of squared>

  return result;
};
```

In that case, when reading the instances where you use the `squared` variable,
you're introducing cognitive load.  Why?

For a simple matter that when I read `squared` I _have to remember what it
means_, no matter how simple, I have to remember.

Perhaps you'd be better served to use `inNumber * 2` several times instead.
Following point number 2 above.

"But doesn't that break Don't Repeat Yourself?" I hear you say.  And the answer
is actually yes.  But duplication in and of itself is not evil.  It's stupid
duplication that is.  And in this case, squared is always squared.  It takes the
same amount of effort to search and replace `squared` with `newValue` than
`inNumber * 2` with `newValue`.  But the latter is easier to read.

That's all my thoughts on that subject.  Hopefully you learnt something, or at
least I got you thinking.
