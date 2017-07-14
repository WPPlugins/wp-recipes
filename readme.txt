=== Plugin Name ===
Contributors: staxxx
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=AH797QDPZWLWC&lc=NL&item_name=Staxx%20Interactive%20Industries&item_number=wp%2drecipes&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted
Tags: recipe, cooking, food
Requires at least: 3.0.1
Tested up to: 3.0.1
Stable tag: 0.1.3

Manage recipes on your own wordpress blog with WP-Recipe. Supports taxonomies, featured image, . 

== Description ==

Adds recipe post type, alowing you to add and manage recipes on your website. Supports archives and comments and has easy recipe ingredients and instructions management.
Create, manage and publish your best recipes on your own website of blog. WP-Recipe is built out of custom post type (recipe) with multiple taxonomy support, ratings and interchangable formats.
This is not another "add recipe to post" plgin, this is a "recipy post type" plugin, with custom template files included! 


Feature overview:

*   Add and manage ingredients
*   Add and manage cooking instructions
*   Recipe origin and meal type taxonomies (category)
*   Custom recipe tags

Future features:

*   Degraded HTML5 support (currently only html5 browsers are fully supported)
*   Multi Language support
*   General settings with unit type setting
*   hRecipe in templates
*   Export recipe to recireML and other interchangable file formats

Requirements:

*   Wordpress 3.0 or newer
*   Browser HTML5 Support (currently only Google Chrome, Apple Safari and Opera). Degraded support is planned in the near future.
*   Recipe origin and meal type taxonomies (category)
*   Custom recipe tags



== Installation ==

*   Upload the plugin to your plugin folder (e.g. /wp-content/plugins/wp-recipe/)
*   Copy the template files from the template folder to your activated theme folder (e.g. /wp-content/plugins/wp-recipe/templates/ -> your theme)
*   Activate the plugin
*   Visit the Settings->Permalink page, and update the permalink structure to "/%category%/%postname%/" 



== Frequently Asked Questions ==

= I get a 404 if I visit the recipe post on the site =

Make sure you update your permalink structure. Just opening the Settings -> Permalinks admin page should suffice. This is mandatory, the plugin needs the proper permalinks structure before beieng able to serve them on your site.
Preferably set the permalinks to custom: "/%category%/%postname%/" after installing the plugin. This is good for your seo and site usability as well.

= I get a php include error on a recipe page or archive on the site =

After installing the plugin, you need to copy two template files from the plugin folder (/wp-content/plugins/wp-recipes/templates/) to your active theme folder (/wp-content/themes/your-theme/).
You may need to customise these template files to your needs if you're using a custom theme. These template files are set up to work in the default wordpress theme (twentyten).



== Screenshots ==

1. Recipe instructions panel
2. Recipe ingredients panel
3. General recipe info and Featured image
4. Recipe origin, meal types and tag taxonomies

== Changelog ==

= 0.1 =
* Initial First Import

= 0.1.3 =
* Updates to multiple issues
* Updates to readme.txt


== Upgrade Notice ==

= 0.1 =
Initial Plugin Update. Old version, please update to the current release!

= 0.1.3 =
Misc update issues. Please update to the latest (0.1.3) version!

`<?php code(); // goes in backticks ?>`