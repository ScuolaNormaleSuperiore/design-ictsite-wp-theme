# PROJECT.md


## Project Overview

Design ICT Site is an open-source WordPress theme for building institutional websites focused on ICT services.
According to `README.md` and `publiccode.yml`, it is intended to help organizations publish and organize ICT-oriented information such as services, service clusters, staff, projects, offices, places, events, news, FAQs, documentation, and blog articles.

The theme is designed as a reusable product for the Italian public sector and is published in the Developers Italia reuse catalog.
It supports multilingual websites and uses Bootstrap Italia patterns to align the frontend with Italian public administration design guidelines.

Beyond templates, the theme also bootstraps the site structure, creates default pages and menus, registers custom content types, exposes admin configuration screens, and provides content discovery features such as search and optional autocomplete.


## Main System Features

- Automatic initial population of pages and menus after activation or through the "Reload theme data" admin tool.
- Custom WordPress content model with dedicated post types for services, service clusters, offices, people, projects, places, events, news, attachments, banners, sponsors, and FAQs.
- Custom taxonomies for place types, person roles, user status, and FAQ topics.
- Back-office configuration area built with CMB2 for site identity, contacts, social links, alerts, home page sections, home page layout, newsletter data, analytics, SEO options, and advanced settings.
- Configurable home page made of modular sections such as hero, clusters, events, news, projects, featured content, articles, banners, sponsors, and video.
- Search across site content, plus optional autocomplete for homepage search, site search, FAQ search, and documentation search.
- Export tools for FAQs and services in JSON format.
- Multilingual support through Polylang for built-in and custom content.
- Theme-managed "Super Editor" role: an Editor that can also manage the site menus and reload the theme data. The theme configuration panel stays reserved to administrators.
- Dependency checks for required plugins and reusable setup assets for demo and Docker environments.


## Documentation

- `README.md`: project overview, installation flow, dependencies, feature list, Docker demo, customization notes, and reuse catalog references.
- `publiccode.yml`: reuse-catalog metadata, intended audience, localisation, status, and product description.
- `DOC/Sito_ICT_Manuale_operatore.pdf`: operator manual in Italian, linked from `README.md`.
- `DOC/ICT-SiteContentTypes.pdf`: schema of post types and taxonomies.
- `DOC/How to update Bootstrap Italia.md`: procedure for updating frontend library assets.
- `SETUP/ACF_Custom_Fields/*.json`: exported ACF field-group definitions used to configure the editorial model.
- `SETUP/Docker/`: local Docker demo environment and bootstrap assets.
- GitHub wiki referenced in `README.md`: user manual in Italian.



## Changelog and TODO List

- `CHANGELOG.md` is the main project changelog and follows a Keep a Changelog style.
- The latest documented version in the repository is `1.0.7`.
- Recent entries highlight Bootstrap Italia updates, Docker maintenance, autocomplete features, FAQ/topic improvements, archive pages, pagination fixes, and translation updates.
- The changelog also contains an open TODO note about verifying the `wp_enqueue_scripts` behavior.
- Operational issue tracking uses local ignored files (`AGENTS/ISSUES_TODO.md` and `AGENTS/ISSUES_RESOLVED.md`); never publish private findings.



## Automated Quality Checks (tests/e2e/)

- `tests/e2e/` contains runtime status, HTML validation, and accessibility checks.
- `package.json` provides layout build commands:
  - `npm run create_layout`
  - `npm run update_layout_win`
  - `npm run update_layout_linux`
- It also provides quality-check commands:
  - `npm run status:scan -- <baseUrl>`
  - `npm run html:scan -- <baseUrl>`
  - `npm run html:scan:gate -- <baseUrl>`
  - `npm run pa11y:scan`
- AGENTS instructions indicate `composer run lint:php` as the primary PHP quality gate when available.
- The repository also includes `.github/workflows/scorecard.yml` for OpenSSF Scorecard analysis and git hooks under `.githooks/`.

## License

See the `LICENSE` file in the project root for licensing information.


## Public Code Catalog

The project is published in the "Catalogo del Riuso della PA" (Public Administration Reuse Catalog).
See `publiccode.yml` for the catalog entry details.
