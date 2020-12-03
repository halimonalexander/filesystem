# Filesystem

Filesystem fetcher library that can help with fetching files, directories or
both of them from a provided path.

Additional filters can be applied to the response to get more sensetive results.

## Usage:

```php
use HalimonAlexander\Filesystem\Filesystem;
use HalimonAlexander\Filesystem\Filters\ExtensionFilter;

$filesystem = new Filesystem();
$files = $filesystem
    ->enter('/var/log/mysql/')
    ->files()
    ->filter(new ExtensionFilter('log'))
    ->get();

$folders = $filesystem
    ->enter('/var/www/app/')
    ->directories()
    ->get();

$foldersWithFiles = $filesystem
    ->enter('/etc/nginx/')
    ->get();
```

## Filters:

### ExtensionFilter
Can be applied for files only to filter by provided file extension.
In other cases will throw an error.

```php
use HalimonAlexander\Filesystem\Filesystem;
use HalimonAlexander\Filesystem\Filters\ExtensionFilter;

$filesystem = new Filesystem();
$files = $filesystem
    ->enter('/var/log/mysql/')
    ->files()
    ->filter(new ExtensionFilter('log'))
    ->get();
```

### RegexpFilter

Can be applied to any type of result.

```php
use HalimonAlexander\Filesystem\Filesystem;
use HalimonAlexander\Filesystem\Filters\RegexpFilter;

$filesystem = new Filesystem();
$files = $filesystem
    ->enter('/var/log/mysql/')
    ->filter(new RegexpFilter('2020-01-01(.*)'))
    ->get();
```

### Combining filters

Filters can be combined to receive the best results.

```php
use HalimonAlexander\Filesystem\Filesystem;
use HalimonAlexander\Filesystem\Filters\ExtensionFilter;
use HalimonAlexander\Filesystem\Filters\RegexpFilter;

$filesystem = new Filesystem();
$files = $filesystem
    ->enter('/var/log/mysql/')
    ->files()
    ->filter(new ExtensionFilter('log'))
    ->filter(new RegexpFilter('2020-01-\d{2}.*'))
    ->filter(new RegexpFilter('\d{4}-\d{2}-d{2}_1.*'))
    ->get();
```