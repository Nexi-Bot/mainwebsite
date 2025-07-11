<?php
// Simple router for PHP development server
$request_uri = $_SERVER['REQUEST_URI'];
$path = parse_url($request_uri, PHP_URL_PATH);

// Remove leading slash
$path = ltrim($path, '/');

// Handle clean URLs for development
switch($path) {
    case '':
    case 'home':
        include 'index.php';
        break;
    case 'features':
        include 'features.php';
        break;
    case 'careers':
        include 'careers.php';
        break;
    case 'team':
        include 'team.php';
        break;
    case 'legal':
        include 'legal.php';
        break;
    case 'coming-soon':
        include 'coming-soon.php';
        break;
    case '401':
        include '401.php';
        break;
    case '403':
        include '403.php';
        break;
    case '404':
        include '404.php';
        break;
    case '500':
        include '500.php';
        break;
    case '502':
        include '502.php';
        break;
    case '503':
        include '503.php';
        break;
    case 'error':
        include 'error.php';
        break;
    default:
        // Check if it's a file that exists
        if (file_exists($path)) {
            return false; // Let PHP serve the file
        }
        // Check if it's a PHP file without extension
        if (file_exists($path . '.php')) {
            include $path . '.php';
        } else {
            include '404.php';
        }
        break;
}
?>
