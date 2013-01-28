Wordstrap
======================================================================

Wordstrap is a WordPress theme designed with the popular Bootstrap CSS Framework, and using Font Awesome for the lightweight usage of icons. You can customize the layout in one, two or three columns, and choose the background colors of the header, navbar and widget headers and some other interesting features available in the theme options page.

Features
======================================================================

- Designed using the default Bootstrap markup. Responsive.
- Includes Font Awesome.
- Custom header and background support, post-thumbnails, post format support.
- Choose between a full width, two (right or left sidebar) or three columns layout.
- A customizable front page. You can choose to display your blog loop as default, or make use of an intro container with customizable background and text colors, displaying the page you choose in an attractive way. You can also make use of the featured items container, to display the posts of the categories you choose in an AJAX powered navigation system.
- Support for galleries using Bootstrap’s carousel component, and displaying of the images using WordPress’s thickbox
- A customizable footer. Choose the information you want to display in the footer of your site, and use the included social icons for the most common sites.
- Extras like Google API Fonts usage for selectable elements like page titles, widget titles, etc.

Changelog
======================================================================
v: 1.7.8

- Fixed Bootstrap "carousel" display for galleries
- Added thickbox gallery support for gallery images. Now you can see all images of a gallery inside thickbox
- Added a shortcode for displaying social share buttons anywhere inside a post or a page. Use the shortcode [social_share] in a post or page. Additionally you can use the "link" attribute to set manually the link you want to share, example: [social_share link="http://www.site.com"]
- Added attachment.php template file
- Changed Google Font selection to a Bootstrap typeahead control, where you can type the name of any font from the extense list in google.com/webfonts
- Some CSS improvements in style.css and in theme-options.css
- Deleted some duplicated files in /partials
- Updated language files
- Included a PayPal donate button in the theme options page

v: 1.7.7

- Updated Bootstrap to version 2.2.2.
- Updated Font Awesome to version 3.0.
- Cleaned up and fixed theme styles. The style called "solid" is a preview, you may use it to override the css you don't like with your own. The css file is located in "inc/styles/solid/style.css".
- Updated language files

v: 1.7.6

- Fixed submenu dropdowns issue by updating bootstrap.min.js file

v: 1.7.5

- Theme options/Front page/Tabs: Added the possibility to choose the posts you want to list in each of the 4 tabs available.
- Added the possibility to change sidebar widths from the theme options page.
- Some css fixes in the default WordPress calendar widget.
- Improved the "solid" style. Works best with a dark background.
- Fixed the option to display the site title along with the custom header image.

v: 1.7.4[Available only from Github repo]

- Added the possibility to change sidebar widths from the theme options page.
- Some css fixes in the default WordPress calendar widget.

v: 1.7.4

- Improved the "Featured" section in the front page, adding a loading animation during queries and controlling success/error states properly.
- Added the "Style" option in the appearance tab of the theme options page. Now you can choose between 2 different styles, and you can also make your own, by creating a folder inside "inc/styles/yourstyle" with a "style.css" file inside. Then you will see it listed in the theme options page.
- Added three different page templates: tpl-onecolumn.php, tpl-twocolumn-left.php and tpl-twocolumn-right.php. You can use them to create pages with left/right sidebar, or no sidebars.
- Improved the wp_nav_menu() function call in order to avoid the "Parse error: syntax error, unexpected T_FUNCTION in ..." error in php versions prior to 5.2.4.

v: 1.7.3

- Theme now works with PHP 5.2.4 or greater versions
- Added Bootstrap carousel element to display the items of the galleries
- Improved the comment form in order to display the (*) of the required fields correctly
- Other minor code and CSS improvements

v: 1.7.2

- Added post format support to theme
- Added the posibility to show/hide the breadcrumb
- Added new options to choose the text color of widget headers, header text, featured title and navbar links.
- Theme partials have been renamed and reorganized. Article partial is now divided into content, header and footer. Also, a new partial has been created: partials/part_pf_gallery.php to display gallery posts
- Fixed a bug when using the "page_for_post" option of WordPress
- Added some more fonts to the Google API Font list in theme options
- Replaced the way to retrieve theme options among pages, now using global $wordstrap_options
- Thickbox is now enqueued along with the rest of the scripts in functions.php
- Dinamically add the thickbox css class to gallery post format items using JS
- Style adjustments and improvements. Now styles are enqueued in header.php, making the render smoother

v: 1.7.1

- Added new options to choose background gradient of header and navbar
- Fixed an error with category links. Now they display correctly despite the permalink configuration
- Theme options are not overwritten when a new version of the theme is installed
- Improved CSS style. Also improved page rendering to avoid showing non-styled elements during page loads
- Updated spanish translation

v: 1.7

- Theme approved by WordPress reviewers
- Added an option to show/hide search form in nav bar
- Added an option to show/hide home link in nav bar
- Added an option to show/hide search form in header
- Improved search form.
- Removed @package, @subpackage and @since tags from page headers
- Minor fix in header to avoid the repeated page title.
- Some fixes in style.css

v: 1.6.5

- Updated Bootstrap to the latest version (2.0.4)
- Updated Font Awesome to the latest version (2.0)
- Fixed style issues in style.css to the new bootstrap version and format it following WordPress coding standards guidelines.
- Added Bootstrap's responsiveness.
- Cleaned and improved the Theme Options page for a better user experience.
- Theme author url and theme url now display the necessary information in order to contact me and have some support with the theme.

v: 1.6.4

- Checked and fixed all unit-tests concerning layout.
- Improved displaying of site title and description.
- Fixed styles in wp-calendar and in tables, making use of the default bootstrap classes.
- Now both widget headers and the small calendars next to post titles use the background specified in the theme options page.
- 100% complete spanish translation.