# Change Log

Any notable changes to this project will be documented in this file.

This file is based on [Keep a Changelog](http://keepachangelog.com/).
This projects uses [Semantic Versioning](http://semver.org/).


TAGS: Added, Changed, Deprecated, Removed, Fixed, Security.

## [TODO]
- Check wp_enqueue_scripts (how many time is called?).



## [1.0.2] - 2026-09-11



## [1.0.1] - 2026-09-10
## Changed
- Changed the theme license from `GPL-3.0-only` to `GPL-3.0-or-later`, aligning `style.css`, `package.json`, `package-lock.json`, `publiccode.yml` and `README.md`. The `LICENSE` file is unchanged: the GPL v3 text is the same, only the declaration differs. The bundled third-party components keep their own licenses.
- Documented in the README that the license applies to the theme's own code, with a pointer to `CREDITS.txt` for the bundled components.

## [1.0.0] - 2026-09-10
First stable release. Versioning drops the `DEV-` prefix and follows plain Semantic Versioning.
## Added
- Added the 404 page template.
- Added the operator manual to the documentation.
- Added FAQ search results to the FAQ page: pressing Enter, or the new Search button, in the FAQ autocomplete now runs a paginated FAQ search rendered on the same page.
## Changed
- Updates Bootstrap Italia to 2.18.3.
- Updates Algolia Autocomplete to 1.19.10 (panel repositioning, keyboard auto-scroll, animation performance).
## Fixed
- Fixed the wrong Bootstrap Italia sprites path in the common video section template.
- Fixed the Search button in the autocomplete forms of the site search and documentation pages: it submitted an empty query, or re-submitted the previous one, instead of the text just typed.
- Fixed a custom taxonomy bug.
- Fixed related-category links not applying the archive filter.
- Fixed the language selector and the breadcrumb.
- Fixed multiple frontend, i18n and security issues.
- Hardened the SVG logo handling and `posts_per_page`; removed PHPCS suppressions.
- Removed an unintended `noindex`.
## Security
- Escaped previously unescaped output fields.

## [DEV-0.2.0] - 2026-05-07
## Fixed
- Bug-fixing: Fixed bug reported by AI.
- Security: Fixed issues reported by AI.

## [DEV-0.1.9] - 2026-04-27
## Fixed
- Bug-fixing.
- Fixed the bug of wrong translations

## [DEV-0.1.8] - 2026-03-20
## Changed
- Updates Bootstrap Italia to 2.18.0.
- Updated Dockerfile.
## Fixed
- Refactoring of templates pages.
- Applied security fixes.
- Bug-fixing.

## [DEV-0.1.7] - 2026-03-10
## Changed
- Updated Dockerfile.

## [DEV-0.1.6] - 2025-11-19
## Changed
- Updates Bootstrap Italia to 2.17.0.
- Updated Dockerfile.

## [DEV-0.1.5] - 2025-09-09
### Added
- Added autocomplete in Home Page search.
- Added autocomplete in Faq Page.
- Added autocomplete in Documentation Page.
- Added FAQs by topic.
### Fixed
- Fixed the link of the logo of the site.
- Dockerfile fixed and updated.
- Fixed font management.
- Fixed pagination.
### Changed
- Modified the pages: FAQ, Documentation and search.
- Labels translation.

## [DEV-0.1.4] - 2025-08-28
### Added
 - Added Video section in Home Page.
 - Adde visits counter in FAQ post type.
### Fixed
 - Many bug fixes in contents views and archives.

## [DEV-0.1.3] - 2025-08-05
### Added
-	Articles archive page.
### Fixed
- Translated: How to update Bootstrap Italia.md
- Labels translation.
- Dockerfile fixed and updated.
