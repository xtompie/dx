<?php require_once '../helper/helper.php' ?>
<script>
module = (function (prefix) {
    function visible(ctx, tags) {
        const space = ctx.up(`[${prefix}-space]`);
        space.all(`[${prefix}-tag]`).each(function (el) {
            el.style.display = tags.includes(el.attr(`${prefix}-tag`)) ? '' : 'none';
        });
        space.attr(`${prefix}-state`, tags.join(' '));
    };
    function toggle(ctx, when, then, otherwise) {
        const space = ctx.up(`[${prefix}-space]`);
        visible(space, space.attr(`${prefix}-state`).split(' ').includes(when) ? then : otherwise);
    };
    return {
        visible,
        toggle,
    }
})(module.prefix || 'visible');
</script>
