---
slug: util
title: "Util"
type: page
tags: [util]
related: [val, dom-state]
track: tools
order: 30
status: draft
---

# Util

Helper methods on built-in objects like `HTMLElement` and `Array`.

## Without Util

```javascript
document.querySelectorAll('[todo-item]').forEach(el => {
  const status = el.getAttribute('data-status');
  el.setAttribute('data-status', status === 'done' ? 'active' : 'done');
});
```

## With Util

```javascript
dom.al('[todo-item]').each(el => el.attrt('data-status', 'done', 'active'));
```

<!-- include: Util/Util.js -->
