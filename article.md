# Current fronted is a scam

It is about JavaScript in UI context and not about CSS.

## The current picture

It is 2024.
We have fancy frameworks and build tools.
They give some functionality and a lot of of new problems.
Directory node_module can take 1 GB.
Built app.js can take 666 KB.
You buy new MacBook M1 and npm run install fails (node-sass).
Sometimes npm run install fails because C++ compilation fails.
Im developing a dropdown in JS, why there is some C++ compliation? o.O
Frameworks features that u need to understand.
Debugging with additional tools.
Performance issues when requirements about amount of data increase over time.
When u go to production with your app, your framework is outdated and you dont have lates super functionalities.
You are locked to old framework version and u will be there forever.
I think everyone can add their own things here.

Maybe it's a low price for what we can have in return.
And in return (not always), we have an UI that takes 7 seconds to load.
It consumes huge amounts of CPU resources.
In loading time we see 9 different frames. Elements are jumping, two different loading spinners.
One skeleton placeholder. Btw. skeleton should never been invented.
Games often warn about photosensitive epilepsy, maybe websites should too?
Then we need to another code that will test components initialization time.

Some can say that "todays applications are complicated". What exacly is complicated? Hidding div? Increment some value? Fetching and rendering data? Nope. It is easy.

## Architecture drivers

Now lets defined the architecure drivers that we want.

Easy build process or even no build.
Simple codebase, easy to understand.
A new person in the project should be productive quickly.
Even backend developer could do simple changes or add new features.
Low number of dependecies.
Easy to debug.
Must be easy to maintain for years.
Instant UI initialization without jumping elements.
The page should show instatnly and user must be able to interact with the interface immediately.

## DX

DX - JavaScript Architecture Pattern

[https://github.com/xtompie/dx](https://github.com/xtompie/dx)

### 1. DOM State

State is stored in DOM.
State is not stored in javascript variables.

```html
<!-- attributes -->
<div ... todo-item-status="done">

<!-- input -->
<input type="text" todo-add-text value="Buy milk"/>

<!-- content -->
<span todo-item-text>Take out the trash</span>
```

Or state stored in HTMLElement.dataset

This is easy to track and understand.

Something like theme can be set in `<body theme="light">` or `document.body.dataset.theme = 'light'`.

### 2. Event attibutes

Events are set in html attributes.
Events are not dynamic binded with addEventListener.

```html
<button onclick="todo.add(this)">Add</button>
```

Setting event attributes eliminates binding code.
What is happenig in application is easy to track.
No need to bind listeners when appending html code to DOM.

### 3. Action in context

The event has a current DOMElement from which the operating space can be determined.

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

Module Object and [Immediately Invoked Function Expression](https://en.wikipedia.org/wiki/Immediately_invoked_function_expression) for modularity and encapsulation

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

Build process is not required. Maybe just the removal of comments and minification.

DX pattern is an UI layer. This layer can invoke the business logic layer.

DX components can be specific like [todolist](https://github.com/xtompie/dx/tree/master/todolist) or more generic like [visible](https://github.com/xtompie/dx/blob/master/visible/).

The debug is easy. Stacktrace is complete and readable.

The code is simple. For [sender](https://github.com/xtompie/dx/blob/master/sender/) component all sender function was generated by Copilot.

Pollution of the global scope can be minimized to one variable e.g.

```javascript
var app = app || {};
app.cart = (function () {
    function add() {
        // ...
    }
    return {
        add,
    }
});
app.catalog = (function () {
    // ...
});
app.user = (function () {
    // ...
});
```

Each module can be stored in separate file and load on page only when needed.

DX has low cost and it is fast to develop.

DX is bad for CV driven development.

If you cant build SPA without framework the DX will be difficult for you with larger applications.
