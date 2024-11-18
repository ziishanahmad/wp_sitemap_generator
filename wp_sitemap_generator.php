<?php
/*
Plugin Name: WP Sitemap Generator
Description: Generates a sitemap.xml file when requested from the admin panel.
Version: 1.1
Author: zeeshan ahmad
License: GPL2
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class WPSitemapGenerator {
    public function __construct() {
        // Add top-level menu page
        add_action('admin_menu', array($this, 'add_admin_menu'));

        // Handle form submission
        add_action('admin_post_generate_sitemap', array($this, 'generate_sitemap'));
    }

    public function add_admin_menu() {
        add_menu_page(
            'Sitemap Generator',          // Page title
            'Sitemap Generator',          // Menu title
            'manage_options',             // Capability
            'wp-sitemap-generator',       // Menu slug
            array($this, 'admin_page'),   // Callback function
            'dashicons-sitemap',          // Icon URL
            6                             // Position
        );
    }

    public function admin_page() {
        ?>
        <div class="wrap">
            <h1>Sitemap Generator</h1>
            <?php if (isset($_GET['message']) && $_GET['message'] == 'success'): ?>
                <div class="notice notice-success is-dismissible">
                    <p>Sitemap generated successfully!</p>
                </div>
            <?php elseif (isset($_GET['message']) && $_GET['message'] == 'error'): ?>
                <div class="notice notice-error is-dismissible">
                    <p>There was an error generating the sitemap.</p>
                </div>
            <?php endif; ?>
            <form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
                <?php wp_nonce_field('generate_sitemap_action', 'generate_sitemap_nonce'); ?>
                <input type="hidden" name="action" value="generate_sitemap">
                <p>Click the button below to generate or update your sitemap.xml file.</p>
                <p>
                    <input type="submit" class="button button-primary" value="Generate Sitemap">
                </p>
            </form>
        </div>
        <?php
    }

    public function generate_sitemap() {
        // Check user capabilities
        if (!current_user_can('manage_options')) {
            wp_die('Unauthorized user');
        }

        // Check nonce
        check_admin_referer('generate_sitemap_action', 'generate_sitemap_nonce');

        // Fetch all public post types
        $post_types = get_post_types(array('public' => true), 'names');

        // Exclude attachment post type
        unset($post_types['attachment']);

        // Fetch all published posts
        $posts = get_posts(array(
            'numberposts' => -1,
            'post_type'   => $post_types,
            'post_status' => 'publish',
        ));

        // Start building the sitemap XML
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Add homepage
        $sitemap .= "\t<url>\n";
        $sitemap .= "\t\t<loc>" . esc_url(get_home_url()) . "</loc>\n";
        $sitemap .= "\t\t<changefreq>daily</changefreq>\n";
        $sitemap .= "\t\t<priority>1.0</priority>\n";
        $sitemap .= "\t</url>\n";

        // Add posts/pages
        foreach ($posts as $post) {
            $permalink = get_permalink($post->ID);
            $lastmod = get_the_modified_time('c', $post->ID);

            $sitemap .= "\t<url>\n";
            $sitemap .= "\t\t<loc>" . esc_url($permalink) . "</loc>\n";
            $sitemap .= "\t\t<lastmod>" . esc_html($lastmod) . "</lastmod>\n";
            $sitemap .= "\t\t<changefreq>weekly</changefreq>\n";
            $sitemap .= "\t\t<priority>0.8</priority>\n";
            $sitemap .= "\t</url>\n";
        }

        $sitemap .= '</urlset>';

        // Save the sitemap.xml file in the root directory
        $sitemap_path = ABSPATH . 'sitemap.xml';

        if (file_put_contents($sitemap_path, $sitemap)) {
            // Redirect back with success message
            wp_redirect(admin_url('admin.php?page=wp-sitemap-generator&message=success'));
            exit;
        } else {
            // Redirect back with error message
            wp_redirect(admin_url('admin.php?page=wp-sitemap-generator&message=error'));
            exit;
        }
    }
}

new WPSitemapGenerator();
