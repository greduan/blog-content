---
title: Managing sync state
layout: blogpost
date: 2022-06-29
---

Whenever your application needs to fetch data, allow the user to manipulate it, and then allow the user to sync it back to the system it fetched it from, there is a simple pattern you can apply to keep track of the state of the data.

![](https://s3.eu-west-2.amazonaws.com/greduan.com/managing-sync-state/sync-state-flow.png)

[Mermaid source](https://gist.github.com/greduan/d1bbd2d5314e953cc36dcdc128a47101)

In essence you'd have the following possible states:

1. Fetched. Fresh off the oven.
2. Draft. Contains changes but hasn't been synced back.
3. Synced. The content has been written back to the external system.

Your app might not use the Draft state, in which case you only need states 1 and 3.

## Error handling
If there are errors writing back to the external system, the state field of the data doesn't change, but we write back an error to the database.

The front end, if it finds an error, it displays that error.

If there is success syncing back, the error in the database is set to null, to remove the error from the front end.
