# What's here?

This theme was created to accompany the theming chapters (15 and 16) in
[The Definitive Guide to Drupal 7](http://definitivedrupal.org). It's currently running on http://definitivedrupal.org and includes examples of:

* General setup and customized Global Theme Settings (see pages 275-281).
* Custom region implementation (see pages 282-292).
* Template file overrides (see pages 293-301).
* Theme function overrides (see pages 301-304).
* Theme hook suggestions implementations (304-310).
* Preprocess and process function implementations (see pages 313-321).
* Alter hook implementations (see pages 321-327).
* render(), hide(), and show() (see pages 327-329).
* Advanced loading and removal of Stylesheets (see 341-347).

You can purchase the book, which contains **way** more than a couple of chapters on theme development here: http://definitivedrupal.org/purchase. It's over 1,000 pages, was written by lots of Drupal rockstars, and covers so many aspects of Drupal 7 development.

# Disclaimers

## I am NOT a web designer

This is probably really obvious from viewing the site. This theme was created with 3 goals in mind:

    1. Illustrate as many useful theming examples as possible.
    2. Make it look decent.
    3. Have fun with CSS3 and not care at all about older browsers.

It's not perfect, and doesn't claim to be, but if you are trying to learn Drupal 7 theming in more detail, it should be helpful.

## Sass/Compass

The CSS in this theme was written using Sass and Compass. The source is located in the "sass" directory and is ultimately complied into the "css" directory. In this case, existing code was quickly converted to Compass syntax, because I hate writing CSS3 without it and it's got lots of awesome utilities that make it a lot easier and faster to write CSS in general. Unfortunately, the time that I can spend on this has run out, but if I were to continue working on this theme (or had used SASS from the start), I would have made partials, mixins, sprites and more variables.

To learn more about using SASS and Compass + Drupal, I highly recommend checking out all of the following resources:

* [Sass](http://sass-lang.com)
* [Compass](http://compass-style.org)
* [The Sass Way](http://thesassway.com)
* [The Coding Designer's Survival Kit](http://thecodingdesigner.com)
* [The Coding Designer's Survival Kit (Drupal project)](http://drupal.org/project/survivalkit)

## Mobile Friendliness

While this theme contains media queries that manipulate the layout so that it is easier to read on small screens, it's by no means meant to be an example of how to create a complete and robust mobile experience or responsive design and doesn't work where media queries are not supported. It's just a quick attempt to make it more mobile friendly as others have done: http://bit.ly/n3kqsJ.

To learn more about making mobile friendly and responsive websites, here are some good resources and some code:

* [Responsive Web Design (article)](http://www.alistapart.com/articles/responsive-web-design/)
* [Responsive Web Design (book)](http://www.abookapart.com/products/responsive-web-design)
* [HTML5 Mobile Boilerplate](http://html5boilerplate.com/mobile/)
* [css3-mediaqueries.js](http://code.google.com/p/css3-mediaqueries-js/)
* [respond.js](https://github.com/scottjehl/Respond)
* [Responsive Images](https://github.com/filamentgroup/Responsive-Images)

# More documentation

There are many resources available, some of which are linked throughout the code comments and in this file. There's also plenty of official documentation on http://drupal.org:

* [Theming Guide](http://drupal.org/theme-guide/6-7)
* [Drupal API Documentation](http://api.drupal.org)
* [A log of changes from Drupal 6 to Drupal 7](http://drupal.org/update/themes/6/7)

# Tools

Below is a collection of the tools/apps that I use on a daily basis and find invaluable. Maybe you will too.

##  General

* This theme was partially written in [TextMate](http://macromates.com) and [Espresso](http://macrabbit.com/espresso/) on Mac OS X.
* I use [Google Chrome](http://www.google.com/chrome) for development.
* I use [LiveReload](http://livereload.com) to automatically refresh my browser windows while I code.
* I use [MAMP](http://www.mamp.info) for my local development environment.
* I use [xDebug](http://xdebug.org) which gives very helpful stack traces when an error occurs.
* I use [VMware Fusion](http://www.vmware.com/products/fusion/overview.html) and 3 virtual machines for cross-browser testing.
* I use [VirtualHostX](http://clickontyler.com/virtualhostx) to easily setup local sites.
* I use [Tower](http://www.git-tower.com) for version control.
* I use [Colloquy](http://colloquy.info) to hang out and chat with other developers and frequent #drupal, #drupal-contribute, #drupal-html5 and #html5 on [IRC](http://drupal.org/irc).

## Drupal-specific

* I use [Devel](http://drupal.org/project/devel) religiously while theming to print the contents of arrays/objects using <code>dpm()</code>.
* I use [Drush](http://drupal.org/project/drush) constantly during development (especially to clear the cache).
* I use the [Design test](http://drupal.org/project/design) and [Style Guide](http://drupal.org/project/styleguide) modules which contain test pages with lots of different output to help ensure that I don't miss styling anything important when creating themes.




