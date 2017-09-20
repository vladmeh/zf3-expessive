# Expressive Skeleton
#### [Rapid Enterprise App Development with Zend Expressive](https://www.sitepoint.com/rapid-enterprise-app-development-zend-expressive/)

```cmd
composer create-project zendframework/zend-expressive-skeleton expressive
```

В процессе установки Вам будет предложено принять несколько решений. Используйте эти ответы:

* What type of installation would you like?
  * Modular
* Which container do you want to use for dependency injection?
  * Zend ServiceManager
* Which router do you want to use?
  * Zend Router
* Which template engine do you want to use?
  * Twig
* Which error handler do you want to use during development?
  * Whoops
* Please select which config file you wish to inject ‘Zend\Validator\ConfigProvider’ into?
  * config/config.php
* Remember this option for other packages of the same type?
  * y

Затем в консоли запустите следующие команды:

```cmd
cd expressive
git init
git config color.ui true
git add .
git commit -m "Initial commit"
chmod -R +w data;
```

Запустите php-сервер для тестирования с помощью

```cmd
composer serve
```