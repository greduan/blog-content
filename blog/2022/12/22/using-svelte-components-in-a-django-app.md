---
title: Using Svelte components in a Django app
layout: blogpost
date: 2022-12-22
---

I've found guides on how to have SPAs with Django as the back end. And a couple
other variations.

But I haven't found a guide on how to integrate individual Svelte components
into Django. Not to run the app, but rather to *enhance* the app.

Note this guide doesn't include how to include CSS/Tailwind styles. There will
be a follow up guide for that.

## The short version

```shell
django-admin startproject mysite
cd mysite
mkdir svelte
pnpm init
pnpm i svelte
pnpm i -D @rollup/plugin-node-resolve @rollup/plugin-typescript rollup
rollup-plugin svelte typescript
touch rollup.config.js .gitignore
```

The .gitignore file:

```text
node_modules/
static/
```

The rollup.config.js file:

```javascript
const svelte = require('rollup-plugin-svelte');
const resolve = require('@rollup/plugin-node-resolve');

const componentRollupConfig = (src, dest, name) => ({
  input: src,
  output: {
    file: dest,
    format: 'iife',
    name: name,
  },
  plugins: [
    svelte({
      include: 'src/**/*.svelte',
    }),
    resolve({ browser: true }),
  ],
});

module.exports = [
  componentRollupConfig('src/SlimeChat.svelte', 'static/js/svelte/SlimeChat.js', 'SlimeChat'),
];
```

Your mysite/settings.py file, you need to add to your `STATICFILES_DIRS` the
following value:

```python
STATICFILES_DIRS = [
    ...
    BASE_DIR / 'svelte/static',
    ...
]
```

Your package.json scripts:

```json
{
  "scripts": {
    "build": "rollup --config",
    "dev": "rollup --config --watch"
  }
}
```

The example quick usage in your Django template:

```html
{% csrf_token %}
<div id="chat"></div>

{% load static %}
<script src="{% static 'js/svelte/SlimeChat.js' %}"></script>
<script>
  const csrfToken = document.querySelector('input[name="csrfmiddlewaretoken"]').value;
  const app = new SlimeChat({
    target: document.getElementById('chat'),
    props: {
      csrfToken,
      slimeName: '{{ slime.name }}',
      slimeId: '{{ slime.id }}',
    },
  });
</script>
```

That should get you kickstarted, and you can figure out the details yourself if
any are missing, but I believe that's all. Of course you'll need to create that
`SlimeChat.svelte` file 🙂

## The longer version

Actually the short version covers most of the points that you need to be aware
of, with all the connecting points.

But I wanted to provide some context, explain what's happening in a couple of
the steps.

### The approach

The idea is to create a single .js file per entry file. Each one of these
entries would be an "app", a component instantiated and attached to a DOM
element.

### rollup.config.js

Essentially what we need is Rollup to generate an individual file per entry. For
this we basically need to duplicate the configuration for each file.

In order to duplicate the config, without repeating ourselves, we create a
function to generate the same config just with different params (like the entry
and output paths).

That's what the `componentRollupConfig(src, dest, name)` function is for.

### The CSRF token

If you want to make any queries to the Django backend, you'll be needing the
CSRF token. Since we can't put it in Svelte, we have to generate it via the
Django template and then grab that value via JS, and pass that to the Svelte
component.

I did that above via the following JS:

```javascript
const csrfToken = document.querySelector('input[name="csrfmiddlewaretoken"]').value;
```

Which you can then pass into the Svelte component.

### The Svelte component's usage

Actually the component's usage is nothing special.

You need a DOM element to attach the component to, that's this part of the HTML:

```html
<div id="chat"></div>
```

You need to include the JS file for your component:

```html
<script src="{% static 'js/svelte/SlimeChat.js' %}"></script>
```

And the Svelte component usage is just:

```javascript
const app = new SlimeChat({
  target: document.getElementById('chat'),
  props: {
    csrfToken,
    slimeName: '{{ slime.name }}',
    slimeId: '{{ slime.id }}',
  },
});
```

Of course I included some Django templating, because I need to grab the data
from the back end, but you can do that in any which way you like.

As you can see it's a similar usage to when you are creating a Svelte SPA.

## In conclusion

Using Svelte inside a Django app to *enhance* it instead of replace it, is
actually rather simple.

The main points are:

- Create a folder for the Svelte components
- Create a Rollup config for each individual component you'll be using
- Make the statically generated files available to Django
- Include the file in the HTML
- Instantiate the component into a DOM element

Very simple if you know what you're going for.

I will write a follow up guide on how to include styles for your Svelte
components, including Tailwind styles.
