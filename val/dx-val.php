<script>
var dx = dx || {};
dx.val = (function() {
    function mode(el) {
        return el.getAttribute('dx-val-mode') || 'text';
    }
    function setElVal(el, val, mode) {
        if (mode === 'text') {
            el.textContent = val;
        } else if (mode === 'html') {
            el.innerHTML = val;
        }
    }
    function set(ctx, val) {
        dx.space(ctx, '[dx-val-sapce]').querySelectorAll('[dx-val]').forEach(el => {
            let k = el.getAttribute('dx-val-model');
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