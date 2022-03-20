---
title: Generating a Swagger file from ASP.Net Core and generating API code for Angular
layout: blogpost
date: 2022-03-20
---

If you ever read The Pragmatic Programmer, you'll be familiar with the concept of Code Generation.  It has a section dedicated to it.

In order to avoid writing a bunch of front end code over and over, just to reflect the models and endpoints the back end provides, you can generate it all automatically.

This tutorial will be divided in two sections, the back end section and the front end section.

This tutorial will use C# ASP.Net Core for the back end framework, and Angular for the front end.

## Back End (ASP.Net Core)

When you generate a new web application project with Rider it actually already includes Swagger for you in the project, using SwashBuckle.  But it doesn't generate any files that you can use outside the server's code.

The aim is to generate a `swagger.json` file, which we will use later for the front end code.  AND, we want to generate it automatically, without having to run extra commands.

To achieve this we will generate the `swagger.json` file at build time.

I'll be targeting framework net6.0, lang version 10.  Reason for this is that it's the solution I found to assembly version mismatches.

The commands you need to run are:

```shell
# cd MySolution
dotnet new tool-manifest
dotnet tool install SwashBuckle.AspNetCore.Cli
```

What this will achieve is make the SwashBuckle CLI tools from the context of the solution.

You will want to make a directory for your Swagger-generated files.

```shell
mkdir -p swagger/v1
```

Next, open up your `.csproj` file and make sure the following lines are present:

```xml
<Target Name="OpenAPI" AfterTargets="Build">
    <Exec Command="dotnet swagger tofile --output ./swagger/v1/swagger.yaml --yaml $(OutputPath)$(AssemblyName).dll v1" WorkingDirectory="$(ProjectDir)" />
    <Exec Command="dotnet swagger tofile --output ./swagger/v1/swagger.json $(OutputPath)$(AssemblyName).dll v1" WorkingDirectory="$(ProjectDir)" />
</Target>
```

What this will achieve is that after your solution builds it will generate a couple Swagger files, `swagger.json` and `swagger.yaml`.  In reality you only need the JSON version for the purposes of this tutorial.

While you're at it, make sure your `Swashbuckle.AspNetCore` version is 6.3.0.

And that should be it.  If it's working, when you build your project you should find out that you have a `swagger.json` and `swagger.yaml` in your `swagger/v1/` folder.

## Front end (Angular)

We're going to use a project named [ng-openapi-gen](ng-openapi-gen) to generate the front end models and services, based on the `swagger.json` file.  And we'll use [chokidar-cli] to run ng-openapi-gen automatically whenever the `swagger.json` file changes.

[ng-openapi-gen]: https://www.npmjs.com/package/ng-openapi-gen
[chokidar-cli]: https://www.npmjs.com/package/chokidar-cli

So first, we configure ng-openapi-gen via the `ng-openapi-gen.json` file, we put that in our front end project's root dir:

```json
{
  "$schema": "node_modules/ng-openapi-gen/ng-openapi-gen-schema.json",
  "input": "../server/MySolution/MySolution.Web/swagger/v1/swagger.json",
  "output": "src/app/api",
  "ignoreUnusedModels": false
}
```

And now for the tooling side of things:

```shell
yarn add -D ng-openapi-gen chokidar-cli
```

And to your npm scripts, you need to add:

```json
{
  "swagger": "ng-openapi-gen",
  "swagger:watch": "chokidar '../server/MySolution/MySolution.Web/swagger/v1/swagger.json' -c 'npm run swagger'"
}
```

Now you can automatically generate front end code, and stop writing the same code over and over.

![ng-openapi-gen resulting folders](https://s3.eu-west-2.amazonaws.com/greduan.com/generating-models-and-api-services-for-angular-from-aspnetcore/ng-openapi-gen-result.PNG)

## Misc.

My `.gitignore` includes these lines for the back end:

```
ShareAFile.Web/swagger/
ShareAFile.Web/swagger/v1/.keepme
```

And for the front end:

```
src/app/api/
```

## In conclusion

With the above the back end's code is used as the source for the `swagger.json` file, and the front end automatically generates code you can use to access those endpoints, and with TypeScript types to go along with it, so you're all typed up.
