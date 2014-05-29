Yii 2 Aws wrapper
=================
wrapper for yii aws

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist bryglen/yii2-aws "*"
```

or add

```
"bryglen/yii2-aws": "*"
```

to the require section of your `composer.json` file.

in your main.php, your configuration would look like this

```php
'components' => [
	'aws' => [
		'class' => 'bryglen\aws\BaseAws',
		'key' => 'your_key',
		'secret' => 'your_secret',
		'region' => 'your_region',
		// optional config file
		//'configFile' => require_once('/path/to/aws.config.php'),
	]
]
```


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
/* @var $aws \bryglen\aws\BaseAws */
$aws = Yii::$app->aws;
$s3 = $aws->get('s3');
$s3->putObject(.....)

$ses = $aws->get('ses');
```