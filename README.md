# Wistiti

An experiment for lightened WordPress websites with [tachyons.io](https://github.com/tachyons-css/tachyons/).


## Presentation

This Wistiti project is experimental !
It wants to explore a way for creating efficient, lightweight and fast websites with WP.

It also proposes to regain the pleasure of creating a website by refocusing on the essential and simplifying the technologies used :

* fighting against enormous and over-sized WP themes is not fun.
* for many 'small' websites in any case, building and maintaining OOCSS libraries is painful and time-consuming.
* it's so exciting and enriching to fully master the code of the site that is being built.
* it's also gives the possibility to understand and integrate disliked features like accessibility !
* time becomes available to work on essentials : content and user experience
* green sustainable and responsible websites should become the norm and this approach seems to be a good compromise for building clean websites that consume less energy.


I will be very happy to get your opinion and feedback about this experiment.
Please, feel free to say hello at contact@stephanemartinw.com or [@stephanemartinw](https://twitter.com/StephaneMartinW).


## Principles

This prototype wants to be useful to create simple but very lightweight WP websites.
For that it proposes :

* A minimal starter theme.
* A plugin that proposes very simple and fully overridable elements (layout and skin).

so that Tachyons atomic classes can be used everywhere.

Moreover, as far as possible, all content should be manageable without the use of the WP Editor.
It should all be defined and accessible via Custom Post Types interfaces.


## The starter theme

The starter theme is based on the base package of [Components](http://components.underscores.me/).
Some modifications have been done :

* No CSS but Tachyons.
* No jQuery loaded.
* A fully customizable navigation menu.
* A three widgets footer.
* Some options (to be extended) via the theme customizer.

Note : the theme has still to be modified to support blog websites.


## The plugin

The plugin proposes so far following elements :

* Jumbotron (inspired from Bootstrap)
* Services
* FAQ
* Contact Form

These elements use custom post types (so the content management is easy with WP), overridable templates(so that you can customize layout and skin with tachyons).
They propose each a shortcode to be uses in pages and templates.

New elements are currently developed and will be added soon :
* Text block
* Portfolio
* Testimonials

These elements are by default all inactive but can be separately activated, according to the need of the built website.


## Getting Started

Install and activate both theme and plugin in your WordPress project. In the Wistiti plugin settings, activate the elements you need.

Create then a child theme and start building your theme by :

* building your custom templates or pages (for that use Wistiti's elements shortcodes and tachyons classes.)
* overriding Wistiti's elements templates to fit your specific needs.
* adding content via the generated custom post types interfaces.


## Shortcodes

To be used in posts, pages and custom templates :

* [wistiti_jumbotron id="id of the jumbotron" background="relative url of background image"] : displays the jumbotron selected by the id attribute. Use jumbotron's slug as id. 'main' is default one.
* [wistiti_services] : displays all the services, ordered by thee Order field.
* [wistiti_team] : displays all the team members, ordered by thee Order field.
* [wistiti_faq] :display all the FAQS, ordered by thee Order field.
* [wistiti_contact_form] : displays a simple contact form.



## Built With

* [Tachyons](https://github.com/tachyons-css/tachyons/) - Functional css for humans
* [Components](https://github.com/Automattic/theme-components) - A collection of patterns for creating a custom starter WordPress theme


## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/stephanemartinw) for details on our code of conduct, and the process for submitting pull requests to us.


## Authors

* **Stephane Martin** - *Initial work* - [www.stephanemartinw.com](http://www.stephanemartinw.com) (this site is currently being rewrited with Wistiti!)

See also the list of [contributors](https://github.com/stephanemartinw/wistiti/contributors) who participated in this project.


## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
