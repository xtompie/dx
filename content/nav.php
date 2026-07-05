<?php
// Sidebar for the docs, by hand. Add a section or a link here.
// Hrefs are relative to the site root; the layout prefixes the base path per page.
return [
    '' => [
        ['Introduction', 'introduction.html'],
    ],
    // The five foundations — principles. Kept at exactly five (mirrors the home page).
    'Foundations' => [
        ['DOM State', 'dom-state.html'],
        ['Event attributes', 'event-attributes.html'],
        ['Action in context', 'action-in-context.html'],
        ['Modularization', 'modularization.html'],
        ['High UX Performance', 'ux-performance.html'],
    ],
    // Toolkits — optional single-file modules you drop in when needed.
    'Toolkits' => [
        ['Util', 'util.html'],   // helper methods on built-in objects
        ['Val', 'val.html'],     // two-way binding between an object and the DOM
    ],
    // Complete, working things to read — smallest first.
    'Examples' => [
        ['Visible', 'visible.html'],
        ['Todo list', 'todo.html'],
        ['Filter', 'filter.html'],
        ['Produce', 'produce.html'],
    ],
    // Longer, article-style write-ups on deeper subjects. Prose with small code blocks.
    'Topics' => [
        ['Scaling', 'scaling.html'],
        ['Without the machinery', 'without-the-machinery.html'],
    ],
];
