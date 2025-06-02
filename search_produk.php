<?php
$directory = __DIR__; // folder root project

function searchInFiles($dir, $keyword) {
    $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

    $results = [];

    foreach ($rii as $file) {
        if ($file->isDir()) continue;

        $path = $file->getPathname();
        // hanya cari di file PHP dan Blade
        if (!preg_match('/\.(php|blade\.php)$/', $path)) continue;

        $contents = file_get_contents($path);
        if (stripos($contents, $keyword) !== false) {
            $results[] = $path;
        }
    }

    return $results;
}

$keyword = 'produk';
$foundFiles = searchInFiles($directory, $keyword);

echo "Files containing keyword '$keyword':\n";
foreach ($foundFiles as $file) {
    echo $file . "\n";
}
