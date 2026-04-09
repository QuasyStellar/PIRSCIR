<?php
// server_utils.php

function getCommandOutput(string $command): string {
    $output = shell_exec($command);
    return $output !== null ? $output : "Error executing command: {$command}";
}

function getWhoami(): string {
    return getCommandOutput('whoami');
}

function getId(): string {
    return getCommandOutput('id');
}

function getRunningProcesses(): string {
    return getCommandOutput('ps aux');
}

function getDirectoryListing(string $path = '.'): string {
    return getCommandOutput('ls -la ' . escapeshellarg($path)); // Using escapeshellarg for basic safety
}
?>