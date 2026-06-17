# DX

DX - JavaScript Architecture Pattern

- [DX](#dx)
  - [Foundation](#foundation)
    - [1. DOM State](#1-dom-state)
    - [2. Event attributes](#2-event-attributes)
    - [3. Action in context](#3-action-in-context)
    - [4. Modularization](#4-modularization)
    - [5. High UX Performance](#5-high-ux-performance)
  - [Component signature](#component-signature)

## Foundation

### 1. DOM State

State is stored in the DOM.
State is not stored in JavaScript variables.

```html
<!-- attributes -->
<div ... todo-item-status="done">

<!-- input -->
<input type="text" todo-add-text value="Buy milk"/>

<!-- content -->
<span todo-item-text>Take out the trash</span>
```

Or state can be stored in HTMLElement.dataset.

State can also be a `_`-prefixed JS property on the element.

```javascript
el._timer = setTimeout(fn, 2000);
clearTimeout(el._timer);
```

Read it off the element, not a module variable.

### 2. Event attributes

Events are set in HTML attributes.
Events are not dynamically bound with addEventListener.

```html
<button onclick="todo.add(this)">Add</button>
```

### 3. Action in context

The event has a current DOM element from which the operating space can be determined.

```html
<script>
todo.add = (ctx) => {
    const space = ctx.closest('[todo-space]');
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

### 4. Modularization

Module Object and [Immediately Invoked Function Expression](https://en.wikipedia.org/wiki/Immediately_invoked_function_expression) for modularity and encapsulation.

```javascript
const accordion = (() => {
    const item = (item) => {
        // ...
    };
    const show = (ctx) => {
        // ...
    };
    const init = (ctx) => {
        // ...
    };
    return {
        init,
        show,
    };
})();
```

Modular attributes names

```html
<div accordion-space>
    <!-- ... -->
    <div accordion-item>
        <!-- ... -->
    </div>
</div>
```

### 5. High UX Performance

Instant initialization, seamless loading interface, responsive interaction.

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

## Component signature

The contract: the DOM skeleton (namespaced attributes + nesting) and the public functions.

```html
< todo-space>
    < todo-item todo-item-status="done|active">
        < onclick="todo.Toggle(this)">
```

- Indentation = nesting. Tag name omitted.
- Attributes that hold state.
- Public functions wired to events (`onclick="todo.Toggle(this)"`).
- Public functions not wired to the DOM (called directly, e.g. a localStorage wrapper) — list them too.
