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


## Request Flow

- `functions.php` defines `DIS_THEME_PATH`/`DIS_THEME_URL`, then loads in order `config-theme.php`, `config-pages.php`, `config-menu.php`, `inc/theme-dependencies.php`, `inc/cmb2.php` and `classes/class-dis-thememanager.php`.
- On `after_setup_theme` (priority 2) it calls `DIS_ThemeManager::get_instance()->theme_setup()` (singleton). All manager files are included up front by the theme manager.
- `theme_setup()` registers, in order: security filters, text domain, permalinks, upload limits, Super Editor role, then the managers (MultiLang, CustomFields, Layout, Options, Export, Activation, the post type managers, Autocomplete, Pwa, Navigation). Post type managers register post types and taxonomies on `init`.
- Templates do not receive data from a controller: they call static helpers directly, mainly `DIS_CustomFieldsManager::get_field()`, `DIS_OptionsManager::dis_get_option()`, `DIS_ContentsManager::*`, `DIS_MultiLangManager::*` and `DIS_NavigationManager::*`.
- Home page sections come from `DIS_HP_SECTIONS` (`config-theme.php`), mapped to `template-parts/home/hp-*-section` and ordered by the option `dis_opt_hp_sections`.


## Public Endpoints and Handlers

The theme registers no REST routes and no `admin_post_*` actions. REST is restricted instead: anonymous requests get `rest_not_logged_in` unless the option `rest_api_enabled` is `true`; XML-RPC is off unless `xmlrpc_api_enabled` is `true`.

| Endpoint | Where | Access | Protection |
|---|---|---|---|
| AJAX `theme_autocomplete` | `DIS_AutocompleteManager::theme_autocomplete_callback` | public (`wp_ajax_nopriv_`) | nonce `sf_site_autocomplete_nonce`, `selector` allowlist, `q` sanitized, 8 results, 200-char snippets |
| `?dis_pwa_service_worker=1` | `DIS_PwaManager::maybe_render_service_worker` (`template_redirect`, priority 0) | public | none needed: static JS, no user data |
| `sitemap-index.xml`, `sitemap-{lang}.xml` | `DIS_NavigationManager::maybe_render_sitemap_xml` (rewrite rules) | public | language validated, otherwise 404 |
| Export data (admin form) | `DIS_ExportManager` | `manage_options` | `check_admin_referer` |
| Reload theme data (admin form) | `DIS_ActivationManager` | `edit_theme_options` | `check_admin_referer`, capability re-checked |
| `?posts_per_page=` | `DIS_ContentsManager::get_validated_per_page` | public | allowlist of values |

New handlers must follow the same pattern: nonce, capability or abuse control, input allowlist, bounded result size.


## Data Model

- Post types (constants in `config-theme.php`): `dis-service-cluster`, `dis-service`, `dis-office`, `dis-person`, `dis-project`, `dis-place`, `dis-event`, `dis-news`, `dis-attachment`, `dis-banner`, `dis-sponsor`, `dis-faq`, plus core `post` and `page`. URL slugs are translatable (`dis_ct_data()`, context `DIS_PostTypeSlugs`).
- Taxonomies: `dis-place-type`, `dis-person-role`, `dis-user-status`, `dis-faq-topic`; core `category` and `post_tag` are attached to several post types.
- ACF field groups are registered in PHP at runtime inside each manager (`acf_add_local_field_group`). `SETUP/ACF_Custom_Fields/*.json` are exports for reference and import, not loaded automatically: keep them aligned with the PHP definitions.
- Theme options are CMB2 pages, one `wp_options` row each (`dis_opt_options`, `dis_opt_site_alerts`, `dis_opt_hp_sections`, `dis_opt_hp_layout`, `dis_opt_main_hero`, `dis_opt_site_contacts`, `dis_opt_social_media`, `dis_opt_newsletter_settings`, `dis_opt_advanced_settings`), read with `DIS_OptionsManager::dis_get_option( $key, $option_key )`. Other options: `dis_flush_rewrite_needed`, `dis_translated_cpt_rewrite_rules_version`, `menu_check`. The theme uses no transients and no object cache.
- Polylang translates the types and taxonomies listed in `MULTILANG_POST_TYPES` and `MULTILANG_TAXONOMIES`.


