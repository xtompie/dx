---
slug: action-in-context
title: "Action in context"
nav_title: "Action in context"
type: concept
tags: [foundations, context, shared-state]
related: [event-attributes, dom-state, sibling-state]
track: foundations
order: 30
status: draft
---

# Action in context

The event has a current DOM element from which the operating space can be determined.

```html
<div todo-space>
  <input type="text" todo-add-text />
  <button onclick="Todo.Add(this)">Add</button>
</div>

<script>
Todo.Add = (ctx) => {
  const space = ctx.closest('[todo-space]');
  space.querySelector('[todo-add-text]').value = '';
  // ...
};
</script>
```

## Why

**One function serves every instance.**
The same `Todo.Add` runs for one todo list or a hundred on the page. Nothing is created
per widget: no instance, no component object, no per-copy state. The context is worked
out at click time from *where* the event happened, so one piece of code covers them all.

**The element is passed in, not captured.**
The handler receives the triggering element as an argument. There is no `this` to bind,
no closure holding the right scope, no lookup to figure out which copy was clicked. The
handler starts from the exact node the event came from.

**Nesting is the scope.**
From that node the rest is reached by walking the DOM: `closest` up to the space, then
`querySelector` down to the parts. Identical widgets that each need their own state, and
sometimes need to talk to a parent or sibling, are scoped by the surrounding markup
already. There is nothing to wire: the tree that lays the UI out is the same tree that
scopes it.

**No registry to keep.**
The element anchors everything, so there is no map from id to a state object to keep in
step as things are added, moved, or removed. Removing the element leaves nothing behind,
since there was never a second copy to clean up.

**The call stack is short.**
The attribute calls the function directly, so a click leads straight into it. The stack
trace points at the real code, with no framework event system, synthetic event, or
dispatch layer in between.
