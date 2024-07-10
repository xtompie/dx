<?php require_once '../helper/helper.php' ?>
<script>
module = (function (prefix) {
    function obj(el) {
        return el.allfd(`[${prefix}]`).reduce((r, e) => {
            return Object.assign(r, _val(e));
        }, {});
    };
    function arr(el) {
        return el.allfd(`[${prefix}]`).map(_val);
    }
    function _val(e) {
        return (function () { return eval(e.getAttribute(prefix)).call(); }).bind(e)()
    }
    return {
        arr,
        obj,
    };
})(module.prefix || 'val');
</script>