# CSV Praser/Writer

This is a simple CSV Parser/Writer with which you can merge one or multiple CSV file headers and map their data to their corresponding header. In case there is no data for the header after merging, an empty data field will be the default value.

## Installation

Use dependency manager [composer](https://getcomposer.org/) to install autoloader.

```bash
composer dump-autoload
```

## Usage

Add your file path in add() method found in demo/index.php. You can add one file in one method once. To use multiple files, use add() method twice and so on.

Example usage for one file:

```php
$reader->add('Your/File/Path.csv');

```

Example usage for two files:

```php
$reader->add('Your/File/Path.csv');
$reader->add('Your/File/Path.csv');
```

To chose where to save the file, use save() method below add() methods in demo/index.php. This method will overwrite everything in an existing csv file or attempt to create a new file if there is no CSV file with the specified name in the path you specify.

Example usage:

```php
$writer->save('Path/Where/To/Save/Your/FileName.csv');
```

## License

[MIT](https://choosealicense.com/licenses/mit/)
