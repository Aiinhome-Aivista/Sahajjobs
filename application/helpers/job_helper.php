<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Helpers for the public job page (/job/view/<id>).
 * Moved out of views/job_detail_view.php so the SEO head and the page body can both use them.
 */

if (!function_exists('escape')) {
    function escape($s)
    {
        return html_escape($s);
    }
}

if (!function_exists('format_description_html')) {
    function format_description_html($text)
    {
        if (empty($text))
            return '';
        $lines = preg_split("/\r\n|\n|\r/", $text);
        $html = '';
        $inList = false;
        $headerStartedList = false;

        foreach ($lines as $raw) {
            $raw = str_replace("\t", ' ', $raw);
            $trim = trim($raw);

            // explicit bullets
            if (preg_match('/^\s*([-*•]|\d+\.)\s+/', $raw)) {
                if (!$inList) {
                    $html .= '<ul>';
                    $inList = true;
                    $headerStartedList = false;
                }
                $item = preg_replace('/^\s*([-*•]|\d+\.)\s*/', '', $raw);
                $html .= '<li>' . html_escape($item) . '</li>';
                continue;
            }

            // header lines ending with colon OR keywords
            if ($trim !== '' && (preg_match('/:\s*$/', $trim) || preg_match('/\b(key\s+responsibil|responsibil|requirements?|benefits?)\b/i', $trim))) {
                if ($inList) {
                    $html .= '</ul>';
                    $inList = false;
                }
                $headerStartedList = true;
                $html .= '<p><strong>' . html_escape(rtrim($trim, ':')) . '</strong></p>';
                continue;
            }

            if ($trim === '') {
                if ($headerStartedList) {
                    continue;
                } else {
                    if ($inList) {
                        $html .= '</ul>';
                        $inList = false;
                    }
                    $headerStartedList = false;
                    continue;
                }
            }

            if ($headerStartedList) {
                if (!$inList) {
                    $html .= '<ul>';
                    $inList = true;
                }
                $html .= '<li>' . html_escape($trim) . '</li>';
                continue;
            }

            if ($inList) {
                $html .= '</ul>';
                $inList = false;
            }
            $html .= '<p>' . html_escape($trim) . '</p>';
        }

        if ($inList)
            $html .= '</ul>';
        return $html;
    }
}
