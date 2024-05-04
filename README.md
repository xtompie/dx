# DX

DX - JavaScript Architecture Pattern

- [DX](#dx)
  - [Foundation](#foundation)
    - [1. DOM State](#1-dom-state)
    - [2. Event attibutes](#2-event-attibutes)
    - [3. Action in context](#3-action-in-context)
    - [4. Module Object](#4-module-object)
    - [5. High UX Performance](#5-high-ux-performance)
  - [Examples](#examples)

## Foundation

### 1. DOM State

State is stored in DOM. State is not stored in javascript variables.

```html
<!-- attributes -->
<div ... todo-item-status="done">

<!-- input -->
<input type="text" todo-add-text value="Buy milk"/>

<!-- content -->
<span todo-item-text>Take out the trash</span>
```

### 2. Event attibutes

Events are set in html attributes. Events are not dynamic binded with addEventListener.

```html
<button onclick="todo.add(this)">Add</button>
```

### 3. Action in context

Event have current DOMElement from which operation space can be resolved.

```html
<script>
todo.add = function (ctx) {
    let space = ctx.closest('[todo-space]');
    // ...
    space.querySelector('[todo-add-text]').value = '';
// ...
}
</script>
<!-- ... -->
<div todo-space>
    <!-- ... -->
    <input type="text" todo-add-text />
    <button onclick="todo.add(this)">Add</button>
    <!-- ... -->
</div>
```

### 4. Module Object

Module Object and [IIFE](https://en.wikipedia.org/wiki/Immediately_invoked_function_expression)

```javascript
let accordion = (function() {
    function item(item) {
        // ...
    }
    function show(ctx) {
        // ...
    }
    function init(ctx) {
        // ...
    }
    return {
        init,
        show,
    }
})();
```

### 5. High UX Performance

Zero init time. No jumping interface while loading.

```html
<div accordion-space>
    <!-- ... -->
    <div accordion-item>
        <!-- ... -->
        <div accordion-content style="display:none;">Content2</div>
    </div>
</div>
```

```html
<div accordion-space>
    <!-- ... -->
    <script>accordion.init(document.currentScript)</script>
</div>
```

## Examples

- [Todo List](./example-todo-list.php)
- [Accordion](./example-accordion.php)
- [Render](./dx-render-example.php)
- [Condition](./dx-condition-example-select.php)
- [Removeitem](./dx-removeitem.php)

To run examples clone this repo, go to repo in cli, run `php -S 127.0.0.1:8000`, open `127.0.0.1:8000` in browser.
