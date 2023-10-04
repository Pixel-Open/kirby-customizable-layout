# Kirby Button plugin

A plugin for [Kirby CMS](http://getkirby.com) to add a customizable layout fields

## Commercial Usage

This plugin is free

## Installation

### Download

[Download the files](hhttps://github.com/Pixel-Open/customizable-layout/releases) and place them inside `site/plugins/customizable-layout`.

### Composer

```
composer require pixelopen/customizable-layout
```

### Git Submodule

You can add the plugin as a Git submodule.

    $ cd your/project/root
    $ git submodule add https://github.com/Pixel-Open/customizable-layout.git site/plugins/customizable-layout
    $ git submodule update --init --recursive
    $ git commit -am "Add Kirby Customizable Layout plugin"

Run these commands to update the plugin:

    $ cd your/project/root
    $ git submodule foreach git checkout master
    $ git submodule foreach git pull
    $ git commit -am "Update submodules"
    $ git submodule update --init --recursive

## Options

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


The plugin work with color field from Kirby 4, you can create a new fields with your custom colors at `/site/blueprints/fields/color.yml`:

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

Moreover, you need to adjust the color panel in `tailwind.config.js` according to the color you have set.

## Precisions

The plugin is still in construction, you may experience errors or graphic problems in your frontend
For now, the plugin is intended to work in a container of 1280px for wide screen.