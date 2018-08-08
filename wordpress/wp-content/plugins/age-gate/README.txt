=== Age Gate ===
Contributors: philsbury
Tags: age, age verification, age verify, adults-only, modal, over 16, over 18, over 19, over 20, over 21, pop-up, popup, restrict, splash, beer, alcohol, restriction
Requires at least: 4.7.3
Tested up to: 4.8.2
Stable tag: 1.5.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A plugin to check the age of a visitor before view site or specified content

== Description ==
There are many uses for restricting content based on age, be it movie trailers, beer or other adult themes. This plugin allows you to set a restriction on what content can been seen or restricted based on the age of the user.

__Features__

* Ask users to verify their age on page load
* SEO Friendly - common bots and crawlers are omitted from age checks
* Choose to restrict an entire site, of selected content
* Allow certain content to not be age gated under "all content" mode
* Add an age check to site registration forms
* Three choices for input; dropdowns, input fields or a simple yes/no button
* Customise the order of the inputs based on your region (DD MM YYYY or MM DD YYYY)
* Allow a "remember me" check box if desired
* Ability to omit logged in users from being checked
* Add your own logo
* Update the text displayed on the entry form
* Select background colour/image, foreground colour and text colour
* Use built in styling out of the box, or your own custom style
* Ability to add legal note or information to the bottom of the form
* Redirect failed logins to a URL of your choice e.g. an alcohol awareness website.
* Ability to use an non caching version

== Installation ==
1. Upload the 'age-gate' folder to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Visit 'Age Gate' admin section and adjust your configuration.

== Frequently Asked Questions ==
= Can I restrict a particular page? =

You can. If you use selected content, a checkbox will appear in content pages

= Can I add my own logo/branding? =

Of course, it's your site

= I'm in X country, can I format the date style? =

Yes! DD MM YYYY and MM DD YYYY are supported along with a choice of how the dates are entered.

= I use caching, will that be affected? =

From version 1.4.0 those using caching can select the "Cache Bypass" option to allow age gating even with caching on. Be sure to empty your cache when making changes to the plugin settings.

== Screenshots ==
1. What your users see with default styling
2. The settings page
3. The checkbox to restrict selected content

== Changelog ==
= 1.5.1 = 
* Fixes issue where users with plain/no permalink structure were always redirected to the home page

= 1.5.0 =
* Adds ability to define how long Remember Me lasts

= 1.4.13 =
* Fixes issue in Cache Bypass where strings were not translated
* Fixes issue in some Multisite installs where wp-admin was becoming invalid
* Fix for conflict with Jetpack and wp_editor function - to be remove when Jetpack fix is released

= 1.4.12 = 
* Adds additional test to enable restriction of WooCommerce shop page

= 1.4.11 = 
* Fixes issue with includes in admin area

= 1.4.10 =
* CSS change for users using large logos where the them doesn't use max-width: 100% by default
* Corrected README typo.

= 1.4.9 =
* Minor change to logo class from `logo` to `age-gate-logo`

= 1.4.8 =
* Updates to translation files
* Adds user preference to alter page title when Age Gate is displayed
* Added additional test for Bots in "Cache Bypass" version
* Minor text change on post editor

= 1.4.7 =
* Added Facebook and Twitter crawlers to the Bot ignore list
* Minor CSS changes
* Added CSS classes to Age Gate plus a guide in the admin
* Fixes issue where links in "Additional Content" could not be opened in a new window
* Fixes issue where links in "Additional Content" could not not have their text altered
* Fixes bug where adding a link to "Additional Content" also updated "Redirect Failures".

= 1.4.6 =
* Due to an issue when using WPeCommerce the trigger for the JS version has been altered - JS version will be selected by default
* When using Yes/No buttons, the question "Are you over (n) years of age?" is now optional/customisable.

= 1.4.5 =
* Fixes issue when using standard mode, selected restrictions and Woocommerce when the age check would not show on the product page

= 1.4.4 =
* Addresses an issue in some themes where default style misbehaves on smaller screens
* Fixes issue where plugin was causing inability to scroll in some themes
* Added a cheeky paypal button

= 1.4.3 =
* Added option to have the Remember Me option checked by default

= 1.4.2 =
* In Cache Bypass mode, session storage dropped in favour of cookies to support Private/Incognito sessions.
* Also in Cache Bypass, when the AG is successfully passed the page will refresh as some occurences of JS manipulated content were not working.

= 1.4.1 =
* Fixes a bug when using Cache Bypass mode but not using Remember me

= 1.4.0 = 
* Caching support! Ability to use the age gate on cached sites
* Bugfix for uninstall not working (thanks to @nate22 for the heads up)
* Removed bad translations

= 1.3.5 =
* Addresses issue on mobile devices where rendering is a little small as raised by @fwusquare2com. Option to add viewport meta added.

= 1.3.4 =
* Fixes issue created in 1.3.2 where listing pages were not age gated even if "all content" was selected

= 1.3.3 =
* Bugfix for missing text domain for "remember me" text
* Updated translation files

= 1.3.2 =
* Bugfix for listing pages being age gated incorrectly (e.g. blog home and archives)

= 1.3.1 =
* Options added for custom error messaging
* Slight change to admin page layout

= 1.3.0 =
* Option to bypass particular content when using "All Content" setting. Useful to allow Terms pages etc.
* Option to redirect users to a custom destination if age test is failed

= 1.2.0 =
* Fixed issue where correct input was not honoured in some browsers

= 1.1.0 =
* Added "no second chance" option which disallows multiple attempts if failed.
* Minor background improvements

= 1.0.1 =
* Minor changes to default style
* Fixed typo in readme

= 1.0.0 =
* Initial release

== Upgrade Notice ==
= 1.4.8 =
* Adds user preference to alter page title when Age Gate is displayed
* Added additional test for Bots in "Cahce Bypass" version

= 1.4.5 =
* Woocommerce users using "Selected content" should update to show age gate on the product page

= 1.4.1 =
* Fixes a bug when using Cache Bypass mode but not using Remember me

= 1.4.0 =
* Adds support for sites with caching enabled

= 1.2.0 =
* Contains vital fix for correct input not accecting some browsers