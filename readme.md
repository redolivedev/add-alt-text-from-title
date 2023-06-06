# Stupid Simple Wordpress Plugin for Adding Image Alt Text

## What's the problem?

Images on websites need alt text, and users don't always add alt text when they are uploading images.

## What's a stupid simple solution?

Add image alt text by taking the file name, replacing hyphens with spaces and sentence casing the string.

## How to use

### The first time:

- Download this repo as a zip
- Upload it to your server under `wp-content/plugins` OR use add new plugin - upload and find the .zip file
- Activate it in wordpress

The plugin will run on activation so that's all you need to do.

### When you want to run it again
- Visit `{{your_site_url}}/wp-admin/?generatealttext`

The plugin will only update the alt text of attachments without alt text, so no worries of overwriting alt text you painstakingly added.
