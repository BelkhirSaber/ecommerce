<?php

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
        return '/assets/dist/' . $manifest[$file]['file'];
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
    if (isset($manifest[$file]['css'])) {
        $output = '';
        foreach ($manifest[$file]['css'] as $cssFile) {
            $output .= '<link rel="stylesheet" href="/assets/dist/' . $cssFile . '">';
        }
        return $output;
    }
    
    return '';
}