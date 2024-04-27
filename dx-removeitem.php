<script>
var dx = dx || {};
dx.removeitem = (function () {
    function remove(ctx) {
        dx.space(ctx, '[dx-removeitem]').remove();
    };
    return {
        remove,
    };
})();
</script>
