# Kirby Customizable Layout plugin

![GitHub release (with filter)](https://img.shields.io/github/v/release/Pixel-Open/kirby-customizable-layout?style=for-the-badge)

[![Dependency](https://img.shields.io/badge/kirby-4.x-cca000.svg?style=for-the-badge)](https://getkirby.com/)

A plugin for [Kirby CMS](http://getkirby.com) to add a customizable layout fields

## Commercial Usage

This plugin is free

## Installation

### Download

[Download the files](https://github.com/Pixel-Open/kirby-customizable-layout/releases) and place them inside `site/plugins/kirby-customizable-layout`.

### Composer

```
composer require pixelopen/kirby-customizable-layout
```

### Git Submodule

You can add the plugin as a Git submodule.

    $ cd your/project/root
    $ git submodule add https://github.com/Pixel-Open/kirby-customizable-layout.git site/plugins/kirby-customizable-layout
    $ git submodule update --init --recursive
    $ git commit -am "Add Kirby Customizable Layout plugin"

Run these commands to update the plugin:

    $ cd your/project/root
    $ git submodule foreach git checkout master
    $ git submodule foreach git pull
    $ git commit -am "Update submodules"
    $ git submodule update --init --recursive

## Options

To add a customizable layout field in your blueprint, you only have to extend `fields/customizable-layout`

For now, you need to add the fieldsets `block-settings` with the following lines in your `/site/config/config.php`:

```php
return [
    'blocks' => [
        'fieldsets' => [
            'custom' => [
                'label' => 'Custom blocks',
                'type' => 'group',
                'fieldsets' => [
                    'block-settings',
                    // Other global custom blocks
                ]
            ],
          'kirby' => [
                'label' => 'Kirby blocks',
                'type' => 'group',
                'fieldsets' => [
                    'heading',
                    'text',
                    'list',
                    'quote',
                    'image',
                    'video',
                    'code',
                    'markdown'
                ]
            ]
        ]
    ]
];
```
You can also add your own fieldsets when you extend the fields, to add the `block-settings` block and all the other block you want to use.


Dont forget to call the snippet in the page where you use the plugin.

```php
<?php snippet('customizable-layout', array('field' => $page->layout()))?>
```


The plugin work with color field from Kirby 4, you must create a new fields with your custom colors at `/site/blueprints/fields/color.yml`:

```yml
type: color
mode: options
options:
  color1: "#color1"
  color2: "#color2"
  color3: "#color3"
  color4: "#color4"
  color5: "#color5"
```