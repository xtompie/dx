# Exports - Configurable Module Pattern

Load JavaScript modules with configuration using one global variable.

## Export

**counter.js:**

```javascript
exports = (function() {
    let count = 0;

    return {
        increment: () => ++count,
        get: () => count
    };
})();
```

**index.html:**

```html
<script src="counter.js"></script>
<script>
    let counter = exports;
    console.log(counter.increment());  // 1
    console.log(counter.increment());  // 2
    console.log(counter.get());        // 2
</script>
```

## Export with configuration

**counter.js:**

```javascript
exports = (function(config = {}) {
    let count = config.initial || 0;

    return {
        increment: () => ++count,
        get: () => count
    };
})(exports);
```

**index.html:**

```html
<script>
    exports = { initial: 10 };
</script>
<script src="counter.js"></script>
<script>
    let counter = exports;
    console.log(counter.increment());  // 11
    console.log(counter.increment());  // 12
    console.log(counter.get());        // 12
</script>
```

**Flow:**

1. Set `exports = { initial: 10 }`
2. Load module - reads `exports` as config
3. Module overwrites `exports` with API
4. Use `counter = exports`
