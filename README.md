# CP Edit Segment Plugin for Craft CMS 3

This plugin allows users with permission to quickly go to an element's control panel edit URL by adding a segment to 
the end of its URL on the front-end.

This is particularly useful for statically cached sites using things like Varnish or the Blitz plugin, where it's harder 
to sprinkle "Edit this entry" links in your templates for logged-in users.

## Contents

- [License](#license)
- [Requirements](#requirements)
- [Usage](#usage)
- [Settings](#settings)

## License

This plugin is licensed for free under the MIT License.

## Requirements

This plugin requires Craft CMS 3.0.0 or later.

## Usage

Install the plugin from the Craft Plugin Store in your site’s control panel or manually using composer.

```
composer require tinydots/craft-cpeditsegment
```

Once installed, you can append your site's `cpTrigger` on to the end of any URI that belongs to a Craft element, and if 
you're logged in and have permission, you'll be redirected to that element's edit page in the control panel.

For example, to go to the correct page in the control panel to edit http://www.example.com/news/article, visit 
http://www.example.com/news/article/admin.

You can set up a custom trigger value in a plugin config file, which will allow you to also edit the homepage this way. 

## Settings

### Bookmarklet

In the plugin's control panel settings, you will find a bookmarklet link you can click-and-drag to your browsers 
bookmarks bar. This will allow you to visit the correct page in the CP for the current URL in one click.

NOTE: You'll need to replace the bookmarklet if you change the trigger value.

### Configuration Settings

The plugin comes with a config file for a multi-environment way to set the plugin settings. The config file also 
provides more advanced plugin configuration settings. To use it, copy the `config.php` to your project’s main `config` 
directory as `cpeditsegment.php` and uncomment any settings you wish to change.

#### `trigger`

Set a custom trigger to use instead of the General Config's `cpTrigger` value (which defaults to `'admin'`).