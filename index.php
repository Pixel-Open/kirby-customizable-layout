<?php

Kirby::plugin('pixelopen/customizable-layout', [
    'blueprints' => [
        'fields/customizable-layout' => __DIR__ . '/blueprints/fields/customizable-layout.yml',
        'blocks/block-settings' => __DIR__ . '/blueprints/blocks/block-settings.yml',
    ],
    'snippets' => [
        'customizable-layout' => __DIR__ . '/snippets/customizable-layout.php',
    ],
    'translations' => [
        'de' => require __DIR__ . '/translations/en.php',
        'en' => require __DIR__ . '/translations/en.php',
        'fr' => require __DIR__ . '/translations/fr.php',
    ],
]);
