<script>
val = (function() {
    function mode(el) {
        return el.getAttribute('val-mode') || 'text';
    }
    function setElVal(el, val, mode) {
        if (mode === 'text') {
            el.textContent = val;
        } else if (mode === 'html') {
            el.innerHTML = val;
        }
    }
    function set(ctx, val) {
        ctx.closest('[val-sapce]').querySelectorAll('[val]').forEach(el => {
            let k = el.getAttribute('val-model');
            if (k in val) {
                setElVal(el, val[k], mode(el));
            }
        });
    }
    function get(ctx) {
        return {}; // @TODO
    }
    return {
        set,
        get,
    }
})();