<?php

$trains = json_decode(file_get_contents('/tmp/trains_part1.json'), true);

if (! is_array($trains)) {
    fwrite(STDERR, "Missing trains_part1.json — run initial generator first.\n");
    exit(1);
}

$add = function (array $row) use (&$trains): void {
    $trains[] = array_merge([
        'scale' => 'N (1:160)',
        'quantity' => 1,
        'decoder' => false,
    ], $row);
};

$batch = function (string $category, array $items) use ($add): void {
    foreach ($items as $item) {
        $add(array_merge($item, ['category' => $category]));
    }
};

require __DIR__.'/build_models_part2.php';

$trains = array_slice($trains, 0, 150);

$out = dirname(__DIR__).'/data/miniature_train_models.php';
file_put_contents($out, "<?php\n\nreturn ".var_export($trains, true).";\n");

echo 'Generated '.count($trains)." trains\n";
