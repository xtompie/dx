<script>
var dx = dx || {};
dx.val = (function() {
    function mode(el) {
        return el.getAttribute('dx-val-mode') || 'text';
    }
    function setElementValue(el, value, mode) {
        if (mode === 'text') {
            el.textContent = value;
        } else if (mode === 'html') {
            el.innerHTML = value;
        }
    }
    function set(ctx, value) {
        dx.space(ctx, '[dx-val-sapce]').querySelectorAll('[dx-val]').forEach(el => {
            let k = el.getAttribute('dx-val-model');
            if (k in value) {
                setElementValue(el, value[k], mode(el));
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