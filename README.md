# WP Rest Explorer
Provides a user interface to check WordPress JSON API endpoint and their attributes. 

## Installation
### Add repository to your project composer.json file 
```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/shazzad/wp-rest-explorer"
    }
  ],
  "require": {
    "shazzad/wp-rest-explorer": "dev-main"
  }
}
```

### Install dependencies

```shell
$ composer install
```

## Usage
### Enqueue css/js
```php
Shazzad\WP_Rest_Explorer\Rest_Explorer::register_scripts();
Shazzad\WP_Rest_Explorer\Rest_Explorer::enqueue_scripts();
```

### Render Ui
```php
Shazzad\WP_Rest_Explorer\Rest_Explorer::render( 
  rest_url( 'wp/v2/posts' ),
  array(
    'title' => 'Posts API (V2)'
  )
);
```
