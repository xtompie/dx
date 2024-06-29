<script>
Array.prototype.each = function(f) {
    return this.forEach(f);
}
HTMLElement.prototype.all = function(s) {
    return Array.from(this.querySelectorAll(s));
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
HTMLElement.prototype.state = function(namespace, state) {
    this.dataset[namespace] = this.dataset[namespace] || {};
    if (state === undefined) {
        return this.dataset[namespace];
    } else {
        this.dataset[namespace] = state;
        return this;
    }
}
HTMLElement.prototype.up = function(s) {
    return this.closest(s);
}
const visible = (function(){
    function visible(ctx, tags) {
        const space = ctx.up('[visible-space]');
        space.all('[visible-tag]').each(function (el) {
            el.style.display = tags.includes(el.attr('visible-tag')) ? '' : 'none';
        });
        space.attr('visible-state', tags.join(' '));
    };
    function toggle(ctx, when, then, otherwise) {
        const space = ctx.up('[visible-space]');
        visible(space, space.attr('visible-state').split(' ').includes(when) ? then : otherwise);
    };
    return {
        visible,
        toggle,
    }
})();
</script>
