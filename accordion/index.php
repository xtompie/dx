<script>
HTMLElement.prototype.up = function(s) {
    return this.closest(s);
}
HTMLElement.prototype.one = function(s) {
    return this.querySelector(s);
}
HTMLElement.prototype.all = function(s) {
    return Array.from(this.querySelectorAll(s));
}
Array.prototype.each = function(f) {
    return this.forEach(f);
}
let accordion = (function() {
    function item(item) {
        item.up('[accordion-space]').all(['[accordion-item]']).each(
            i => i.querySelector(['[accordion-content]']).style.display = i === item ? '' : 'none'
        );
    }
    function show(ctx) {
        item(ctx.up('[accordion-item]'));
    }
    function init(ctx) {
        item(ctx.up('[accordion-space]').one('[accordion-item]'));
    }
    return {
        init,
        show,
    }
})();
</script>

<div accordion-space>
    <div accordion-item>
        <div onclick="accordion.show(this)">1</div>
        <div accordion-content>Content1</div>
    </div>
    <div accordion-item>
        <div onclick="accordion.show(this)">2</div>
        <div accordion-content>Content2</div>
    </div>
    <script>accordion.init(document.currentScript)</script>
</div>

