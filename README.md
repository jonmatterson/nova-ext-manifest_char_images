# Nova Extension: Manifest Character Images

This extension adds manifest character images above the rank logo on the manifest page.

## Requirements

This extension requires:

- Nova 2.6+

## Installation

Copy the entire directory into `applications/extensions/manifest_char_images`.

Add the following to `application/config/extensions.php`:

```
$config['extensions']['enabled'][] = 'manifest_char_images';
```

## Configuration

This mod supports adding a blend for the character images into your background.

To blend the image into a white background, add to `application/config/extensions.php`:

```
$config['extensions']['manifest_char_images'] = [
    'blend' => 'white'
];
```

To blend the image into a black background, add to `application/config/extensions.php`:

```
$config['extensions']['manifest_char_images'] = [
    'blend' => 'black'
];
```

If you would like to add your own blend options using CSS, you can modify `config.php` with additional array entries for custom blends, and then set the blend in `application/config/extensions.php` to use your custom blend.
