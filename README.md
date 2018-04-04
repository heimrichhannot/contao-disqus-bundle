# Contao Disqus Bundle

Add the disqus comment system to your contao page.

## Features
* integrates into news article rendering
* stand alone module to integrate wherever you want
* Service for even more custom placement

## Requirements

* Contao 4.4
* PHP 7

## Installation

```
composer require heimrichhannot/contao-disqus-bundle
```

## Setup

### News 

* in your news template (usually `news_full.html5`), add following code:
```
<?php if ($this->disqus_section): ?>
    <?php $this->disqus_section ?>
<?php endif; ?>
```
* in your news archive, active disqus comments and enter disqus forum name

### Module

* create a module with the bundles disqus comments module and enter all need informations
* add module to an article 

### Service

* output the result of the `huh.disqus.renderer` service whereever you want

```php
// Example from DisqusCommentModule (we recommend injecting the service instead of calling it direct from container):

$this->Template->disqus_block = System::getContainer()->get('huh.disqus.renderer')->render($this->disqus_shortname, $this->disqus_identifier);
```


