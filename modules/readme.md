### Items
This table describes what features are used in the theme and where to find them. Respectively, there is a reverse, module-based list below.

| Feature          | Module                  | Hint                                             |
|------------------|-------------------------|--------------------------------------------------|
| __Locations__    |                         |                                                  |
| `Options_Page`   | Core                    | Used for theme options                           |
| `Post_Type`      | [`events`](events), [`content-blocks`](content-blocks)  | Adds meta boxes to pages and events.             |
| `Taxonomy`       | [`enhanced-categories`](enhanced-categories)     | Displays the fields when adding and creating categories. |
| `Comment`        | [`comment-tags`](comment-tags)            | Renders the field when editing a comment.        |
| `User`           | [`photographers`](photographers)           | Displays the copyrights link field for every user. |
| `Widget`         | [`accordion-widget`](accordion-widget)               | Handles the widget.                              |
| `Menu Item`      | [`menu`](menu)                    | Displays additional fields in menu items.        |
| `Attachment`     | [`photographers`](photographers)           | Handles the photographer field for images.       |
| `Customizer`     | [`site-layout`](site-layout)             | Shows a new section in the Customizer.           |
| `Shortcode`      | [`shortcode`](shortcode)               | Allows the addition of quotes with extra styles. |
| __Fields__       |                         |                                                  |
| Text             | [`quote`](quote), [`accordion-widget`](accordion-widget) | Used for the author, title and etc.              |
| Map              | [`events`](events)                  | Used to set the location of events.              |
| Sidebar          | [`menu`](menu)                    | Used to select a sidebar for mega-menus.         |
| Text             | [`team`](team)                    | Used for team member names                       |
| Checkbox         | [`events`](events)                  | Checks if the event is physical or not.          |
| File             | [`downloads`](downloads)               | Allows a downloadable file to be assigned to posts. |
| Object           | [`content-blocks`](content-blocks)          | Used for the teaser block.                          |
| Tab              | [`site-layout`](site-layout)             | Used to toggle between layout and background.    |
| Date             | [`events`](events)                  | Used to select the beginning and end of events.  |
| Complex          | [`content-blocks`](content-blocks)          | Used for displaying buttons.                     |
| Textarea         | [`accordion-widget`](accordion-widget)        | Allows the content of individual sections to be entered. |
| Image            | [`site-layout`](site-layout)             | Handles the page background in boxed mode.       |
| Objects          | [`related-posts`](related-posts)           | Used to select the related posts.                |
| Section          | [`events`](events)                  | Separates the date fields and the location.      |
| Repeater         | [`team`](team)                    | Used to add departments and teams to the team page. |
| WYSIWYG          | [`content-blocks`](content-blocks), [`team`](team)    | Used for the individual team-member bios.        |
| Select           | [`site-layout`](site-layout)             | Lets you select which site layout to use.        |
| Audio            | [`content-blocks`](content-blocks)          | Audio files selection.                           |
| Link             | [`photographers`](photographers)           | Allows the entry of copyright links for users.   |
| Message          | [`colors`](colors)                  | Indicates the availability of the module in the customizer. |
| Layout           | [`content-blocks`](content-blocks)          | Works as the base of the blocks field.           |
| Password         | -                       | Although the field is simple, examples must be too complex. |
| Multiselect      | [`comment-tags`](comment-tags)            | Allows the selection of related tags for the comment. |
| Color            | [`colors`](colors), [`enhanced-categories`](enhanced-categories) | Picks the color of the site accent or category. |
| Font             | [`fonts`](fonts)                   | Allows the selection of a body font.             |
| Gallery          | [`content-blocks`](content-blocks)          | Handles the "Gallery" block.                     |
| Image Select     | [`colors`](colors)                  | Allows the use of a pre-defined color.           |
| Icon             | [`content-blocks`](content-blocks), [`menu`](menu)    | Used in the Text content block and for menu icons. |
| Video            | [`content-blocks`](content-blocks)          | Used in the "Video" block.                       |
| Map              | [`events`](events)                  | Selects the location of the event.               |
| Embed            | [`content-blocks`](content-blocks)          | Main handler of the embed block.                 |
| Sidebar          | [`menu`](menu)                    | Allows the dropdown sidebar selector to work.    |
| Number           | [`enhanced-categories`](enhanced-categories)     | Controls the amount of posts per page on the listing. |

### Modules
Modules group different examples together and use the hooks in the base to display and add their content. Each module has a readme in its own directory, which describes what features are used and what is being done there.

- [`content-blocks`](modules/content-blocks): Replaces the content editor of pages with a layout field.
- [`events`](modules/events/): Creates a new post type for events, featuring dates, maps and the `Post_Type` location.
- [`menu`](modules/menu/): Showcases the usage of the `Menu_Item` location with custom sidebars and icons.
- [`quote`](modules/quote/): Showcases the usege of the `Shortcode` location to add a shortcode for a quote.
- [`related-posts`](modules/related-posts/): Adds fields for other related posts to post edit screens.
