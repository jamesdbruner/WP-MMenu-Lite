=== WP MMenu Lite ===

Contributors: jamesdbruner
Donate link: https://www.paypal.com/us/cgi-bin/webscr?cmd=_flow&SESSION=Eq8rwRUWp5juO7FGERg4xvbPI_zV3ur-Kpxf7qByMVYmzmLkPWROI_auzEe&dispatch=5885d80a13c0db1f8e263663d3faee8d5402c249c5a2cfd4a145d37ec05e9a5e
Tags: Mobile Menu, jQuery Menu, Menu, App Menu, MMenu, mmenu
Requires at least: 3.5
Tested up to: 3.9.1
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

An easy to use Mobile Menu Plugin

== Description ==

Easily create and customize a gorgeous app-like mobile menu based on Fred Heusschen's <a href="http://mmenu.frebsite.nl/">mmenu.js</a>!

<h4>What is it?</h4>

WP MMenu Lite is based off of <a href="http://frebsite.nl/">Fred Heusschen</a>'s incredibly powerful and beautiful <a href="http://mmenu.frebsite.nl/">mmenu.js</a> jQuery plugin.  WP MMenu Lite combines the simplicity of WordPress with the powerful features of mmenu.js to create a Mobile Menu Plugin. It's easy to setup and use but also gorgeous right out of the box.  WP MMenu Lite uses WordPress's default menus/locations to keep things familiar for anyone who's ever built a menu within WordPress. 

<h4>How to use it</h4>

After you have installed the plugin...

* Create a Menu
* Set the location for that menu to Mobile Menu
* Use the [mmenu][/mmenu] shortcodes to create a link that will open the mmenu

<h4>Using the Shortcode</h4>

Here are two examples of how you can use the shortcode:
    
`
[mmenu]example[/mmenu]
`
(within your page content)

**OR**
    
`
<a href="#mmenu">example</a>
`
These do the exact same thing, so if you want to incorporate this plugin into a theme you can do the latter in any template file and it should work.

== Installation ==

<h4>Installation</h4>

1.   Upload `wp-mmenu-lite.zip` to the `/wp-content/plugins/` directory
2.   Activate the plugin through the 'Plugins' menu in WordPress
3.   Use the shortcode `[mmenu]example[/mmenu]` in the page content or use `<a href="#mmenu">example</a>` outside of the page content

<h4>Creating Menus</h4>

WP MMenu Lite uses default menus (see Appearances -> Menus within your dashboard).  After you've created a new menu and added all your pages and hit the Create Menu button you'll then need to assign the menu to the Mobile Menu location.  If you're lost and don't know how to create menus, see the <a href="http://codex.wordpress.org/WordPress_Menu_User_Guide">WordPress Menu User Guide</a>

<h4>Using the Shortcode</h4>
Here are two examples of how you can use the shortcode:
    
`
[mmenu]example[/mmenu]
`
(within your page content)

**OR**
    
`
<a href="#mmenu">example</a>
`
These do the exact same thing, so if you want to incorporate this plugin into a theme you can do the latter in any template file and it should work.

== Screenshots ==

You can see a working example here: <a href="mmenu.jamesdbruner.com">mmenu.jamesdbruner.com</a>

1. General Settings
2. Themes / Position
3. Front End Example (Default theme)
4. Front End Example - Sliding Submenu (Default theme)
5. Position Top Example (mm-light theme)

== Frequently Asked Questions ==

<h4>How can I create an element that's fixed, so that it moves when the menu opens?</h4>
You can add the css class `mm-fixed-top` or `mm-fixed-bottom` to any element and it should make it fixed. <a href="http://mmenu.frebsite.nl/tutorial/fixed-elements.html">Find out more here...</a>



