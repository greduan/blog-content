---
title: Adding TailwindCSS to Svelte components in a Django app
layout: blogpost
date: 2022-12-26
---

This is a follow-up guide for how to add Tailwind styles to your Svelte
components in your Django app.  You can also read part one which is about [how
to add the Svelte components to your Django app][part-1] in the first place.

[part-1]: https://greduan.com/blog/2022/12/22/using-svelte-components-in-a-django-app

We essentially use Rollup for that Svelte setup, so we need to make sure that
our Tailwind classes are detected within the Svelte files and the resulting CSS
is injected in the JS files generated for the Svelte components.

**[There is a new guide updated for Svelte v4.][part-3]**

[part-3]: https://greduan.com/blog/2023/08/07/svelte-v4-in-django-using-webpack

## The short version

```shell
cd mysite/svelte
pnpm i -D tailwindcss postcss rollup-plugin-postcss autoprefixer
```

The rollup.config.js file:

```javascript
const postcss = require('rollup-plugin-postcss');

// ...
{
  plugins: [
    postcss({
      plugins: {
        'tailwindcss/nesting': {},
        tailwindcss: {},
        autoprefixer: {},
      },
    }),
    // ... Svelte
  ],
}
// ...
```

Got that info from the [Tailwind docs][docs], which also include instructions
on how to integrate with SCSS, etc., but no instructions for Rollup
specifically.

[docs]: https://tailwindcss.com/docs/using-with-preprocessors
