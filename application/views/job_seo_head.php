<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Extra <head> tags for /job/view/<id>: Open Graph + JobPosting JSON-LD.
 * Rendered by Job::view() and injected into includes/header.php via $extra_head.
 * Needs: $job, $seo_job_url, $seo_og_title, $seo_desc
 */
?>
<?php if (!empty($job_expired)): ?>
  <meta name="robots" content="noindex, follow">
<?php endif; ?>
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="SahajJobs">
  <meta property="og:title" content="<?= escape($seo_og_title) ?>">
  <meta property="og:description" content="<?= escape($seo_desc) ?>">
  <meta property="og:url" content="<?= escape($seo_job_url) ?>">
<?php
// JobPosting structured data (Google for Jobs).
// Country is required by Google. Location is free text, so detect it:
//   UAE keywords -> AE ; other known foreign countries -> skip schema ; otherwise India (IN).
$seo_loc = (string) ($job['location'] ?? '');
$seo_plain = trim(preg_replace('/\s+/', ' ', strip_tags((string) $job['description'])));
$seo_country = null;
if (preg_match('/emirates|\buae\b|dubai|abu dhabi|sharjah|ajman|ras al/i', $seo_loc)) {
    $seo_country = 'AE';
} elseif (!preg_match('/saudi|qatar|kuwait|oman|bahrain|usa|united states|u\.s\.|united kingdom|\buk\b|canada|australia|singapore|germany|france|europe/i', $seo_loc)) {
    $seo_country = 'IN';
}

$seo_types = [
    'full time' => 'FULL_TIME', 'full-time' => 'FULL_TIME', 'part time' => 'PART_TIME',
    'part-time' => 'PART_TIME', 'contract' => 'CONTRACTOR', 'internship' => 'INTERN',
    'temporary' => 'TEMPORARY',
];
$seo_emp = $seo_types[strtolower(trim((string) ($job['job_type'] ?? '')))] ?? null;

if ($seo_country && !empty($job['title']) && !empty($job['company']) && $seo_plain !== '') {
    $schema = [
        '@context'           => 'https://schema.org',
        '@type'              => 'JobPosting',
        'title'              => $job['title'],
        'description'        => format_description_html($job['description']),
        'identifier'         => ['@type' => 'PropertyValue', 'name' => 'SahajJobs', 'value' => (string) $job['id']],
        'hiringOrganization' => ['@type' => 'Organization', 'name' => $job['company'], 'sameAs' => base_url()],
        'jobLocation'        => [
            '@type'   => 'Place',
            'address' => [
                '@type'           => 'PostalAddress',
                'addressLocality' => $seo_loc,
                'addressCountry'  => $seo_country,
            ],
        ],
        'url'                => $seo_job_url,
    ];
    if (!empty($job['created_at'])) {
        $schema['datePosted'] = date('Y-m-d', strtotime($job['created_at']));
    }
    // Expiry date, so Google knows when the job ends
    if (!empty($job['last_date']) && strtotime($job['last_date']) !== false) {
        $schema['validThrough'] = date('Y-m-d', strtotime($job['last_date'])) . 'T23:59:59+05:30';
    }
    if ($seo_emp) {
        $schema['employmentType'] = $seo_emp;
    }
    if (!empty($job['industry'])) {
        $schema['industry'] = $job['industry'];
    }
?>
  <script type="application/ld+json"><?= json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) ?></script>
<?php } ?>