## Roles and Capabilities

- `Super Editor` (`dis_super_editor`) is an Editor plus `edit_theme_options` and `dis_edit_site_configuration`. It is created only on `after_switch_theme`, so existing installs must reactivate the theme to get it.
- Options pages and Export data require `manage_options`; Reload theme data requires `edit_theme_options`.


## Maintainer Notes

- Text domain: `design_ict_site`; source strings are in English, translations in `languages/`.
- Front-end assets use the theme version as `?ver` (deliberately not `filemtime`): after editing an asset, bump the version or visitors keep the cached file. Admin assets use `filemtime`.
- `assets/css/bootstrap-italia-custom.min.css` is generated from `assets/scss/bootstrap-italia-custom.scss` (`npm run create_layout`); edit the SCSS, not the output. `main.css`, `custom-colors.css` and `fonts.css` are hand-edited.
- `assets/algolia/` holds the autocomplete front-end; the search itself is a local `WP_Query`, not the Algolia service.
- Security headers (`nosniff`, `X-Frame-Options`, `Referrer-Policy`) are sent by the theme; a CSP is deliberately not sent because of inline scripts and styles.
- Upload limits: images 1 MB, PDF 2 MB. Requires WordPress 6.1.1+ and PHP 8.0+.



## Main Files

- `functions.php`: theme entry point and bootstrap loader.
- `config-theme.php`: global constants, custom post type metadata, plugin requirements, role constants, and home page section definitions.
- `config-pages.php`: seed definitions for system pages and archive pages.
- `config-menu.php`: menu location definitions and default menu item seeds.
Manager classes live in `classes/` as `class-dis-<name>manager.php` and define the class `DIS_<Name>Manager`.

- `classes/class-dis-thememanager.php` (`DIS_ThemeManager`): central orchestrator that initializes the full theme stack.
- `classes/class-dis-optionsmanager.php` (`DIS_OptionsManager`): CMB2-based configuration UI for site settings and feature toggles.
- `classes/class-dis-activationmanager.php` (`DIS_ActivationManager`): admin workflow for recreating theme data such as pages and menus.
- `classes/class-dis-layoutmanager.php` (`DIS_LayoutManager`): frontend and admin asset loading plus menu registration.
- `classes/class-dis-multilangmanager.php` (`DIS_MultiLangManager`): Polylang wrapper and translation helpers.
- `classes/class-dis-contentsmanager.php` (`DIS_ContentsManager`, plus `DIS_OG_Wrapper` and `DIS_Search_Wrapper`): content query helpers, search helpers, homepage data providers, sitemap helpers, and OG data helpers.
- `classes/class-dis-navigationmanager.php` (`DIS_NavigationManager`, plus `DIS_TreeItem` and `DIS_BreadItem`): breadcrumb and sitemap tree construction.
- `classes/class-dis-autocompletemanager.php` (`DIS_AutocompleteManager`): AJAX endpoints and asset wiring for autocomplete features.
- `classes/class-dis-customfieldsmanager.php` (`DIS_CustomFieldsManager`): static wrapper around ACF `get_field()` and `update_field()`.
- `classes/class-dis-pwamanager.php` (`DIS_PwaManager`): minimal PWA support. It enqueues `assets/pwa/pwa-register.js` on public pages for logged-out visitors only, and serves the service worker from the site root on `template_redirect` when the `dis_pwa_service_worker` query argument is present.
- `classes/class-dis-*manager.php`: post type specific managers for services, clusters, people, projects, offices, places, events, news, attachments, banners, sponsors, FAQs, posts, and pages.
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
