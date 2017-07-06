
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

Templates

Templates and their partials can all be overriden in the /plugins/wistiti/ directory of your wistiti child theme to fully support tachyons classes.

All elements templates can be are organized according 'layout' and 'display' :
* layout defines the general structure of the element (list, grid....)
* display defines the element display format (media object, card, ...)


Shortcodes

* [wistiti_jumbotron] : displays the jumbotron selected by the id attribute.
Attributes :
'id' : id of the jumbotron
'display' : display mode (classic)
'firstheadinghierarchy' : heading hierarchy starting level
'background' : relative url of background image

* [wistiti_card] : displays the card selected by the id attribute.
Attributes :
'id' : id of the jumbotron
'display' : display mode (classic)
'firstheadinghierarchy' : heading hierarchy starting level (1 to 6)
'background' : relative url of background image

* [wistiti_services] : displays all the services, ordered by the Order field.
Attributes :
'family' : service family (taxonomy)
'layout' : layout mode (list, grid)
'col' : grid columns number per row
'display' : display mode (media, card)
'firstheadinghierarchy' : heading hierarchy starting level (1 to 6)

* [wistiti_links] : displays all the links, ordered by the Order field.
Attributes :
'group' : link group (taxonomy)
'layout' : layout mode (grid)
'col' : grid columns number per row
'display' : display mode (card)
'firstheadinghierarchy' : heading hierarchy starting level (1 to 6)

* [wistiti_team] : displays all the team members, ordered by the Order field.
Attributes :
'team' : team (taxonomy)
'layout' : 'layout mode (grid),
'col' : grid columns number per row
'display' : display  mode (card)
'firstheadinghierarchy' => heading hierarchy starting level (1 to 6)

* [wistiti_faq] :display all the FAQS, ordered by the Order field.
Attributes :
'layout' : layout mode (list)
'display': display mode (accordion)
'firstheadinghierarchy' : heading hierarchy starting level (1 to 6)

* [wistiti_contact_form] : displays a simple contact form.
Attributes:
 None
