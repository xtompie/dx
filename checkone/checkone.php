<?php require_once '../helper/helper.php' ?>
<script>
module = (function(prefix) {
    function checkone(ctx) {
        ctx
            .up(`[${prefix}-space]`)
            .all(`[${prefix}-option]`)
            .filter(option => option != ctx)
            .each(option => option.checked = false)
        ;
    };
    return checkone;
})(module.prefix || 'checkone');
</script>