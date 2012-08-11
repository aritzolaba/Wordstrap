Wordstrap is a WordPress theme designed with the popular Bootstrap CSS Framework, and using Font Awesome for the lightweight usage of icons. You can customize the layout in one, two or three columns, and choose the background colors of the header, navbar and widget headers and some other interesting features available in the theme options page.

Features
======================================================================
- Designed using the default Bootstrap markup. Includes all Bootstrap javascript components ready to be used.
- Includes Font Awesome. (Use icon-awesome-xxx instead of icon-xxx)
- Theme supports: custom header, custom menu, custom background, featured images, etc.
- Post Format support. Custom template for Gallery post format, displaying images using Bootstrap carousel. Gallery options are found in the theme options page.
- Featured images support in posts, displaying images using WordPress's thickbox.
- A customizable layout supporting full width, 2 columns (right or left sidebar) and three columns, all selectable through the theme options page.
- A customizable front page. You can choose to display your blog loop as default, or make use of an intro container with customizable background and text colors, to display the page you choose in a more attractive way. You can also make use of the featured items container, to display the posts of a category you choose in a browsable (via AJAX) container with navigation buttons.
- A customizable footer. Choose the information you want to be displayed in the footer of your site, and make use of the included social buttons for Facebook, Google+, Twitter, LinkedIn, GitHub and YouTube.
- Extras like Google API Fonts usage for displaying titles, an option to include your Google Analytics shortcode in an easy way, social share buttons in posts and pages, etc.
- Browse categories and tags using Bootstrap's pills system.

Changelog
======================================================================
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