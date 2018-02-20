# Ultimate Fields Showcase Theme

This theme contains an example of every location and every field of the Ultimate Fields plugin and how to work with them. The theme is not meant to be used neither as a starter theme, nor as a framework. It is rather made to showcase all of the functionality of Ultimate Fields and educate developers on how to use it.

If you are not familiar with Ultimate Fields or don't know what it is, please visit our website at https://www.ultimate-fields.com.

You can:
1. Check the demo at https://www.ultimate-fields.com/demo/ to experience Ultimate Fields and get a feel for the functionality of the plugin.
2. Clone the theme within your sandbox and play with it in order to understand some of the core concepts of Ultimate Fields, including the registration of fields and containers through code.
3. If you are working on an extension for Ultimate Fields, create a new module that shows how to interact with it.

## Installation
You can clone the theme from GitHub and configure it locally if you have `git` and `npm` installed. If not, you can download and compile it manually.

In both scenarios, please keep in mind that the theme requires __Ultimate Fields Pro__ to be installed and activated. If you use the free version of Ultimate Fields, some of the functionality of the theme will be limited.

### Command line:
Navigate to your wp-content/themes directory and execute the following commands:
```shell
git clone git@github.com:RadoslavGeorgiev/uf3-showcase-theme.git
cd uf3-showcase-theme
npm install
npm run build
```

This will download the theme and compile its styles. All you have to do is activate the theme.

### Manual

1. Download this repository into your `wp-content/themes` directory.
2. Compile the SCSS file `assets/sass/style.scss` to `style.css` in the root of the theme.
3. Activate the theme

## Examples

### Items
This table describes what features are used in the theme and where to find them. Respectively, there is a reverse, module-based list below.

| Feature          | Module                  | Hint                                             |
|------------------|-------------------------|--------------------------------------------------|
| __Locations__    |                         |                                                  |
| `Options_Page`   | Core                    | Used for theme options                           |
| `Post_Type`      | events, content-blocks  | Adds meta boxes to pages and events.             |
| `Taxonomy`       | enhanced-categories     | Displays the fields when adding and creating categories. |
| `Comment`        | comment-tags            | Renders the field when editing a comment.        |
| `User`           | photographers           | Displays the copyrights link field for every user. |
| `Widget`         | accordion               | Handles the widget.                              |
| `Menu Item`      | menu                    | Displays additional fields in menu items.        |
| `Attachment`     | photographers           | Handles the photographer field for images.       |
| `Customizer`     | site-layout             | Shows a new section in the Customizer.           |
| `Shortcode`      | shortcode               | Allows the addition of quotes with extra styles. |
| __Fields__       |                         |                                                  |
| Text             | quote, accordion-widget | Used for the author, title and etc.              |
| Map              | events                  | Used to set the location of events.              |
| Sidebar          | menu                    | Used to select a sidebar for mega-menus.         |
| Text             | team                    | Used for team member names                       |
| Checkbox         | events                  | Checks if the event is physical or not.          |
| File             | downloads               | Allows a downloadable file to be assigned to posts. |
| Object           | content-blocks          | Used for the teaser block.                          |
| Tab              | site-layout             | Used to toggle between layout and background.    |
| Date             | events                  | Used to select the beginning and end of events.  |
| Complex          | content-blocks          | Used for displaying buttons.                     |
| Textarea         | accordion-widget        | Allows the content of individual sections to be entered. |
| Image            | site-layout             | Handles the page background in boxed mode.       |
| Objects          | related-posts           | Used to select the related posts.                |
| Section          | events                  | Separates the date fields and the location.      |
| Repeater         | team                    | Used to add departments and teams to the team page. |
| WYSIWYG          | content-blocks, team    | Used for the individual team-member bios.        |
| Select           | site-layout             | Lets you select which site layout to use.        |
| Audio            | content-blocks          | Audio files selection.                           |
| Link             | photographers           | Allows the entry of copyright links for users.   |
| Message          | colors                  | Indicates the availability of the module in the customizer. |
| Layout           | content-blocks          | Works as the base of the blocks field.           |
| Password         | -                       | Although the field is simple, examples must be too complex. |
| Multiselect      | comment-tags            | Allows the selection of related tags for the comment. |
| Color            | colors, enhanced-categories | Picks the color of the site accent or category. |
| Font             | fonts                   | Allows the selection of a body font.             |
| Gallery          | content-blocks          | Handles the "Gallery" block.                     |
| Image Select     | colors                  | Allows the use of a pre-defined color.           |
| Icon             | content-blocks, menu    | Used in the Text content block and for menu icons. |
| Video            | content-blocks          | Used in the "Video" block.                       |
| Map              | events                  | Selects the location of the event.               |
| Embed            | content-blocks          | Main handler of the embed block.                 |
| Sidebar          | menu                    | Allows the dropdown sidebar selector to work.    |
| Number           | enhanced-categories     | Controls the amount of posts per page on the listing. |

### Modules
Modules group different examples together and use the hooks in the base to display and add their content. Each module has a readme in its own directory, which describes what features are used and what is being done there.

- [`content-blocks`](modules/content-blocks): Replaces the content editor of pages with a layout field.
- [`events`](modules/events/): Creates a new post type for events, featuring dates, maps and the `Post_Type` location.
- [`menu`](modules/menu/): Showcases the usage of the `Menu_Item` location with custom sidebars and icons.
- [`quote`](modules/quote/): Showcases the usege of the `Shortcode` location to add a shortcode for a quote.
- [`related-posts`](modules/related-posts/): Adds fields for other related posts to post edit screens.
