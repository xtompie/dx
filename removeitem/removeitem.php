<?php require_once '../helper/helper.php' ?>
<script>
module = (function (prefix) {
    function remove(ctx) {
        ctx.up(`[${prefix}]`).remove();
    };
    return remove;
})(module.prefix || 'remove');
</script>
