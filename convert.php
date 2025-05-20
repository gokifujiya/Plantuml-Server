<?php
$code = $_POST['code'] ?? '';
$format = $_POST['format'] ?? 'svg';

if (!$code) {
    http_response_code(400);
    exit('No code submitted.');
}

$tempDir = sys_get_temp_dir();
$filename = tempnam($tempDir, 'uml');
file_put_contents($filename . '.puml', $code);

$outputFile = $filename . '.' . $format;

// Call PlantUML with appropriate format
$cmd = escapeshellcmd("java -jar plantuml.jar -t$format " . $filename . ".puml");
exec($cmd);

// Return file as download
if (!file_exists($outputFile)) {
    http_response_code(500);
    exit('Failed to generate diagram.');
}

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="diagram.' . $format . '"');
readfile($outputFile);

// Cleanup
unlink($filename . '.puml');
unlink($outputFile);
