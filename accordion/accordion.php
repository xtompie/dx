<?php require_once '../helper/helper.php' ?>
<script>
module = (function(prefix) {
    function item(item) {
        item.up(`[${prefix}-space]`).all([`[${prefix}-item]`]).each(
            i => i.one([`[${prefix}-content]`]).style.display = i === item ? '' : 'none'
        );
    }
    function show(ctx) {
        item(ctx.up(`[${prefix}-item]`));
    }
    function init(ctx) {
        item(ctx.up(`[${prefix}-space]`).one(`[${prefix}-item]`));
    }
    return {
        init,
        show,
    }
})(module.prefix || 'accordion');
</script>