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
var dx = dx || {};
dx.checkone = (function () {
    function checkone(ctx) {
        ctx
            .up('[dx-checkone-space]')
            .all('[dx-checkone-option]')
            .filter(option => option != ctx)
            .each(option => option.checked = false)
        ;
    };
    return checkone;
})();
</script>
