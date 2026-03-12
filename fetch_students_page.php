<?php
$url = 'http://localhost:8080/students';
$opts = ['http' => ['timeout' => 5]];
$ctx = stream_context_create($opts);
$html = @file_get_contents($url, false, $ctx);
if ($html === false) {
    echo "Failed to fetch $url\n";
    exit(1);
}

// try to extract the debug alert text
if (preg_match('/<div[^>]*class="alert alert-info"[^>]*>(.*?)<\/div>/s', $html, $m)) {
    $text = strip_tags($m[1]);
    echo "DEBUG_ALERT: " . trim($text) . "\n";
} else {
    echo "No debug alert found in page.\n";
}

// also indicate whether the table row text appears
if (strpos($html, 'No students found.') !== false) {
    echo "PAGE_SAYS: No students found.\n";
} elseif (strpos($html, 'Add New Student') !== false) {
    echo "PAGE_CONTAINS: student form present.\n";
}

// optionally save page for inspection
file_put_contents('students_page.html', $html);
echo "Saved page to students_page.html\n";
