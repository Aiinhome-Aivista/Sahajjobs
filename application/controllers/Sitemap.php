<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Generated sitemap: https://www.sahajjobs.com/sitemap.xml
 * Built from the database on every request, so it never needs regenerating:
 *   - only jobs whose last_date has NOT passed (expired jobs drop out automatically)
 *   - all blog posts, active government jobs, and the fixed main pages
 * The static /sitemap.xml file in the web root must be deleted so this route is used.
 */
class Sitemap extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function url_entry($loc, $lastmod = null)
    {
        $x = "  <url>\n    <loc>" . htmlspecialchars($loc, ENT_XML1 | ENT_QUOTES, 'UTF-8') . "</loc>\n";
        if (!empty($lastmod) && strtotime($lastmod)) {
            $x .= '    <lastmod>' . date('Y-m-d', strtotime($lastmod)) . "</lastmod>\n";
        }
        return $x . "  </url>\n";
    }

    public function index()
    {
        $main = [
            '', 'job_search', 'government-jobs', 'blogs', 'cv-maker', 'about-us', 'careers',
            'employer-home', 'FAQ', 'report-issue', 'trust-safety', 'privacy-policy',
            'cookie-policy', 'terms-and-conditions', 'register', 'employer_register',
        ];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Main pages
        foreach ($main as $path) {
            $xml .= $this->url_entry(base_url($path));
        }

        // Active jobs only (no end date, or end date today/future)
        $jobs = $this->db->select('id, created_at')
            ->from('posted_jobs')
            ->group_start()
                ->where('last_date IS NULL', null, false)
                ->or_where('last_date >=', date('Y-m-d'))
            ->group_end()
            ->order_by('created_at', 'DESC')
            ->limit(40000)
            ->get()->result();
        foreach ($jobs as $j) {
            $xml .= $this->url_entry(base_url('job/view/' . (int) $j->id), $j->created_at);
        }

        // Blog posts
        $posts = $this->db->select('slug, created_at')->from('posts_add')
            ->where('slug IS NOT NULL', null, false)->where('slug !=', '')
            ->order_by('created_at', 'DESC')->get()->result();
        foreach ($posts as $p) {
            $xml .= $this->url_entry(base_url('blogs/' . $p->slug), $p->created_at);
        }

        // Government jobs (same filter as the /government-jobs page)
        $govt = $this->db->select('id, created_at')->from('government_jobs')
            ->where('job_type', 'government')->where('status', 'active')
            ->order_by('created_at', 'DESC')->get()->result();
        foreach ($govt as $g) {
            $xml .= $this->url_entry(base_url('admin/govt_jobs_details/index/' . (int) $g->id), $g->created_at);
        }

        $xml .= "</urlset>\n";

        $this->output
            ->set_content_type('application/xml', 'UTF-8')
            ->set_header('Cache-Control: public, max-age=3600')
            ->set_output($xml);
    }
}
