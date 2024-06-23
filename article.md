# The current frontend tech stack is a scam

This is about JavaScript in the UI context, not CSS.

## The current situation

It is 2024.
We have fancy frameworks and build tools.
They provide some functionality but also introduce a lot of new problems.
The node_modules directory can take up to 1 GB of space.
The built app.js file can be as large as 666 KB.
You buy a new MacBook M1 and npm run install fails (node-sass).
Sometimes npm run install fails due to C++ compilation errors.
I'm developing a dropdown in JS, so why is there C++ compilation involved? o.O
There are framework features that you need to understand.
Debugging may require additional tools.
Over time, more data/elements will need to be handled and performance problems will arise.
The very first time you deploy an application to production, your framework may be outdated and lacking the latest super functionality.
You become locked into an old framework version and may remain there indefinitely.
I believe everyone can add their own experiences and challenges to this list.

Maybe it's a low price for what we can have in return.
And in return (not always), we have a UI that takes 7 seconds to load.
It consumes huge amounts of CPU resources.
During the loading time, we see 9 different frames, elements are jumping, two different loading spinners,
and one skeleton placeholder. By the way, the skeleton should never have been invented.
Games often warn about photosensitive epilepsy, maybe websites should too?
Then we need another code that will test component initialization time.

Some can say that "todays applications are complicated". What exactly is complicated? Hidding div? Increment some value? Fetching and rendering data? Nope. It is easy.

## Architecture drivers

Now let's define the architecture drivers that we want:

- Easy build process or even no build.
- Simple codebase, easy to understand.
A new person in the project should be productive quickly.
Even backend developers should be able to make simple changes or add new features.
- Low number of dependencies.
- Easy to debug.
- Must be easy to maintain for years.
- Instant UI initialization without jumping elements.
- The page should show instantly, and users must be able to interact with the interface immediately.

## DX

DX - JavaScript Architecture Pattern

[https://github.com/xtompie/dx](https://github.com/xtompie/dx)

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

This is easy to track and understand.

Something like theme can be set in `<body theme="light">` or `document.body.dataset.theme = 'light'`.

### 2. Event attibutes

Events are set in HTML attributes.
Events are not dynamically bound with addEventListener.

```html
<button onclick="todo.add(this)">Add</button>
```

Setting event attributes eliminates the need for binding code. It makes it easier to track what is happening in the application. There is no need to bind listeners when appending HTML code to the DOM.

### 3. Action in context

The event has a current DOM element from which the operating space can be determined.

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

### 4. Modularization

Module Object and [Immediately Invoked Function Expression](https://en.wikipedia.org/wiki/Immediately_invoked_function_expression) for modularity and encapsulation.

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

Modular attribute names

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

### Example todo list

<https://github.com/xtompie/dx/tree/master/todolist>

### Explanation

Build process is not required. Perhaps only the removal of comments and minification.

The DX pattern is a UI layer that can invoke the business logic layer.

DX components can be specific, like the [todolist](https://github.com/xtompie/dx/tree/master/todolist), or more generic, like [visible](https://github.com/xtompie/dx/blob/master/visible/).

Debugging is easy. The stack trace is complete and readable.

The code is simple. For the [sender](https://github.com/xtompie/dx/blob/master/sender/) component, all sender functions were generated by Copilot.

Pollution of the global scope can be minimized to one variable, e.g.

```javascript
var app = app || {};
app.cart = (function () {
    function add() {
        // ...
    }
    return {
        add,
    }
})();
app.catalog = (function () {
    // ...
})();
app.user = (function () {
    // ...
})();
```

Each module can be stored in a separate file and loaded on the page only when needed.

DX has a low cost and is fast to develop.

DX is not suitable for CV-driven development.

If you can't build an SPA without a framework, DX will be challenging for you with larger applications.
