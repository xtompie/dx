---
slug: scaling
title: "Scaling"
type: topic
tags: [scaling]
track: topics
order: 10
status: draft
---

# Scaling

## One global

Every module on the global scope means many names, and the risk of a collision.

One `App` object holds them all.

```javascript
const App = {};
App.Todo = (() => { /* ... */ })();
App.Filter = (() => { /* ... */ })();
```

Calls read `App.Todo.Add(this)`. The global scope holds one name.

## Reusing a module

`Visible` reads a fixed `visible-*`. Written to take its config through the one global `exports`, the same file serves more than one instance.

```javascript
// visible.js
exports = (function (config = {}) {
    const p = config.prefix || 'visible';
    const Toggle = (ctx) => { /* uses ${p}-space, ${p}-tag */ };
    return { Toggle };
})(exports);
```

PHP pastes the source into one JavaScript file. Before each paste it sets `exports` to the config; after, it takes the API.

```php
const App = {};

exports = { prefix: 'menu' };
<?php echo file_get_contents('visible.js') ?>
App.Menu = exports;

exports = { prefix: 'panel' };
<?php echo file_get_contents('visible.js') ?>
App.Panel = exports;
```
