<?php

function assets_base() {
    $prefix = RACINE === '' ? '' : '/' . RACINE;
    return $prefix . '/assets/dist/';
}

function vite_asset($entry) {
    $isDev = !file_exists(__DIR__ . '/../Public/assets/dist/manifest.json');
    
    if ($isDev) {
        // Mode développement - Vite dev server
        return "http://localhost:5173/assets/js/{$entry}";
    }
    
    // Mode production - fichiers compilés
    $manifest = json_decode(
        file_get_contents(__DIR__ . '/../Public/assets/dist/manifest.json'), 
        true
    );
    
    $file = "assets/js/{$entry}";
    if (isset($manifest[$file])) {
        return assets_base() . $manifest[$file]['file'];
    }
    
    return '';
}

function vite_client() {
    $isDev = !file_exists(__DIR__ . '/../Public/assets/dist/manifest.json');
    
    if ($isDev) {
        return '<script type="module" src="http://localhost:5173/@vite/client"></script>';
    }
    
    return '';
}

function vite_css($entry) {
    $isDev = !file_exists(__DIR__ . '/../Public/assets/dist/manifest.json');
    
    if ($isDev) {
        // En dev, Vite injecte le CSS automatiquement
        return '';
    }
    
    // Mode production
    $manifest = json_decode(
        file_get_contents(__DIR__ . '/../Public/assets/dist/manifest.json'), 
        true
    );
    
    $file = "assets/js/{$entry}";
    if (!isset($manifest[$file])) {
        return '';
    }
    
    $base = assets_base();
    $output = '';
    $seen = [];
    $stack = [$manifest[$file]];
    
    while (!empty($stack)) {
        $item = array_shift($stack);
        
        if (isset($item['css'])) {
            foreach ($item['css'] as $cssFile) {
                if (!in_array($cssFile, $seen)) {
                    $output .= '<link rel="stylesheet" href="' . $base . $cssFile . '">';
                    $seen[] = $cssFile;
                }
            }
        }
        
        if (isset($item['imports'])) {
            foreach ($item['imports'] as $import) {
                if (isset($manifest[$import]) && !in_array($import, $seen)) {
                    $stack[] = $manifest[$import];
                    $seen[] = $import;
                }
            }
        }
    }
    
    return $output;
}