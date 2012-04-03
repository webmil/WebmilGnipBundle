WebmilGnipBundle
==========================

Symfony2 bundle for [gnip-php](https://github.com/webmil/gnip-php)

Installation
------------

Add gnip-php and WebmilGnipBundle to your vendors:

    git submodule add https://github.com/webmil/gnip-php.git vendor/gnip-php
    git submodule add https://github.com/webmil/WebmilGnipBundle.git vendor/bundles/Webmil/WebmilGnipBundle

Or add the followings lines to your `deps` file

    // deps
    [WebmilGnipBundle]
        git=git://github.com/webmil/WebmilGnipBundle.git
        target=bundles/Webmil/GnipBundle

    [gnip-php]
        git=git://github.com/webmil/text-language-detect.git

and run:

    $ ./bin/vendors install

Register Namespaces in autoload:

``` php
// app/autoload.php
<?php
$loader->registerNamespaces(array(
    // ...
    'Webmil' => __DIR__.'/../vendor/bundles',
    'Gnip'   => __DIR__.'/../vendor/gnip-php/lib',
    // ...
));
```

Register bundle in kernel:

``` php
// app/AppKernel.php
<?php
public function registerBundles()
{
    return array(
        // ...
        new Webmil\GnipBundle\WebmilGnipBundle(),
        // ...
    );
}
```

Configuration example
---------------------
Add to your config.yml file:

``` yaml
webmil_gnip:
    login: 'login'
    password: 'password'
    datacollectorhost: 'collector_host.gnip.com'
    datacollectors:
        twitter: 1 #collector name and collector id from gnip
        facebook: 2
```

Usage
-----
In controller:

``` php
<?php
// ...
//manage rules
$rulesManager = $this->get('gnip.rules.manager');

//load rules from gnip
$rulesManager->getRules('facebook');

//add rules to gnip
$rulesManager->add('test');
$rulesManager->add(array('tes2','test3'));
$rulesManager->commit();

//remove rule from gnip
$rulesManager->add('tes2')->doRemoveRequest()->commit();

//load feed from gnip
$gnip = $this->get('gnip.loader');
$feed = $gnip->getFeed('facebook'));

//parse feed
$parser = new Parsers\Parser();

//feed will be parsed with FacebookParser class
$parser->parse($feed, 'facebook');
//...
```