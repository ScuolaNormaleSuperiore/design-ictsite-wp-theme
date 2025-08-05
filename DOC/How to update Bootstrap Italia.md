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
1. Also edit the *README.md* file on the line:
```
The project uses the [***Bootstrap Italia <new_version>***] library.
```
1. Use a shell to access the template's root directory: ***design-ictsite-wp-theme***.
2. Run the command ***npm install***
3. Run the command ***npm run update_layout_win*** or ***npm run update_layout_linux***. This command produces a new *bootstrap-italia-custom.min* file that overwrites the existing one.
4. Verify that the correct version of ***Bootstrap Italia*** is loaded.
