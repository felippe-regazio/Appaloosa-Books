=== Authors Page ===
Contributors: wpchefgadget
Donate link:
Tags: users list, table of users, list of users, avatars, usernames, authors list, authors page, authors, WP Biographia
Requires at least: 3.5.2
Tested up to: 4.6.1
Stable tag: 1.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Displays all users of a certain role on one page in a table format. It also shows their avatars and usernames with linking to their detailed info.

== Description ==

This plugin **displays a table of users with specific roles on a separate page by simply pasting the shortcode `[authors_page]`**.
The table consists of avatars and usernames. By using the *"role"* attribute you can choose to display only users of a certain role.
Example: `[authors_page role="editor"]`
The users are ordered by post number, from highest to lowest.
You can also display the number of posts made by a user by adding the "counter" attribute, like this: `[authors_page role="editor" counter="post"]` In the "counter" attribute you can use the %post% placeholder to customize the look of the counter. For example `counter="# of posts is %post%"` will display this: "# of posts is 123" where 123 is the number of posts made by a user. The old syntax - `counter="post"` - is still supported and is the same as this: `counter="(%post%)"`
Use the `orderby="name"` attribute to show the users sorted by their display name (the "Display name publicly as" field from the profile page).

In order to view more details about a user in the table, you just have to click on the corresponding username and all available information will be displayed. This feature is enabled by the WP Biographia plugin IF it is already installed. Otherwise the default WordPress functionality will be used.

When activated, the plugin creates an *"Authors Page"* containing all shortcode options available, so you can preview how it works right away.
*The "Authors Page" plugin is useful for displaying an interactive list of users/ authors on one page.*

== Screenshots ==



== Changelog ==
= 1.6 =
* The orderby="name" attribute is added to sort the authors by their display name. https://wordpress.org/support/topic/does-it-work-for-woocommerce/
= 1.5 =
* The "counter" attribute supports the %post% placeholder now.
= 1.4 =
* The "counter" attribute is added to display the number of posts made by a user. https://wordpress.org/support/topic/add-post-4
= 1.3 =
* https://wordpress.org/support/topic/my-authors-page-link-not-working-after-i-changed-the-permalink-to-default-1
* https://wordpress.org/support/topic/how-can-i-change-the-css-file