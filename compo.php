<?php
/*
function updateComposerAutoload($namespace, $directory)
{
    // Load composer.json file
    $composerJsonPath = 'composer.json';
    $composerJson = json_decode(file_get_contents($composerJsonPath), true);

    // Check if autoload key exists
    if (!isset($composerJson['autoload'])) {
        $composerJson['autoload'] = [];
    }

    // Check if psr-4 key exists
    if (!isset($composerJson['autoload']['psr-4'])) {
        $composerJson['autoload']['psr-4'] = [];
    }

    // Update existing PSR-4 mapping if found, otherwise add a new one
    foreach ($composerJson['autoload']['psr-4'] as $existingNamespace => $existingDirectory) {
        if ($existingNamespace === $namespace) {
            $composerJson['autoload']['psr-4'][$namespace] = $directory;
            break;
        }
    }

    // Save the modified composer.json file
    file_put_contents($composerJsonPath, json_encode($composerJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}

// Example usage
$namespace = "Magnet\\Admin\\";
$directory = "administration2/";

updateComposerAutoload($namespace, $directory);

// Regenerate autoload files
echo shell_exec('composer dump-autoload');

*/


function updateComposerAutoload($namespace, $directory)
{
    $composerJsonPath = 'composer.json';
    $composerJson = json_decode(file_get_contents($composerJsonPath), true);

    // Check if autoload key exists
    if (!isset($composerJson['autoload'])) {
        $composerJson['autoload'] = [];
    }

    // Check if psr-4 key exists
    if (!isset($composerJson['autoload']['psr-4'])) {
        $composerJson['autoload']['psr-4'] = [];
    }

    // Search for the specified namespace and update its directory
    foreach ($composerJson['autoload']['psr-4'] as $existingNamespace => $existingDirectory) {
        if ($existingNamespace === $namespace) {
            $composerJson['autoload']['psr-4'][$existingNamespace] = $directory;

            // Save the modified composer.json file
            file_put_contents($composerJsonPath, json_encode($composerJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

            // Regenerate Composer's autoload files
            shell_exec('composer dump-autoload');
            return; // Exit function once updated and dumped
        }
    }

    echo "Namespace '$namespace' not found in autoload configuration.";
}

// Example usage
$namespace = "Magnet\\Admin\\";
$directory = "administration33/";

updateComposerAutoload($namespace, $directory);

?>
