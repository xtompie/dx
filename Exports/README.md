# Exports - Configurable Module Pattern

A lightweight pattern for creating configurable JavaScript modules without polluting the global namespace.

## Why Exports?

Traditional approach creates global variables:

```javascript
// ❌ Pollutes global namespace
var myCounter = 0;
function increment() { myCounter++; }
function getValue() { return myCounter; }
```

**Exports pattern** uses IIFE (Immediately Invoked Function Expression) to encapsulate code:

```javascript
// ✅ Clean, no global pollution
exports = (function() {
    let counter = 0;  // private
    return {
        increment: () => counter++,
        getValue: () => counter
    };
})();
```

## Basic Usage

### 1. Simple Export (No Configuration)

```javascript
exports = (function() {
    function greet(name) {
        return `Hello, ${name}!`;
    }

    function farewell(name) {
        return `Goodbye, ${name}!`;
    }

    return {
        greet,
        farewell
    };
})();

// Usage
exports.greet("World");      // "Hello, World!"
exports.farewell("Friend");  // "Goodbye, Friend!"
```

**Benefits:**
- No global variables besides `exports`
- Private implementation details (variables, helper functions)
- Clean public API

### 2. Configurable Export (With Arguments)

Pass configuration before loading the module:

```javascript
// 1. Set configuration BEFORE loading module
exports = { prefix: '>>>' };

// 2. Module reads configuration
exports = (function(prefix) {
    function log(message) {
        console.log(`${prefix} ${message}`);
    }

    function warn(message) {
        console.log(`${prefix} [WARN] ${message}`);
    }

    return {
        log,
        warn
    };
})(exports.prefix || '---');  // Default fallback

// 3. Use the configured module
exports.log("Started");   // ">>> Started"
exports.warn("Error");    // ">>> [WARN] Error"
```

**How it works:**
1. Define `exports` as a config object
2. IIFE reads `exports.prefix` as parameter
3. IIFE returns new API and **overwrites** `exports`

## Encapsulation with IIFE

### Private vs Public

```javascript
exports = (function() {
    // PRIVATE - not accessible outside
    let privateCounter = 0;

    function privateHelper() {
        return privateCounter * 2;
    }

    // PUBLIC - returned in API
    function increment() {
        privateCounter++;
    }

    function getDouble() {
        return privateHelper();  // Can use private function
    }

    return {
        increment,    // ✅ Public
        getDouble     // ✅ Public
        // privateCounter and privateHelper are NOT exported
    };
})();

exports.increment();
exports.getDouble();        // Works
exports.privateCounter;     // ❌ undefined - not accessible
exports.privateHelper();    // ❌ Error - not a function
```

## Complete Example: Counter Module

**counter.js:**
```javascript
exports = (function(config) {
    // Private state
    let count = config.initial || 0;
    const step = config.step || 1;

    // Private helper
    function clamp(value) {
        if (config.min !== undefined && value < config.min) return config.min;
        if (config.max !== undefined && value > config.max) return config.max;
        return value;
    }

    // Public API
    function increment() {
        count = clamp(count + step);
        return count;
    }

    function decrement() {
        count = clamp(count - step);
        return count;
    }

    function get() {
        return count;
    }

    function reset() {
        count = config.initial || 0;
        return count;
    }

    return {
        increment,
        decrement,
        get,
        reset
    };
})(exports || {});
```

**Usage:**

```javascript
// Default configuration
exports.increment();  // 1
exports.increment();  // 2
exports.get();        // 2
exports.reset();      // 0
```

**With custom configuration:**

```javascript
// Configure before loading
exports = {
    initial: 10,
    step: 5,
    min: 0,
    max: 20
};

// Load module (counter.js)
// ... module code ...

// Use configured module
exports.increment();  // 15
exports.increment();  // 20 (clamped to max)
exports.increment();  // 20 (stays at max)
exports.decrement();  // 15
```

## Pattern Structure

```javascript
// Step 1: Optional configuration
exports = {
    option1: value1,
    option2: value2
};

// Step 2: Module definition (IIFE)
exports = (function(config) {
    // Private variables
    const privateVar = 'hidden';

    // Private functions
    function privateHelper() {
        // ...
    }

    // Public API
    function publicMethod() {
        // Can access private variables and functions
        return privateHelper();
    }

    // Return public API
    return {
        publicMethod
        // privateVar and privateHelper are NOT accessible
    };
})(exports || {});  // Pass config or empty object

// Step 3: Use the module
exports.publicMethod();
```

## Key Concepts

### 1. IIFE Encapsulation
- Code runs immediately: `(function() { ... })()`
- Creates private scope
- Only returned values are accessible

### 2. Configuration
- Set `exports` before loading module
- Module reads it as parameter
- Provides default fallback: `exports || {}`

### 3. Self-Replacement
- `exports` starts as config object
- Module overwrites it with API
- Clean transition from config to API

### 4. Single Global Variable
- Only `exports` is global
- Everything else is encapsulated
- Prevents naming conflicts

## Advantages

✅ **No global pollution** - only `exports` variable
✅ **Private state** - encapsulated in IIFE closure
✅ **Configurable** - pass options before loading
✅ **Clean API** - only expose what's needed
✅ **Simple** - no build tools or module loaders required
✅ **Browser-friendly** - works in plain HTML/JS

## Common Use Cases

- **UI Components** - configurable prefix for CSS classes/attributes
- **Utilities** - libraries with optional configuration
- **Widgets** - customizable behavior
- **Services** - API clients with base URL configuration
