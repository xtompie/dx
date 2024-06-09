<script>
render = (function () {
    function scalar(el, view, mode) {
        if (mode === 'html') {
            el.innerHTML = view;
        } else {
            el.textContent = view;
        }
    }
    function tpl(selector, data) {
        let t = document.querySelector(selector).content.cloneNode(true);
        t.querySelectorAll('[render-model]').forEach(el => {
            let name = el.getAttribute('render-model');
            let value = name === '' ? data : data[name];
            if (Array.isArray(value)) {
                let itpl = el.getAttribute('render-tpl');
                el.append(value.reduce(
                    (c, item) => {
                        c.append(tpl(itpl, item));
                        return c;
                    },
                    document.createDocumentFragment()
                ));
            } else if (value !== null && typeof value === 'object') {
                el.append(tpl(el.getAttribute('render-tpl'), value));
            } else {
                scalar(el, value, el.getAttribute('render-mode') || 'text');
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
        el.append(tpl(el.getAttribute('render-tpl'), data))
    }
    return {
        tpl,
        append,
        update,
    };
})();
</script>
