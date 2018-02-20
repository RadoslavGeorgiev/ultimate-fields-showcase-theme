# Ultimate Fields: Showcase Theme

This theme contains an example of every location and every field that [Ultimate Fields](https://www.ultimate-fields.com/) supports and how to work with them. The theme is not meant to be used as a starter theme, a parent theme or as a framework. It is rather made to showcase all of the functionality of Ultimate Fields and educate developers on how to use it.

If you are not familiar with Ultimate Fields or don't know what it is, please visit our website at [https://www.ultimate-fields.com](https://www.ultimate-fields.com).

At [https://www.ultimate-fields.com/demo/](https://www.ultimate-fields.com/demo/) you can create a personalised demo website of Ultimate Fields, where you see theme in action. Of course, you can also copy the theme to your local development environment in order to experiment with it.

If you are working on an extension for Ultimate Fields, feel free to [create a new module](https://github.com/RadoslavGeorgiev/ultimate-fields-showcase-theme/tree/master/modules#creating-a-module) that shows how to interact with your extension.

## Installation

Before installing the showcase theme locally, please ensure that:

- Your machine has Git (the `git` command) and Node Package Manager (the `npm` command) installed.
- You own a copy of [Ultimate Fields Pro](https://www.ultimate-fields.com/pro). If you use the free version of Ultimate Fields, some of the functionality of the theme will be limited.

Navigate to your wp-content/themes directory and execute the following commands:

```shell
git clone git@github.com:RadoslavGeorgiev/uf3-showcase-theme.git
cd uf3-showcase-theme
npm install
npm run build
```
This will download the theme and compile its styles. All you have to do is activate the theme.

## Examples and modules

__Ultimate Fields: Showcase__ is a basic and simplistic WordPress theme, which does not use any of Ultimate Fields' functionality to function as a theme.

The `modules` directory contains multiple optional modules, which can be individually activated. Each module contains examples of one or more locations and one or mode fields, as well as sample PHP code, which shows how to work with the values of those locations and fields.

Please read the [`readme.md`](tree/master/modules) file of the `modules` directory in order to learn more about modules and the piceces of functionality, which they feature. 
