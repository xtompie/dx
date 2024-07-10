<script>
document.all = function(s) {
    return Array.from(document.querySelectorAll(s));
};
document.one = function(s) {
    return document.querySelector(s);
};
Array.prototype.each = function(f) {
    return this.forEach(f);
}
DocumentFragment.prototype.one = function(s) {
    return this.querySelector(s);
}
HTMLElement.prototype.all = function(s) {
    return Array.from(this.querySelectorAll(s));
}
HTMLElement.prototype.allfd = function(s) {
    return Array.from(this.children).reduce((r, e) => {
        return e.matches(s) ? r.concat(e) : r.concat(e.allfd(s));
    }, []);
}
HTMLElement.prototype.attr = function(a, v) {
    if (v === undefined) {
        return this.getAttribute(a);
    } else {
        this.setAttribute(a, v);
        return this;
    }
}
HTMLElement.prototype.one = function(s) {
    return this.querySelector(s);
}
HTMLElement.prototype.tpl = function() {
    return this.content.cloneNode(true);
}
HTMLElement.prototype.up = function(s) {
    if (s === undefined) {
        return this.parentNode;
    }
    if (this.matches(s)) {
        return this;
    }
    let node = this.closest(s);
    if (node) {
        return node;
    }
    return document.body;
}
</script>
