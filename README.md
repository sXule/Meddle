# Meddle

## What is Meddle?

Meddle is a server-side templating engine build in PHP with the front-end developer in mind. It uses a syntax similar to VueJS or Angular having mustache tags for data interpolation and HTML attributes for control structures.

## Why Meddle?

There's already tons of PHP templating engines out there. In fact, PHP itself is a templating engine, so why do we need another one?

Put simply, Meddle is a templating engine with front-end developers in mind. It creates a security barrier between the template designer and the server, and unlike other back-end templating engines, Meddle syntax is kept in HTML attributes and mustache tags, which, if you're familiar with modern JavaScript frameworks like VueJS or Angular, this should be fairly straight forward.

## Basic Usage

### PHP (index.php)
```
<?php

require_once(__DIR__ . '/vendor/autoload.php');

$meddle = new Sxule\Meddle();

echo $meddle->render('mytemplate.html', [
    'names' => [
        'John',
        'Teddy',
        'Jane'
    ]
]);
```

### Template (mytemplate.html)
```
<ul>
  <li mdl-for="name in names">{{ name }}</li>
</ul>
```

### Output

```
<ul>
  <li>John</li>
  <li>Teddy</li>
  <li>Jane</li>
</ul>
```

# Read the [DOCS](https://github.com/sXule/Meddle/tree/master/docs/index.md)
