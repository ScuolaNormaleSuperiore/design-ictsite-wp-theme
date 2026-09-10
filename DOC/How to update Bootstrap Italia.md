# How to Update the Bootstrap Italia Library

## Procedure

1. Download the updated version of **Bootstrap Italia** from this link: https://italia.github.io/bootstrap-italia.
2. Unzip the contents of the zip file.
3. Empty the **"design-ictsite-wp-theme\assets\bootstrap-italia"** folder within the theme.
4. Copy the contents of the bootstrap-italia folder you just downloaded into **"design-ictsite-wp-theme\assets\bootstrap-italia"**.
5. Edit the ***packages.json*** file and update the entry:
```
"dependencies": {
"bootstrap-italia": "^<new_version>"
},
```
6. Use a shell to access the template's root directory: ***design-ictsite-wp-theme***.
7. Run the command ***npm install***
8. Run the command ***npm run update_layout_win*** or ***npm run update_layout_linux***. This command produces a new *bootstrap-italia-custom.min* file that overwrites the existing one.
9. Add an entry under ***Changed*** in the ***CHANGELOG.md*** file, for example: `Updates Bootstrap Italia to <new_version>.`
10. Verify that the correct version of ***Bootstrap Italia*** is loaded.

## Checks after the update

- `assets/bootstrap-italia/version.js` must declare the new version in `BOOTSTRAP_ITALIA_VERSION`.
- `assets/bootstrap-italia/` must match `node_modules/bootstrap-italia/dist/`, with no leftover files from the previous version:
```
diff -rq assets/bootstrap-italia node_modules/bootstrap-italia/dist
```
- `assets/css/bootstrap-italia-custom.min.css` must be regenerated and must contain the new value of `--bootstrap-italia-version`.
- `npm ls bootstrap-italia`, `package.json` and `package-lock.json` must all report the same version.
