---
slug: todo
title: "Todo list"
type: example
tags: [ramp, val, examples]
related: [sibling-state, val, util]
track: examples
order: 10
status: draft
---

# Todo list

<!-- include: content/todo.html -->

<!-- include: content/Todo.js -->

The `todo-item-status` attribute is a contract. The HTML, the JavaScript, and the CSS all use it. The CSS styles the done item straight from the attribute. There is no `active` class toggled in JavaScript, so changing the style never means changing the code.

<!-- include: content/todo.css -->

<div class="todo-demo">
<!-- include-html: content/todo.html -->
</div>
<!-- include-css: content/todo.css -->
<!-- include-js: Util/Util.js -->
<!-- include-js: Val/Val.js -->
<!-- include-js: content/Todo.js -->
