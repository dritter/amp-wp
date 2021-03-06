## Function `amp_backcompat_use_v03_templates`

> :warning: This function is deprecated: Use Reader themes instead of old legacy AMP post templates.

```php
function amp_backcompat_use_v03_templates();
```

Add hooks to use legacy AMP post templates from before v0.4.

If you want to use the template that shipped with v0.3 and earlier, you can use this to force that. Note that this may not stick around forever, so use caution and `function_exists`.
 Note that the old legacy post templates from AMP plugin v0.3 should no longer be used. Update to using the current AMP legacy post templates or better yet switch to using a full Reader theme.

### Source

:link: [back-compat/back-compat.php:20](/back-compat/back-compat.php#L20-L24)

<details>
<summary>Show Code</summary>

```php
function amp_backcompat_use_v03_templates() {
	_deprecated_function( __FUNCTION__, '2.0' );
	add_filter( 'amp_customizer_is_enabled', '__return_false' );
	add_filter( 'amp_post_template_dir', '_amp_backcompat_use_v03_templates_callback', 0 ); // Early in case there are other overrides.
}
```

</details>
