<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sitemap_settings extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // You can add a check here to ensure the user is logged in as an admin
    }

    public function xml()
    {
        $this->load->database();
        header('Content-Type: application/xml; charset=utf-8');
        $urls = $this->db->get('sitemap_urls')->result_array();
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        foreach ($urls as $url) {
            echo '<url>';
            echo '<loc>' . htmlspecialchars($url['url']) . '</loc>';
            if (!empty($url['last_modified'])) {
                echo '<lastmod>' . $url['last_modified'] . '</lastmod>';
            }
            if (!empty($url['change_frequency'])) {
                echo '<changefreq>' . $url['change_frequency'] . '</changefreq>';
            }
            if (!empty($url['priority'])) {
                echo '<priority>' . $url['priority'] . '</priority>';
            }
            echo '</url>';
        }
        echo '</urlset>';
    }
}