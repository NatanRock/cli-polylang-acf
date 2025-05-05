# ACF × Polylang CLI Tools

![ACF x Polylang CLI](https://img.shields.io/badge/ACF--Polylang-CLI-blue?style=for-the-badge)
![License: MIT](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

Tools to automate the `Translations` setting in ACF fields when working with **Polylang Pro + ACF Pro**.

No more manually setting "Copy Once", "Ignore" or "Synchronize" for each field. Automate this process and save your time.

## 🚀 Features

| Feature         | Description                                               |
| --------------- | --------------------------------------------------------- |
| Bulk update     | Update ACF field translation modes via WP-CLI             |
| Nested support  | Supports groups, repeaters, flexible content              |
| **Two methods** | **Use either as a one-time script or as a WP-CLI plugin** |
| Quick script    | One-time script for fast changes without CLI command      |

## 📦 Installation

| File             | Location                                                           |
| ---------------- | ------------------------------------------------------------------ |
| `plugin-cli.php` | Place in `wp-content/mu-plugins` (or `plugins`) for WP-CLI usage   |
| `script.php`     | Anywhere (optional), used with `wp eval-file` for one-time updates |

```bash
git clone https://github.com/NatanRock/cli-polylang-acf.git
```

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

## 👉 How to choose method

| Use case                                   | Recommended method                 |
| ------------------------------------------ | ---------------------------------- |
| One-time bulk update                       | One-time Script (simple and quick) |
| Regular / repeatable updates or automation | WP-CLI Command (recommended)       |
| CI/CD or deployment tasks                  | WP-CLI Command                     |
| Developers unfamiliar with CLI             | One-time Script                    |

Both methods produce the same result — choose based on your workflow and frequency of use.

## 📌 Notes

| Tip          | Info                                                    |
| ------------ | ------------------------------------------------------- |
| Backup       | Always backup your database before bulk updating fields |
| Sub fields   | Supported: group, repeater, flexible content            |
| Auto updates | Automatically updates ACF field objects in the database |
| ACF JSON     | Run `wp acf sync` or resave field groups after updating |

## 📚 License

MIT — free to use, modify, and share.

---

**Made for developers who don't want to click hundreds of fields manually.**
Enjoy automation and focus on what matters.
