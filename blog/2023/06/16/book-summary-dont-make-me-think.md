---
title: "Book Summary: Don't Make Me Think Revisited A Common Sense Approach to Web and Mobile Usability by Steve Krug"
layout: blogpost
date: 2023-06-16
---

These are my private notes about this book.  Hopefully they are interesting and helpful to you as well.

## Navigation

- Main purpose of navigation is to give the user a sense of where they are.
- Every page must have a name, and that name must match the navigation's page as closely as possible.
- Users jump into random links in the middle of the website. Navigation should be there to guide them as to their current location.
	- This is achieved primarily through very clear You Are Here indicators.
	- The You Are Here factor cannot be subtle, it must not be subtle.
- Navigation should be scannable, and give the user a chance to find what they are looking for with only good guesses.
- If using breadcrumbs, only make the last one bold.
- There are a couple exceptions where navigation can get out of the way:
	- Forms
	- Other processes where you don't want to distract the user, and it is unlikely they will leave the process before being finished.
- Preserve the distinction between visited and unvisited links. Gives your users a sense of navigation.

## Homepage

- "What the site is", conveying "the big picture"
- Should answer the following questions:
	- What is this?
	- What do they have here?
	- What can I do here?
	- Why should I be here and not somewhere else?
- In addition, a good indicator of "Where do I start?" is important

Plausible reasons to not make it clear (invalid):

1. We don't need to, it's obvious
2. After people have seen the explanation once, they'll find it annoying
3. Anybody who really needs our site will know what it is
4. That's what our advertising is for

## Usability tests

- "The average user" is a myth. All web use is unique and idiosyncratic.
- We nonetheless treat how we ourselves use the web as religion. And can lead to unproductive arguments about how to best implement a UX.
- The antidote is usability tests. Which will answer the very specific question of UX in a particular scenario.
	- "Does this dropdown, with these items, and this wording, in this context, on this page, create a good experience for most people who are likely to use this site?"
- Usability tests can answer that.
- Guidelines
	- Test early
	- Ideally three users
	- Once a month
	- With a predefined date per month
	- Note down the top usability problems (by how much of a block they cause the user), and tackle those for the following month

## Mobile

- "Managing real estate challenges shouldn’t be done at the cost of usability."

## Accessibility

- Links should have the keywords at the beginning. it’s what blind users scan with. They'll "scan" the first few words and skip to the next link if they don't think it's relevant to them.

## Other

There is the concept of how much good will your users hold towards you at any particular moment.

To increase that, be honest with them. Show them things you’d normally suffer by showing them (e.g. zero hidden costs, in fact making the cost apparent), and you gain their trust. Never hide things.

Users don’t mind clicks as long as they have confidence that it takes them to the right place.

Design/write for scanning, not reading. Users don't read, they scan, until they give up with scanning because they can't find what they want to find.

Explain things to users. They don't mind. E.g. an explanation of what the input will be used for.

## Further reading

Usability testing: Rocket Surgery Made Easy: The Do-It-Yourself Guide to Finding and Fixing Usability Problems by Steve Krug

Screen readers: [Guidelines for Accessible and Usable Web Sites:
Observing Users Who Work With Screen Readers by Janice (Ginny) Redish](https://redish.net/wp-content/uploads/Theorfanos_Redish_InteractionsPaperAuthorsVer.pdf)

Accessibility: A Web for Everyone: Designing Accessible User Experiences by Sarah Horton and Whitney Quesenbery

Accessibility: Web Accessibility: Web Standards and Regulatory Compliance by Jim Thatcher