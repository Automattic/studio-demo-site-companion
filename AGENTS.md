# WordPress Studio Companion Plugin

A companion mu-plugin for WordPress Studio preview sites. Displays admin and frontend notices about site expiration and enables Jetpack offline mode. The entire plugin lives in a single PHP file to simplify installation in the preview sites.

## Tech Stack

- PHP — WordPress hooks API, no external dependencies
- WordPress i18n — GlotPress-based translation workflow
- No build tools, no package managers

## Directory Structure

```text
studio-demo-site-companion.php   Main plugin (single entry point)
docs/localization.md             Translation process documentation
languages/                       .pot template + compiled .mo files (19 languages)
```

## Commands

### Translation String Extraction

```sh
wp i18n make-pot . --domain=studio-companion-plugin languages/studio-companion-plugin.pot
```

There are no build, test, or lint commands. The plugin is a single PHP file loaded directly by WordPress.

## Conventions

- **Commits:** Descriptive sentence with PR reference — `Update Studio name and clean demo site leftovers (#10)`
- **Branches:** Prefixed with `add/`, `fix/`, `update/` — e.g., `add/jetpack-offline-mode-filter`
- **Main branch:** `trunk` (not `main`)

## Architecture

- **mu-plugin:** This plugin is loaded as a must-use plugin at preview site provisioning time. It is NOT a standard plugin — do not add activation/deactivation hooks.
- **Single-file design:** All PHP, CSS, and JavaScript live in `studio-demo-site-companion.php`. This is intentional — do not split into separate files without explicit agreement.
- **Inline assets:** CSS and JS are embedded directly in PHP output. There is no asset build pipeline.
- **Hook-based structure:** Four functions registered to WordPress hooks:
  - `admin_notices` — admin warning banner
  - `wp_enqueue_scripts` — frontend preview banner
  - `plugins_loaded` — text domain loading
  - `jetpack_offline_mode` filter — returns `true`

## Common Pitfalls

- **Do not split the single PHP file into multiple files.** The single-file design is deliberate for mu-plugin deployment simplicity.
- **Language `.mo` files are compiled binaries.** Do not edit them directly. Follow the GlotPress workflow in `docs/localization.md`.
- **The `.pot` file is generated.** Regenerate it with the `wp i18n make-pot` command above after changing any translatable strings.
- **Text domain is `studio-companion-plugin`** (not matching the filename). All `__()` and `esc_html__()` calls MUST use this exact text domain.
- **`load_muplugin_textdomain`** is used instead of `load_plugin_textdomain` because this is a mu-plugin.
- **Main branch is `trunk`**.
