# Ultimate Fields Showcase Theme
This theme contains an example of every location and field of Ultimate Fields.

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

### Modules
Modules group different examples together and use the hooks in the base to display and add their content. Each module has a readme in it's own directory, which describes what features are used and what is being done there.

- [`menu`](modules/menu/readme.md): Showcases the usage of the `Menu_Item` location with custom sidebars and icons.
- [`events`](modules/events/readme.md): Creates a new post type for events, featuring dates, maps and the `Post_Type` location.
- [`quote`](modules/quote/readme.md): Showcases the usege of the `Shortcode` location to add a shortcode for a quote.