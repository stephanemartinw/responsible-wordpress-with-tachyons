# Wistiti

An experiment for responsible WordPress websites with [tachyons.io](https://github.com/tachyons-css/tachyons/).


## Presentation

Wistiti is an experimental WordPress framework project for theme developers who want to explore a way for building effective, lightweight, performant and accessible websites with WordPress.

It also proposes to regain the pleasure of creating a responsible website by refocusing on the essential and simplifying the technologies used :

* fighting against enormous and over-sized WordPress themes is not fun.
* for many 'small' websites in any case, building and maintaining OOCSS libraries is painful and time-consuming.
* it's so exciting and enriching to fully master the code of the site that is being built.
* it's also gives the possibility to understand and integrate disliked features like accessibility !
* time becomes available to work on essentials : content and user experience
* ecodesign and responsible websites should become the norm and this approach seems to be a good compromise for building responsible websites that consume less energy.


I will be very happy to get your opinion and feedback about this experiment.

Please, feel free to say hello at contact@stephanemartinw.com or [@stephanemartinw](https://twitter.com/StephaneMartinW).


## Principles

This framework prototype wants to be useful to create simple but very lightweight WP websites.
For that it proposes :

* a minimal starter theme,
* a plugin that proposes a fully overridable custom type Element and its set of predefined views,

so that Tachyons atomic classes can be used everywhere.

Wistiti implements for this templates associated to customizer files. So HTML markup and CSS classes are separated, allowing the theme developer to only override the necessary CSS classes without overriding the whole template.

For WordPress unfiltrable markups, PHP and Javascript are used to dynamically add the classes defined in customizer file. A CSS fallback can be provided by the child theme to support javascript absence.

Important: if Tachyons classes are used here, it's worth to mention that any other atomic css set could be easily used with Wistiti, as any custom css of your choice (a framework like Bootstrap or self developed).


Moreover, as far as possible :

* the most possible, content should be managed Custom Post Types administration interfaces.

* avoid to use of other plugins. For many small sites, all necessary features can be managed without them.


## The starter theme

The Wistiti starter theme is based on the base package of [Components](http://components.underscores.me/).
Some modifications have been done :

* No CSS but Tachyons only.
* No jQuery loaded.
* A customizable navigation menu.
* A three widgets footer.
* Some options (to be extended) via the theme customizer.
* Page title is customizable and the meta Description tag is added automatically to pages via the 'description' custom field.

A child theme model (mywistiti) is available. Start from it to create your own Wistiti.


## The plugin

The plugin proposes so far following elements :

### Post types

* Element

This custom post type (so the content management is easy within WP's administration) propose overridable templates using layout and display variations that you can easily and fully customize their views with tachyons classes.

Element custom type adds following custom fields : icon (name), action (label and url), source (name and url) and social networks (name and url).

For now : 

Available layouts are : block, list, grid.

Available displays are : default, jumbotron, calltoaction, disclosure, unique, card, media.

### Modules

* Simple Contact Form

### Widgets

* WYSIWYGET text widget

### Tools

* Google Analytics
* SEO (custom title and meta description management)
* Sitemap (XML)


These elements propose each a shortcode to be used in pages and templates.

These elements are by default all inactive but can be separately activated, according to the need of the built website.

A 'mywistiti' plugin can easily be created to extend Wistitit and add new custom types objects, customize predefined custom post type Element.


## Getting Started

Install and activate both theme and plugin in your WordPress project. In the Wistiti plugin settings, activate the elements you need.

Start from the Wistiti child theme (mywistiti) and start building your theme by :

* building your custom templates or pages. For that, use Wistiti's elements shortcodes, widgets and tachyons.io classes.
* overriding Wistiti's elements templates to fit your specific needs (layout and skin), via the customizer files.
* adding content via the generated custom post types interfaces.
* if necessary, extend the Wistiti plugin to add your own custom post types, shortcodes and templates. A child skeleton plugin will soon be available.
* share your customizations and add-ons and contribute here to allow other wistitis to use your new great features !

For more information and detailled documenation, a [wistiti Wiki](https://github.com/stephanemartinw/wistiti/wiki) is under construction.


## Already existing wistitis on the web

* [www.stephanemartinw.com](http://www.stephanemartinw.com).

Send your wistiti website url and we will add it here.


## In progress

* Improving existing custom type Element to be more flexible and powerful.
* Improving support of blogs, post/page comments
* Support of WordPress standard widgets
* New elements for the Wistiti plugin.
* Managing CSS and Javscript optimizations. For now, [autoptimize](https://wordpress.org/plugins/autoptimize/) is still used on my website.
* Improving SEO features.
* Developing and testing Wistiti framework in the real world, using it on new adequate and responsible web projects.

Web developers, all suggestions are welcome ! Feel free to contribute here to Wistiti !


## Changelog

1.0 : Initial version


## Built With

* [Tachyons](https://github.com/tachyons-css/tachyons/) - Functional css for humans
* [Components](https://github.com/Automattic/theme-components) - A collection of patterns for creating a custom starter WordPress theme


## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/stephanemartinw) for details on our code of conduct, and the process for submitting pull requests to us.


## Authors

* **Stephane Martin** - *Initial work* - [www.stephanemartinw.com](http://www.stephanemartinw.com)

See also the list of [contributors](https://github.com/stephanemartinw/wistiti/contributors) who participated in this project.


## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
