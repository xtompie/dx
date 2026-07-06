---
slug: filter
title: "Filter"
type: example
tags: [example, dom-state]
related: [dom-state, visible]
track: examples
order: 15
status: draft
---

# Filter

<!-- include: content/filter.html -->

<!-- include: content/Filter.js -->

The input is marked with `filter-query`. The handler goes up to the space and reads that element, so it never assumes it was called from the input itself. The trigger can be on the input, on a button next to it, or anywhere inside the space.

Each item carries its search text in the `filter-item` attribute. The query matches that value, not the visible text. So an item can match words it does not show, like a category. Typing `fruit` keeps Apple, Banana, and Cherry.

<div class="filter-demo">
<!-- include-html: content/filter.html -->
</div>
<!-- include-js: Util/Util.js -->
<!-- include-js: content/Filter.js -->
