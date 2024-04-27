<script>
var dx = dx || {};
dx.space = function (ctx, selector) {
    if (ctx.matches(selector)) {
        return ctx;
    }
    return ctx.closest(selector) || document;
};
</script>
