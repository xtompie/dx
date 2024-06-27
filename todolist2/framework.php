<script>
Array.prototype.each = function(f) {
    return this.forEach(f);
}
DocumentFragment.prototype.one = function(s) {
    return this.querySelector(s);
}
HTMLElement.prototype.attr = function(a, v) {
    if (v === undefined) {
        return this.getAttribute(a);
    } else {
        this.setAttribute(a, v);
        return this;
    }
}
HTMLElement.prototype.all = function(s) {
    return Array.from(this.querySelectorAll(s));
}
HTMLElement.prototype.up = function(s) {
    return s ? this.closest(s) : this.parentNode;
}
HTMLElement.prototype.one = function(s) {
    return this.querySelector(s);
}
HTMLElement.prototype.tpl = function(s) {
    return this.one(s).content.cloneNode(true);
}
HTMLElement.prototype.component = function() {
    return this.matches('[component]') ? this : this.closest('[component]');
}
HTMLElement.prototype.exec = function(name, ...args) {
    let prefix = this.component().attr('component');
    return eval(`${prefix}.${name}`).apply(this, args);
}
HTMLElement.prototype.emmit = function(name, ...args) {
    if (this !== this.component()) {
        this.component().emmit(name, ...args);
        return;
    }
    let fn = this.component().attr(name);
    if (fn) {
        eval(fn).apply(null, args);
    }
}
HTMLElement.prototype.onec = function(n) {
    return this.one(`[component="${n}"]`);
}
HTMLElement.prototype.allc = function(n) {
    return this.all(`[component="${n}"]`);
}
HTMLElement.prototype.upc = function(name) {
    return this.matches(`[component="${name}"]`) ? this : this.closest(`[component="${name}"]`);
}
// HTMLElement.prototype.f = function() {
//     if (!this._f) {
//         this._f = new Proxy(this, {
//             get: function(e, name) {
//                 return (...args) => e.exec(name, ...args);
//             }
//         });
//     }
//     return this._f;
// }
Object.defineProperty(HTMLElement.prototype, 'fn', {
    get: function() {
        if (!this._fn) {
            this._fn = new Proxy(this, {
                get: function(target, name) {
                    return (...args) => target.exec(name, ...args);
                }
            });
        }
        return this._fn;
    }
});
document.one = function(s) {
    return document.querySelector(s);
};
document.tpl = function(s) {
    return document.one(s).content.cloneNode(true);
};
let app = {};
</script>
