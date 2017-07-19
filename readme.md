# Ultimate Fields Showcase Theme
This theme contains an example of every location and field of Ultimate Fields.

## Installation
You can clone the theme from GitHub and configure it locally if you have `git` and `npm` installed. If not, you can download and compile it manuall.

In both scenarios, please keep in mind that the theme requires __Ultimate Fields Pro__ to be installed and activated. If you use the free version of Ultimate Fields, some of the functionality of the theme will be limited.

### Command line:
Navigate to your wp-content/themes directory and execute the following commands:
```bash
git clone git@github.com:RadoslavGeorgiev/uf3-showcase-theme.git
cd uf3-showcase-theme
npm install
gulp
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

### Modules
Modules group different examples together and use the hooks in the base to display and add their content. Each module has a readme in it's own directory, which describes what features are used and what is being done there.

- [`menu`](modules/menu/readme.md): Showcases the usage of the `Menu_Item` location with custom sidebars and icons.
- [`events`](modules/events/readme.md): Creates a new post type for events, featuring dates, maps and the `Post_Type` location.
- [`quote`](modules/quote/readme.md): Showcases the usege of the `Shortcode` location to add a shortcode for a quote.