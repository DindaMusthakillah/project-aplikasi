<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';

try {
    $mutasi = \App\Models\MutasiPenduduk::all();
    echo "Success! Found " . count($mutasi) . " records";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
    echo "\nFile: " . $e->getFile();
    echo "\nLine: " . $e->getLine();
}
?>
