## WP MMenu Lite

An easy to use Mobile Menu Plugin

## Description

Easily create and customize a gorgeous app-like mobile menu based on Fred Heusschen's <a href="http://mmenu.frebsite.nl/">mmenu.js</a>!

## What is it?

WP MMenu Lite is based off of <a href="http://frebsite.nl/">Fred Heusschen</a>'s incredibly powerful and beautiful <a href="http://mmenu.frebsite.nl/">mmenu.js</a> jQuery plugin.  WP MMenu Lite combines the simplicity of WordPress with the powerful features of mmenu.js to create a Mobile Menu Plugin. It's easy to setup and use but also gorgeous right out of the box.  WP MMenu Lite uses WordPress's default menus/locations to keep things familiar for anyone who's ever built a menu within WordPress. 

## How to use it

After you have installed the plugin...

 * Create a Menu
 * Set the location for that menu to Mobile Menu
 * Use the [mmenu][/mmenu] shortcodes to create a link that will open the mmenu

## Using the Shortcode

Here are two examples of how you can use the shortcode:

```
[mmenu]example[/mmenu]
``` 

**OR**

```
<a href="#mmenu">example</a>
```

These do the exact same thing, so if you want to incorporate this plugin into a theme you can do the latter in any template file.

## Installation

1.   Upload `wp-mmenu-lite.zip` to the `/wp-content/plugins/` directory
2.   Activate the plugin through the 'Plugins' menu in WordPress
3.   Use the shortcode `[mmenu]example[/mmenu]` in the page content or use `<a href="#mmenu">example</a>` outside of the page content

## Creating Menus

WP MMenu Lite uses default menus (see Appearances -> Menus within your dashboard).  After you've created a new menu and added all your pages and hit the Create Menu button you'll then need to assign the menu to the Mobile Menu location.  If you're lost and don't know how to create menus, see the <a href="http://codex.wordpress.org/WordPress_Menu_User_Guide">WordPress Menu User Guide</a>

## Frequently Asked Questions

<h4>How can I create an element that's fixed, so that it moves when the menu opens?</h4>

You can add the css class `mm-fixed-top` or `mm-fixed-bottom` to any element and it should make it fixed. <a href="http://mmenu.frebsite.nl/tutorial/fixed-elements.html">Find out more here...</a>






