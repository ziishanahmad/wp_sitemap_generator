# WP Sitemap Generator

A WordPress plugin that generates a `sitemap.xml` file when requested from the admin panel. This plugin adds a top-level menu item in the WordPress admin dashboard, allowing administrators to generate or update the sitemap manually.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Requirements](#requirements)
- [Screenshots](#screenshots)
- [Changelog](#changelog)
- [Contributing](#contributing)
- [License](#license)
- [Author](#author)

## Features

- Generates a `sitemap.xml` file containing all public posts and pages.
- Adds a top-level menu item in the WordPress admin dashboard for easy access.
- Supports all public post types except attachments.
- Allows manual generation of the sitemap from the admin panel.
- Automatically includes the homepage in the sitemap.
- Sets default `<changefreq>` and `<priority>` values for sitemap entries.
- Uses WordPress security features like nonces and capability checks.

## Installation

1. **Download the Plugin:**

   - Download the latest version of the plugin from the [GitHub repository](https://github.com/ziishanahmad/wp_sitemap_generator).

2. **Upload to WordPress:**

   - Upload the `wp-sitemap-generator.php` file to the `/wp-content/plugins/` directory of your WordPress installation.

3. **Activate the Plugin:**

   - Log in to your WordPress admin dashboard.
   - Navigate to **Plugins** → **Installed Plugins**.
   - Find **WP Sitemap Generator** in the list and click **Activate**.

## Usage

1. **Access the Sitemap Generator:**

   - In the WordPress admin dashboard, find the **Sitemap Generator** menu item in the main admin menu.

2. **Generate the Sitemap:**

   - Click on **Sitemap Generator** to open the plugin page.
   - Click the **Generate Sitemap** button.
   - A success message will appear if the sitemap was generated successfully.

3. **View the Sitemap:**

   - The `sitemap.xml` file is created in the root directory of your WordPress installation.
   - Access your sitemap at `https://yourwebsite.com/sitemap.xml`.

## Requirements

- WordPress version 4.0 or higher.
- PHP version 5.6 or higher.

## Screenshots

### 1. Sitemap Generator Menu Item

![Menu Item](https://user-images.githubusercontent.com/yourusername/menu-item.png)

### 2. Sitemap Generator Admin Page

![Admin Page](https://user-images.githubusercontent.com/yourusername/admin-page.png)

### 3. Success Message

![Success Message](https://user-images.githubusercontent.com/yourusername/success-message.png)

## Changelog

### Version 1.1

- Added top-level menu item in the main admin menu.
- Improved security by escaping URLs and HTML content.
- Updated author name to "zeeshan ahmad".

### Version 1.0

- Initial release of the plugin.
- Generates `sitemap.xml` from the admin panel under the Tools menu.

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository on GitHub.
2. Create a new branch for your feature or bug fix: `git checkout -b feature-name`.
3. Commit your changes: `git commit -am 'Add new feature'`.
4. Push to the branch: `git push origin feature-name`.
5. Submit a pull request.

## License

This plugin is licensed under the [GPL2 License](https://www.gnu.org/licenses/gpl-2.0.html).

## Author

**Zeeshan Ahmad**

- [GitHub](https://github.com/ziishanahmad)
- [Website](https://ziishan.com)
- [Email](mailto:ziishanahmad@gmail.com)

