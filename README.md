# Magento 2.2 Sentry Logger

This extension will add the ability to log to [Sentry](https://github.com/getsentry/). Default for the minimal logging level is DEBUG, this is set in the extensions di.xml.
 
Instalation
------------

To install is quite simple, add the **composer.json:**

```
    "diegograssato/magento2-sentry": "*"
```

Next step is to update the composer

```
  composer self-update
```
 
or 

`composer require diegograssato/magento2-sentry`

* Enable the extension: `php bin/magento --clear-static-content module:enable DTuX_Sentry`
* Upgrade db scheme: `php bin/magento setup:upgrade`
* Clear cache `php bin/magento c:f`

## Configuration
* Add the variable 'raven_dns' to your app/etc/env.php file. Example:

```
'raven_dns' => 'https://****@sentry.domain.com/8',
```
