# ARCHITECTURE.md


## Architecture Notes

- The theme is bootstrapped from `functions.php`, which defines constants, loads configuration files (`config-theme.php`, `config-pages.php`, `config-menu.php`), registers dependency wrappers, and instantiates `DIS_ThemeManager` on `after_setup_theme`.
- `DIS_ThemeManager` is the orchestration layer. During `theme_setup()` it enables baseline security settings, configures internationalisation and permalink structure, enforces upload limits, adds the custom "Super Editor" role, and initializes all major managers.
- The architecture is modular but WordPress-native: each business area is represented by a manager class under `classes/`, and the managers register WordPress hooks directly (`init`, `admin_menu`, `wp_enqueue_scripts`, AJAX hooks, CMB2 hooks, and theme hooks).
- The content model is driven by constants declared in `config-theme.php`, plus page and menu seed definitions declared in `config-pages.php` and `config-menu.php`.
- The frontend rendering layer is template-driven: page-level routes live in `page-templates/`, while reusable sections and fragments live in `template-parts/`.
- The admin layer is theme-owned. In addition to standard editors, the theme adds a CMB2-based configuration area, a "Reload theme data" page, and an "Export data" page for JSON exports.
- Multilingual behavior is delegated to Polylang through `DIS_MultiLangManager`, which registers both custom post types and custom taxonomies as translatable and links generated pages and menus across languages.
- Autocomplete is implemented as an internal AJAX service. The frontend uses assets from `assets/algolia/`, while results are produced by WordPress AJAX endpoints in `DIS_AutocompleteManager` backed by `WP_Query`.
- Content retrieval and view support logic are centralized in `DIS_ContentsManager` and `DIS_NavigationManager`, which expose helpers for homepage sections, search, sitemap trees, breadcrumbs, archive queries, and OG/SEO-related data.
- Sitemap generation is split into two layers: `DIS_NavigationManager::get_sitemap_tree()` builds the shared tree structure, while dedicated renderers produce the final output format. The HTML sitemap page uses `dis_render_sitemap_html()`, and XML endpoints are exposed through rewrite-based routes such as `sitemap-index.xml` and `sitemap-{lang}.xml` for each Polylang language.
- Required plugin dependencies are enforced through TGM Plugin Activation, while custom field integrations are wrapped through ACF and bundled CMB2 utilities in `inc/`.


## Key Directories

- `classes/`: main application logic and manager classes for setup, options, layout, multilingual support, navigation, exports, autocomplete, and each custom post type.
- `page-templates/`: page-level templates for archives, search, FAQ, documentation, contacts, privacy, offices, projects, services, and other core routes.
- `template-parts/`: reusable frontend components split into `common/`, `header/`, `footer/`, `home/`, and `menu/`.
- `assets/`: static assets such as CSS, SCSS, JS, fonts, images, screenshots, HTML seed files, autocomplete scripts, and Bootstrap Italia resources. `assets/bootstrap-icons/` holds the vendored Bootstrap Icons 1.11.3 CSS and its `fonts/` subfolder: the upstream file is kept unmodified so its relative `url()` paths resolve, and the library is updated by replacing the files.
- `admin/`: admin-side CSS, JS, and auxiliary UI used by custom configuration and reload screens.
- `inc/`: dependency bootstrap and third-party integrations, including bundled CMB2, TGMPA, custom CMB2 fields, and menu walkers.
- `languages/`: translation files loaded through the theme text domain.
- `SETUP/ACF_Custom_Fields/`: exported ACF field definitions that describe the editorial data structure.
- `SETUP/Docker/`: Docker demo assets, database/bootstrap scripts, and sample content for local setup.
- `DOC/`: supplementary project documentation.
- `.githooks/`: versioned git hooks (secret scan before commit).



## Main Files

- `functions.php`: theme entry point and bootstrap loader.
- `config-theme.php`: global constants, custom post type metadata, plugin requirements, role constants, and home page section definitions.
- `config-pages.php`: seed definitions for system pages and archive pages.
- `config-menu.php`: menu location definitions and default menu item seeds.
- `classes/theme-manager.php`: central orchestrator that initializes the full theme stack.
- `classes/options-manager.php`: CMB2-based configuration UI for site settings and feature toggles.
- `classes/activation-manager.php`: admin workflow for recreating theme data such as pages and menus.
- `classes/layout-manager.php`: frontend and admin asset loading plus menu registration.
- `classes/multi-lang-manager.php`: Polylang wrapper and translation helpers.
- `classes/contents-manager.php`: content query helpers, search helpers, homepage data providers, sitemap helpers, and OG data helpers.
- `classes/navigation-manager.php`: breadcrumb and sitemap tree construction.
- `classes/autocomplete-manager.php`: AJAX endpoints and asset wiring for autocomplete features.
- `classes/*-manager.php`: post type specific managers for services, clusters, people, projects, offices, places, events, news, attachments, banners, sponsors, FAQs, posts, and pages.
- `inc/theme-dependencies.php`: registration of required plugins via TGMPA.
- `inc/cmb2.php`: bundled CMB2 bootstrap and custom field integrations.


## Technology Stack

- Platform: WordPress
- Language: PHP
- Custom fields: ACF
- Frontend framework: Bootstrap Italia
- Build/tooling: see `package.json`
- Code quality: PHPCS


## Commands

- Theme bootstrap entry point: `functions.php`
- Main bootstrap class: `DIS_ThemeManager`
- Asset build and layout commands from `package.json`:
  - `npm run create_layout`
  - `npm run update_layout_win`
  - `npm run update_layout_linux`
- Validation and maintenance commands mentioned in the repository:
  - `composer run lint:php`
  - `publiccode-parser publiccode.yml`
- Docker demo flow documented in `README.md`:
  - `docker build -t demoict-img -f SETUP/Docker/Dockerfile .`
  - `docker run -p 80:80 -p 3306:3306 --name=demoict -d demoict-img`
