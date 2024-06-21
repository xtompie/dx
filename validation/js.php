<?php require_once '../redner/js.php' ?>

<script>
validation = (function () {
    return {
        validator: {},
    };
})();
validation.validator.required = function (val) {
    return val.trim() !== '';
};
validation.validator.email = function (val) {
    return /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/.test(val);
};
</script>

