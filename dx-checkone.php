<script>
var dx = dx || {};
dx.checkone = (function () {
    function checkone(ctx) {
        Array.from(
            dx.space(ctx, '[dx-checkone-space]').querySelectorAll('[dx-checkone-option]')
        )
            .filter(option => option != item)
            .forEach(option => option.checked = false)
        ;
    };
    return checkone;
})();
</script>
