# Contao disqus bundle

Add the disqus comment system to your contao page.

## Features
* integrates into news article rendering
* stand alone module to integrate wherever you want

## Requirements

* Contao 4.4
* PHP 7

## Usage

### Installation

Via composer:

```
composer require heimrichhannot/contao-disqus-bundle
```

### Setup

#### News 

* in your news template (usually `news_full.html5`), add following code:
```
<?php if ($this->disqus_section): ?>
    <?php $this->disqus_section ?>
<?php endif; ?>
```
* in your news archive, active disqus comments and enter disqus forum name

#### Custom

* create a module with the bundles disqus comments module and enter all need informations
* put module on the page you like