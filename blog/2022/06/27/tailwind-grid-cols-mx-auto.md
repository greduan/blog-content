---
title: Tailwind, using grid-cols-12 instead of mx-auto
layout: blogpost
date: 2022-06-27
---

## The problem
You want to layout your content in columns, in such a way that the column stays in the middle, and its size increases reduces as the screen gets smaller, until the screen gets small enough (goes mobile) that the content should take up the full width of the page.

## mx-auto
In Tailwind, `mx-auto` translates to the following:
```css
margin-left: auto;
margin-right: auto;
```
`m` stands for `margin`, `x` stands for the `x` (horizontal) axis.

It's an age-old trick to put an object in the middle of the screen, on the X axis, given it has a set width.

This has an issue though.

If you have two bits of content, let's say for example you have your hero header, and your body content, and they're of different widths, then they won't align with each other.

Let's say the hero is smaller than the content, because it's just a short tagline.

Your hero will be in the middle of the page, while your content will be more left towards the window, as it's wider.

## A grid layout
The idea of grids is, if you can imagine 12 columns, that go from the left of your website to the right of your website.

And then aligning your content along those 12 columns.

That'd be a grid layout.

You can read [online](https://www.google.com/search?hl=en&q=12%20column%20grid%20layout) to see a variety of examples of how this looks like. So you can visualize it.

## What you actually want
You want your hero's tagline, and your content, both to align on the same "edge" on the left side of the page, regardless of the page size.

This is more visually appealing, and more logical in terms of how or brain processes information, thanks to us being used to print.

## What it looks like
### mx-auto
![](https://s3.eu-west-2.amazonaws.com/greduan.com/tailwind-grid-cols-mx-auto/mx-auto.gif)

### grid-cols-12
![](https://s3.eu-west-2.amazonaws.com/greduan.com/tailwind-grid-cols-mx-auto/grid-cols-12.gif)

## grid-cols-12
```jsx
import React from 'react';  
import PropTypes from 'prop-types';  
import classNames from 'classnames';  
  
export const Content = ({ children, className }) => (  
  <div className={classNames('w-full grid grid-cols-12', className)}>  
    <div className="col-span-0  md:col-span-1  lg:col-span-2"></div>  
    <div className="col-span-12 md:col-span-10 lg:col-span-8">{children}</div>  
    <div className="col-span-0  md:col-span-1  lg:col-span-2"></div>  
  </div>  
);  
  
Content.propTypes = {  
  children: PropTypes.node,  
  className: PropTypes.string,  
};
```

What I'm doing here is:

- Making sure we take the full width of our parent container with `w-full`.
- Defining a basic 12 column grid with `grid grid-cols-12`.
- As its content, defining 3 divs, a "left" div, a "middle", content div, and a "right" div.
- To the left/middle/right columns, giving them breakpoints to take up different amounts of columns depending on the size of the screen. We do this with [col-span-n](https://tailwindcss.com/docs/grid-column).

You can adjust the specific sizes for your own use case and website, but in my case what I'm doing is basically the following:

By default (mobile), the left columns will take up no space at all, and the content will take up the full width.

Then when we get to the medium screen size, we want the sides to each take up one column width, and the content to take 10 column widths.

When we get to larger screens, we want the sides to take 2 column widths each, and the content to take 8 column widths.

Each of these configurations each add up to 12 columns.
