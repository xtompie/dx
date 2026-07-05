---
slug: modularization
title: "Modularization"
nav_title: "Modularization"
type: concept
tags: [foundations, modules, contract, styling, global-state]
related: [action-in-context, configurable-modules]
track: foundations
order: 40
status: draft
---

# Modularization

A DX unit is one module. It comes together from three parts:

1. The markup: elements tagged with the module's namespaced attributes.
2. The JavaScript: an object built by an [IIFE](https://developer.mozilla.org/en-US/docs/Glossary/IIFE), private inside, public API out.
3. The contract between them: the markup names the attributes and calls the public functions, and the JavaScript reads and writes the DOM through those same attributes.

## The module object

A module is an object built by an IIFE: private inside, public API out. Its name namespaces its attributes.

```javascript
const Accordion = (() => {
  const item = (ctx) => { /* ... */ };
  const Show = (ctx) => { /* ... */ };
  const Init = (ctx) => { /* ... */ };
  return { Init, Show };
})();
```

```html
<div accordion-space>
  <div accordion-item> ... </div>
</div>
```

The module name is also the attribute prefix. `Accordion` is the object. `accordion-*` is the markup. The object and the markup share one name.

## Many on a page

The same module can be placed many times on one page. Each instance keeps its own state.

State is stored in the DOM. Each action finds its space from the current element. So two `accordion-space` blocks on one page do not share state. One is open while the other stays closed. There is no instance list and no id to track. A module is written once and placed as often as the page needs.

## The module signature

A module signature is a compact form of the contract. It lists the DOM skeleton, which is the namespaced attributes and their nesting, and the public functions.

```
<todo-space>
    <todo-item todo-item-status="done|active">
        <onclick="Todo.Toggle(this)">

Todo.Save()
```

Indentation is nesting. The tag name is left out, and only the attributes that matter are shown. Attributes that hold state list their possible values. Public functions appear where they wire into the DOM, as in `onclick="Todo.Toggle(this)"`. A function called from JavaScript instead of the DOM is listed on its own, as with `Todo.Save()`.

The signature is a contract without a type system. It shows the shape a module expects and the functions it exposes. It is the readable form of the attribute namespace, and the one thing to share or ask for to see what a module does.

## Styling through the contract

A module keeps state and structure in attributes. CSS can target those same attributes.

```css
[todo-item][todo-item-status="done"] { opacity: .5; text-decoration: line-through; }
```

A common approach stores UI state in class names that the JavaScript also sets. The CSS and the JavaScript then depend on the same names. A design change that renames a class also requires a change in the JavaScript.

In DX the attribute is the contract. The JavaScript reads and writes the attribute. The CSS styles from it. A restyle needs no change to the JavaScript, even when the design system changes.

## Why

**No module system to set up.**
A module is a plain object returned by an IIFE. There is no `import` graph, no bundler
deciding what ships, no registration step. A module is defined and it is there. Add a
module by adding a script; remove it by deleting one.

**Globals, on purpose.**
Modules live on the global scope, and that is the point: no IoC container, no event bus, no
indirection nobody asked for. The prefix is the whole convention that keeps names apart,
the same way BEM keeps CSS class names apart, by agreement, not by tooling.
