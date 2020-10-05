<?php declare(strict_types=1);

define('LIST_OF_FILES', 'filelist.txt');

ini_set('memory_limit','-1');

$cleanedArray = [];
$fn = fopen(LIST_OF_FILES, 'r');

while (!feof($fn)) {
    $name = fgets($fn);

    if (is_string($name) && trim(pathinfo($name, PATHINFO_EXTENSION)) === 'json') {
        $cleanedArray[] = pathinfo($name, PATHINFO_FILENAME);
    }
}

$mirror = [];
$min = min($cleanedArray);
$max = max($cleanedArray);

for ($i = $min; $i <= $max; $i++) {
    $mirror[] = $i;
}

file_put_contents('missing_files.txt', implode('.json' . PHP_EOL, array_diff($mirror, $cleanedArray)));
file_put_contents('missing_files.txt', '.json', FILE_APPEND);
