---
title: Throw Early for Programmer Errors
layout: blogpost
date: 2023-08-27
---

Functions will normally, or at least sometimes, guard against invalid inputs. That might be inputs that are outside of the valid range, or simply checking the inputs exist and so on.

Sometimes the input is hardcoded, the programmer says what the input is, explicitly.

It's not a value from the system that's being passed around.

In those cases, I argue, you should throw early.

Giving the programmer a chance to see it quickly, and fix it quickly, instead of having to debug.

The following diff might illustrate the point. This is a real diff after I hunted the bug down and finally found it.

The `yearKey` variable was set to a name for which there was no Control in the Angular FormGroup, therefore later down in the logic, the validator never actually passes because the value is always undefined (`control?.value == null` always of course).

```diff
diff --git a/client/projects/common/src/lib/model/birthday-validator.ts b/client/projects/common/src/lib/model/birthday-validator.ts
index e535ccad..aab96d20 100644
--- a/client/projects/common/src/lib/model/birthday-validator.ts
+++ b/client/projects/common/src/lib/model/birthday-validator.ts
@@ -35,6 +35,13 @@ export function byYearValidator(
     if (!form) {
       return null;
     }
+    const controls = Object.keys(form.controls);
+    if (!controls.includes(onlyYearFieldKey) || !controls.includes(yearKey)) {
+      // We throw because it's a programmer error, better to catch and fix early
+      throw new Error(
+        `Form does not contain '${onlyYearFieldKey}' FormControl or '${yearKey}' FormControl`,
+      );
+    }
     const onlyYear = form.controls[onlyYearFieldKey]?.value;
     const year = form.controls[yearKey]?.value;
 
@@ -56,6 +63,13 @@ export function byBirthdayValidator(
     if (!form) {
       return null;
     }
+    const controls = Object.keys(form.controls);
+    if (!controls.includes(onlyYearFieldKey) || !controls.includes(birthdayKey)) {
+      // We throw because it's a programmer error, better to catch and fix early
+      throw new Error(
+        `Form does not contain '${onlyYearFieldKey}' FormControl or '${birthdayKey}' FormControl`,
+      );
+    }
     const onlyYear = form.controls[onlyYearFieldKey]?.value;
     const birthday = form.controls[birthdayKey]?.value;
```