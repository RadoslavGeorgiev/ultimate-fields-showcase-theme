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
| `Options_Page`   | core                    | Used for theme options                           |
| `Post_Type`      | events, content-builder | Adds meta boxes to pages and events.             |
| `Shortcode`      | shortcode               | Allows the addition of quotes with extra styles. |
| __Fields__       |                         |                                                  |
| Text             | quote                   | Used for the author                              |
| Map              | events                  | Used to set the location of events.              |
| Sidebar          | menu                    | Used to select a sidebar for mega-menus.         |
| Text             | -                       | -                                                |
| Checkbox         | -                       | -                                                |
| File             | -                       | -                                                |
| Object           | -                       | -                                                |
| Tab              | -                       | -                                                |
| Date             | -                       | -                                                |
| Complex          | -                       | -                                                |
| Textarea         | -                       | -                                                |
| Radio            | -                       | -                                                |
| Image            | -                       | -                                                |
| Objects          | related-posts           | Used to select the related posts.                |
| Section          | -                       | -                                                |
| DateTime         | -                       | -                                                |
| Repeater         | team                    | Used to add departments and teams to the team page. |
| WYSIWYG          | -                       | -                                                |
| Select           | -                       | -                                                |
| Audio            | -                       | -                                                |
| Link             | -                       | -                                                |
| Message          | -                       | -                                                |
| Time             | -                       | -                                                |
| Layout           | -                       | -                                                |
| Password         | -                       | -                                                |
| Multiselect      | -                       | -                                                |
| Color            | -                       | -                                                |
| Font             | -                       | -                                                |
| Image Select     | -                       | -                                                |
| Gallery          | -                       | -                                                |
| Icon             | -                       | -                                                |
| Video            | -                       | -                                                |
| Map              | -                       | -                                                |
| Embed            | -                       | -                                                |
| Sidebar          | enchanced-pages         | -                                                |
| Number           | -                       | -                                                |






### Modules
Modules group different examples together and use the hooks in the base to display and add their content. Each module has a readme in its own directory, which describes what features are used and what is being done there.

- [`content-blocks`](modules/content-blocks): Replaces the content editor of pages with a layout field.
- [`events`](modules/events/): Creates a new post type for events, featuring dates, maps and the `Post_Type` location.
- [`menu`](modules/menu/): Showcases the usage of the `Menu_Item` location with custom sidebars and icons.
- [`quote`](modules/quote/): Showcases the usege of the `Shortcode` location to add a shortcode for a quote.
- [`related-posts`](modules/related-posts/): Adds fields for other related posts to post edit screens.
