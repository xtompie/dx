<script>
var dx = dx || {};
dx.render = (function () {
    function scalar(el, view, mode) {
        if (mode === 'html') {
            el.innerHTML = view;
        } else {
            el.textContent = view;
        }
    }
    function tpl(selector, data) {
        let t = document.querySelector(selector).content.cloneNode(true);
        t.querySelectorAll('[dx-render-model]').forEach(el => {
            let name = el.getAttribute('dx-render-model');
            let value = data[name];
            if (Array.isArray(value)) {
                let itpl = el.getAttribute('dx-render-tpl');
                el.append(value.reduce(
                    (c, item) => {
                        c.append(tpl(itpl, item));
                        return c;
                    },
                    document.createDocumentFragment()
                ));
            } else if (value !== null && typeof value === 'object') {
                el.append(tpl(el.getAttribute('dx-render-tpl'), value));
            } else {
                scalar(el, value, el.getAttribute('dx-render-mode') || 'text');
            }
        });
        return t;
    };
    function append(to, template, data) {
        document.querySelector(to).append(tpl(template, data));
    }
    function update(selector, data) {
        let el = document.querySelector(selector);
        el.innerHTML = '';
        el.append(tpl(el.getAttribute('dx-render-tpl'), data))
    }
    return {
        tpl,
        append,
        update,
    };
})();
</script>
