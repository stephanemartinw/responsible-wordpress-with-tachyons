
=== Wistiti Plugin ===

Contributors:
Tags:

Requires at least:
Tested up to:
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

== Installation ==

== Changelog ==

* 1.0 = Initial release

== Documentation ==

Shortcodes

* [wistiti_jumbotron] : displays the jumbotron selected by the id attribute. Use jumbotron's slug as id. 'main' is default one.
Attributes :
'id' : id of the jumbotron (Use jumbotron's slug as id.)
'display' : display mode (classic)
'firstheadinghierarchy' : heading hierachy starting level
'background' : relative url of background image

* [wistiti_card] : displays the card selected by the id attribute.
Attributes :
'id' : id of the jumbotron (use card's slug as id.)
'display' : display mode (classic)
'firstheadinghierarchy' : heading hierachy starting level (1 to 6)
'background' : relative url of background image

* [wistiti_services] : displays all the services, ordered by the Order field.
Attributes :
'layout' : layout mode (list, grid)
'display' : display mode (media, card)
'firstheadinghierarchy' : heading hierachy starting level (1 to 6)

* [wistiti_team] : displays all the team members, ordered by the Order field.
Attributes :
'layout' : 'layout mode (grid),
'col' : grid columns number
'display' : display  mode (card)
'firstheadinghierarchy' => heading hierachy starting level (1 to 6)

* [wistiti_faq] :display all the FAQS, ordered by the Order field.
Attributes :
'layout' : layout mode (list)
'display': display mode (accordion)
'firstheadinghierarchy' : heading hierachy starting level (1 to 6)

* [wistiti_contact_form] : displays a simple contact form.
Attributes:
 None
