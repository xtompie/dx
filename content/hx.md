---
slug: hx
title: "Hx"
type: page
tags: [htmx, ajax]
related: [event-attributes, action-in-context]
track: tools
order: 40
status: draft
---

# Hx

Hx is [htmx](https://htmx.org/), implemented in the DX pattern. There is one difference between Hx and htmx: htmx scans the page itself and binds `hx-*` attributes, and Hx wires them through a plain event attribute instead.

<!-- source: Hx/Hx.js -->

```html
<button hx-get="/hello" onclick="hx(this, event)">Load</button>
```

Hx covers a subset of htmx.

## Attributes

- `hx-get`, `hx-post`, `hx-put`, `hx-delete`, `hx-patch` name the method and the URL.
- `hx-target` names where the response goes.
- `hx-swap` names how it goes in: `innerHTML`, `outerHTML`, `append`, `prepend`, or `none`.
- `hx-select` picks part of the response out, by selector.
- `hx-indicator` names an element shown while the request is in flight.
- `hx-disable` stops the element from triggering a request at all.

## Event binding

`hx(this, event)` sits in the event attribute, the same as any DX handler. `event` is optional. It is needed to stop a `<form>`, an `<a>`, or a `<button>` inside a `<form>` from also doing its own submit or navigation.

## Native semantics

A plain `<a href>` sends a GET to that URL, with no `hx-*` attribute needed. A plain `<form>` sends a POST to its `action`, or to the current URL if `action` is missing, with its fields serialized.

## Selectors

`hx-target` and `hx-indicator` take a selector.

`this` is the triggering element.

```html
<button hx-get="/x" hx-target="this" onclick="hx(this, event)">Click</button>
```

`find <selector>` looks inside the triggering element.

```html
<div hx-get="/x" hx-indicator="find .loading">
  <span class="loading" style="display:none">Loading...</span>
</div>
```

`closest <selector> [subselector]` walks up to the nearest matching ancestor, then optionally back down to a child of it.

```html
<button hx-target="closest .panel .content"></button>
```

Anything else is a plain, page-wide selector.

```html
<button hx-target="#output" hx-get="/x" onclick="hx(this, event)">Click</button>
<div id="output"></div>
```

## Example: tabs

Each button loads its own content into one shared container.

```html
<div tab-space hx-target="closest [tab-space] [tab-content]" hx-swap="innerHTML">
  <button hx-get="/tab/1" onclick="hx(this, event)">Tab 1</button>
  <button hx-get="/tab/2" onclick="hx(this, event)">Tab 2</button>
</div>
<div tab-content></div>
```

## Example: load more

The triggering `<li>` replaces itself with the response, which carries its own next-page trigger.

```html
<ul>
  <li>Agent 1</li>
  <li hx-target="this" hx-get="/contacts/?page=3" hx-swap="outerHTML" hx-indicator="find .htmx-indicator">
    <button onclick="hx(this, event)">Load more</button>
    <img class="htmx-indicator" src="/img/bars.svg" style="display:none">
  </li>
</ul>
```
