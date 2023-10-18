<p align="center">
    <h1 align="center">CodeIgniter3 PSR-4 Autoload</h1>
</p>

CodeIgniter 3 PSR-4 Autoloader for Application


REQUIREMENTS
------------

This library requires the following:

- PHP 5.3.0+
- CodeIgniter 3.1.0+

---


INSTALLATION
------------

Run Composer in your Codeigniter project under the folder `\application`:

    composer require xzb/codeigniter3-psr4-autoload
    
Check Codeigniter `application/config/config.php`:

```php
$config['composer_autoload'] = TRUE;
```
    
> You could customize the vendor path into `$config['composer_autoload']`

---