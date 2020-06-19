# MetaTags

This is simple package to manipulate with SEO tags, like Open Graph

## Usage

```php
MetaTags::title($title)
            ->description($description)
            ->url($url)
            ->image($src, $width, $height)
            ;
```

Somewhere in template, example in Blade:
```blade
{!! MetaTags::render() !!}
```