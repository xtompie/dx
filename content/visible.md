---
slug: visible
title: "Visible"
type: example
tags: [example, dom-state]
related: [dom-state, event-attributes, modularization]
track: examples
order: 5
status: draft
---

# Visible

Show one set of elements and hide the rest. The current mode is written to the DOM as `visible-state`. The active view is readable there, with no JavaScript variable holding it.

Regions carry a `visible-tag` inside a shared `visible-space`. `Visible.Visible(ctx, tags)` shows every `[visible-tag]` listed in `tags`, hides the others, and writes `tags` to `visible-state`. `Visible.Toggle(ctx, when, then, otherwise)` reads that state. When it includes `when` the `then` set is shown, else the `otherwise` set.

<!-- include: Visible/Visible.js -->

## Tabs

One panel shows at a time. Each button selects its tag.

```html
<div visible-space visible-state="account">
  <button onclick="Visible.Visible(this, ['account'])">Account</button>
  <button onclick="Visible.Visible(this, ['billing'])">Billing</button>
  <button onclick="Visible.Visible(this, ['team'])">Team</button>

  <section visible-tag="account">Account settings.</section>
  <section visible-tag="billing" style="display:none">Billing details.</section>
  <section visible-tag="team" style="display:none">Team members.</section>
</div>
```

## Accordion

Each header toggles its panel. Opening one closes the rest.

```html
<div visible-space visible-state="shipping">
  <button onclick="Visible.Toggle(this, 'shipping', [], ['shipping'])">Shipping</button>
  <div visible-tag="shipping">Ships in two days.</div>

  <button onclick="Visible.Toggle(this, 'returns', [], ['returns'])">Returns</button>
  <div visible-tag="returns" style="display:none">Thirty day returns.</div>
</div>
```

## Radio with an "Other" option

The extra input shows only when Other is selected.

```html
<div visible-space visible-state="">
  <label><input type="radio" name="reason" onclick="Visible.Visible(this, [])"> Refund</label>
  <label><input type="radio" name="reason" onclick="Visible.Visible(this, [])"> Exchange</label>
  <label><input type="radio" name="reason" onclick="Visible.Visible(this, ['other'])"> Other</label>

  <input visible-tag="other" style="display:none" placeholder="Tell us more">
</div>
```
