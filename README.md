<img src="src/icon.svg" alt="icon" width="100" height="100">

# Contact Form Templates plugin for Craft CMS 3

Custom email templates for the Craft CMS Contact Form plugin

## Requirements

This plugin requires Craft CMS 3.0.1 or later and [Contact Form 2.1.1](https://github.com/craftcms/contact-form) or later.

## Installation

To install the plugin, either install via the plugin store or follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require lukeyouell/craft-contactformtemplates

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Contact Form Templates.

## Using Contact Form Templates

To use a custom email template simply add the following field to your form:

```twig
<input type="hidden" name="template" value="{{ 'path/to/template'|hash }}">
```

The `template` value is used to source the template file located in `templates/_emails`, this value must be hashed to avoid tampering.

#### Example

```twig
<input type="hidden" name="template" value="{{ 'foo/bar'|hash }}">
```

Would look for the following template:

```twig
templates/_emails/foo/bar.twig
```

### Template Variables

The submitted field values are available for use in your templates by using `{{ submission }}`

#### Example

```twig
<input type="text" name="fromName" value="Joe Bloggs">
```

Would be used in your templates using:

```twig
{{ submission.fromName ?? 'Fallback Value' }}
```

Which would output:

```twig
Joe Bloggs or Fallback Value
```

## Contact Form Templates Roadmap

Some things to do, and ideas for potential features:

Brought to you by [Luke Youell](https://github.com/lukeyouell)
