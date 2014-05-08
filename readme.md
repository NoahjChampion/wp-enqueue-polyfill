Enqueue Polyfill
================

A WordPress plugin to add conditional polyfills. The plugin adds two functions, `wp_register_polyfill`, and `wp_enqueue_polyfill`.

## wp_register_polyfill($handle, $src, $condition = 'IE', $version = false)

example:
```php
wp_register_polyfill('request-animation-frame', 'http://www.site.com/path/to/polyfill/request-animation-frame.js', 'lt IE 10', '1.0');

wp_enqueue_script('animaiton', 'http://www.site.com/path/to/script/animation.js', array('request-animation-frame'), '1.0', true);
```

## wp_enqueue_polyfill($handle, $src = '', $condition = 'IE', $version = false)

example:
```php
wp_register_polyfill('request-animation-frame', 'http://www.site.com/path/to/polyfill/request-animation-frame.js', 'lt IE 10', '1.0');

wp_enqueue_polyfill('request-animation-frame');
```

In the `head` of the document, both examples output:
```html
<!--[if lt IE 10]>
<script type="text/javascript" src="http://www.site.com/path/to/polyfill/request-animation-frame.js?ver=1.0"></script>
<![endif]-->
```
