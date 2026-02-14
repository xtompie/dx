# Val - Two-Way Data Binding

**Val** enables declarative two-way data binding between JavaScript objects and HTML elements.

## Why Val?

Manually synchronizing data with the DOM is tedious:

```javascript
// Without Val - manual sync
element.querySelector('h1').textContent = data.title;
element.querySelector('img').src = data.image;
// ...and reading back is even worse
```

With Val, you work with objects instead:

```javascript
// With Val - automatic sync
element.vset({ title: "Dog", image: "/dog.jpg" });
const data = element.vget(); // reads current state
```

## Requirements

[Util.js](../Util/Util.js) - DOM utilities

## Quick Start

### 1. The Core: `val-set` and `val-get`

The foundation of Val is simple - you define **how to write** and **how to read** data using custom functions:

```html
<article>
    <h1
        val
        val-set="(data) => this.textContent = data.title"
        val-get="() => ({title: this.textContent})"
    >Cat</h1>
</article>

<script>
const article = dom.one('article');

// Write data to DOM
article.vset({ title: "Dog" });

// Read data from DOM
console.log(article.vget());
// => { title: "Dog" }
</script>
```

**How it works:**
- `val` marks the element for data binding
- `val-set="(data) => ..."` defines how to write data into this element
- `val-get="() => ..."` defines how to read data from this element
- Functions run with `this` bound to the element

That's the entire mechanism! Everything else is just convenience.

### 2. The Problem: Repetition

Writing the same getter/setter for every text field gets tedious:

```html
<h1 val
    val-set="(v) => this.textContent = v.title"
    val-get="() => ({title: this.textContent})">
</h1>
<p val
    val-set="(v) => this.textContent = v.description"
    val-get="() => ({description: this.textContent})">
</p>
<img val
    val-set="(v) => this.src = v.image"
    val-get="() => ({image: this.src})">
```

### 3. The Solution: Fx (Presets)

**Fx** are ready-made getter/setter pairs for common cases. Same behavior, less code:

```html
<article>
    <h1 val val-fx="Text" val-key="title">Cat</h1>
</article>

<script>
dom.one('article').vset({ title: "Dog" });
console.log(dom.one('article').vget());
// => { title: "Dog" }
</script>
```

**What changed:**
- `val-fx="Text"` replaces `val-set`/`val-get` with a preset
- `val-key="title"` specifies which field in the data object
- Same result, cleaner syntax

### 4. Multiple Fields

Let's expand our article with more data (same example, more fields):

```html
<article>
    <h1 val val-fx="Text" val-key="title">Cat</h1>
    <img val val-fx="Img" val-key="image" src="/cat.jpg"/>
    <p val val-fx="Text" val-key="description">Cute animal</p>
</article>

<script>
dom.one('article').vset({
    title: "Dog",
    image: "/dog.jpg",
    description: "Loyal friend"
});

console.log(dom.one('article').vget());
// => { title: "Dog", image: "/dog.jpg", description: "Loyal friend" }
</script>
```

**Available Fx:**
- `Text` - element's textContent
- `Img` - image src attribute
- `Html` - innerHTML
- `Input` - input value
- `Attr` - any attribute (requires `val-attr="attrName"`)

See [ValFx.js](ValFx.js) for the complete list.

### 5. Nested Objects

Use `val-fx="Obj"` to work with nested data structures:

```html
<article>
    <h1 val val-fx="Text" val-key="title">Cat</h1>
    <img val val-fx="Img" val-key="image" src="/cat.jpg"/>

    <div val val-fx="Obj" val-key="author">
        <span val val-fx="Text" val-key="name">Unknown</span>
        <span val val-fx="Text" val-key="email">no-email</span>
    </div>
</article>

<script>
dom.one('article').vset({
    title: "Dog",
    image: "/dog.jpg",
    author: {
        name: "John Doe",
        email: "john@example.com"
    }
});

console.log(dom.one('article').vget());
// => { title: "Dog", image: "/dog.jpg", author: { name: "John Doe", email: "john@example.com" } }
</script>
```

The `Obj` Fx creates a nested object scope - child elements read/write to `data.author` instead of root `data`.

### 6. Arrays and Templates

Use `val-fx="Arr"` with templates to render lists:

```html
<template tag-tpl="tag-item">
    <li val val-fx="Text" val-key="name"></li>
</template>

<article>
    <h1 val val-fx="Text" val-key="title">Cat</h1>
    <ul val val-fx="Arr" val-key="tags" val-tpl="[tag-tpl=tag-item]"></ul>
</article>

<script>
dom.one('article').vset({
    title: "Dog",
    tags: [
        { name: "pet" },
        { name: "animal" },
        { name: "loyal" }
    ]
});
</script>
```

**How it works:**

- `val-tpl="[tag-tpl=tag-item]"` specifies which template to use (by attribute selector)
- Each array item is rendered using the template
- The list automatically updates when you call `vset()`

### 7. Conditional Rendering

Use `val-fx="If"` to show/hide elements based on data:

```html
<article>
    <h1 val val-fx="Text" val-key="title">Cat</h1>

    <div val val-fx="If" val-key="disclaimer">
        <strong>Warning:</strong>
        <span val val-fx="Text" val-key="text">Be careful!</span>
    </div>
</article>

<script>
// Hide disclaimer
dom.one('article').vset({
    title: "Dog"
});

// Show disclaimer with data
dom.one('article').vset({
    title: "Dog",
    disclaimer: { text: "May bark loudly" }
});
</script>
```

When `disclaimer` is `null` or `undefined`, the element is hidden. When it has a value, it's shown and nested fields are populated.

## API Reference

```javascript
// On any HTMLElement with [val] children

element.vset(data)          // Write data to DOM
element.vget()              // Read data from DOM
element.vpatch(data)        // Partial update (merges with current data)
element.vmodify(fn)         // Modify data with a function: fn(currentData) => newData

// Arrays
element.vappend(items, tpl) // Append items to a list
element.vprepend(items, tpl)// Prepend items to a list
```

## Combining Custom and Fx

You can mix both approaches in the same tree:

```html
<article>
    <!-- Using Fx preset -->
    <h1 val val-fx="Text" val-key="title">Cat</h1>

    <!-- Custom getter/setter for special logic -->
    <span
        val
        val-set="(data) => this.textContent = data.count + ' items'"
        val-get="() => ({count: parseInt(this.textContent)})"
    ></span>
</article>
```

## Advanced

For a complete list of available Fx presets, see [ValFx.js](ValFx.js).

### Creating Custom Fx

You can create custom Fx by extending `Val.Fx`:

```javascript
Val.Fx.MyCustomFx = {
    Get: (el, params) => ({ [params.key]: /* read logic */ }),
    Set: (el, data, params) => { /* write logic */ }
};
```

**Parameters (`params`)** are automatically extracted from `val-*` attributes (excluding `val-set`, `val-get`, `val-fx`):

```html
<div val val-fx="MyCustomFx" val-key="field" val-format="uppercase" val-max="100">
```

This becomes:

```javascript
params = {
    key: "field",
    format: "uppercase",
    max: "100"
}
```

So you can pass any custom parameters to your Fx using `val-*` attributes.
