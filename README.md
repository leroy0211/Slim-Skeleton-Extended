# Slim Framework Skeleton Application

Use this skeleton application to quickly setup and start working on a new Slim Framework application. This application uses:

* Sensio Labs' [Twig](http://twig.sensiolabs.org) template library;
* Fort Rabbit's [SlimController](https://github.com/fortrabbit/slimcontroller) extension wich provides the C of MVC;
* Techsterx [Slim Config - YAML](https://github.com/techsterx/slim-config-yaml) extension for YAML config support.

This skeleton application was built for Composer. This makes setting up a new Slim Framework application quick and easy.

## Install Composer

If you have not installed Composer, do that now. I prefer to install Composer globally in `/usr/local/bin`, but you may also install Composer locally in your current working directory.

<http://getcomposer.org/doc/00-intro.md#installation>

## Install the Application

After you install Composer, run this command from the directory in which you want to install your new Slim Framework application.

    php composer.phar create-project flexsounds/slim-skeleton-extended [my-app-name]

Replace <code>[my-app-name]</code> with the desired directory name for your new application. You'll want to:
* Point your virtual host document root to your new application's `public/` directory.
* Ensure `logs/` and `templates/cache` are web writeable.

That's it! Now go build something cool.

## How to Contribute

### Pull Requests

1. Fork the Slim Skeleton Extended repository
2. Create a new branch for each feature or improvement
3. Send a pull request from each feature branch to the **develop** branch

It is very important to separate new features or improvements into separate feature branches, and to send a
pull request for each branch. This allows us to review and pull in new features or improvements individually.

### Style Guide

All pull requests must adhere to the [PSR-2 standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md).
