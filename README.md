````markdown
# ACF × Polylang CLI Tools

Tools to automate the `Translations` setting in ACF fields when working with **Polylang Pro + ACF Pro**.

No more manually setting "Copy Once", "Ignore" or "Synchronize" for each field. Automate this process and save your time.

## 🚀 Features

- Bulk update ACF field translation modes via WP-CLI.
- Supports nested fields: groups, repeaters, flexible content.
- One-time script for quick changes without WP-CLI command.

## 📦 Installation

Clone or download the files and place them into your WordPress project:

- `plugin-cli.php` → place in `wp-content/mu-plugins` (or `plugins`) for WP-CLI usage.
- `script.php` → anywhere (optional), used with `wp eval-file` for one-time bulk updates.

```bash
git clone https://github.com/your-repo/cli-polylang-acf.git
````

## ✅ WP-CLI Command (recommended)

`plugin-cli.php` registers a custom WP-CLI command:

```bash
wp acf-polylang set --mode=copy_once --type=image
```

### Options

| Option   | Description                                                           |
| -------- | --------------------------------------------------------------------- |
| `--mode` | ignore / copy\_once / translate / synchronize / translate\_once       |
| `--type` | image / text / textarea / wysiwyg / group / repeater / \* (all types) |

### Examples

```bash
# Set all image fields to "Copy Once"
wp acf-polylang set --mode=copy_once --type=image

# Set all text and textarea fields to "Ignore"
wp acf-polylang set --mode=ignore --type=text,textarea

# Set everything to "Synchronize"
wp acf-polylang set --mode=synchronize --type=*
```

## ⚡ One-time Script (quick usage)

For quick changes without installing the CLI command:

```bash
wp eval-file path/to/script.php
```

Before running, edit `script.php` to configure:

```php
$mode       = 'copy_once';  // Mode: ignore, copy_once, translate, synchronize
$targetType = 'image';      // Field type (or "*" for all)
```

When executed, all matching ACF fields will be updated recursively.

## 📌 Notes

* Backup your database before bulk updating fields.
* Works with sub fields (group, repeater, flexible content).
* Automatically updates ACF field objects in the database.
* If using ACF JSON sync, run `wp acf sync` or resave field groups after updating.

## 📚 License

MIT — free to use, modify, and share.

---

**Made for developers who don't want to click hundreds of fields manually.**
Enjoy automation and focus on what matters.

````

---

```markdown
![ACF x Polylang CLI](https://img.shields.io/badge/ACF-Polylang-blue?style=for-the-badge)
![License: MIT](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)
````
