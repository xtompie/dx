<script>
let ra = (function() {
    let max = 3;
    function updateValue(e, amount) {
        let v = e.closest('[ra-answer]').querySelector('[ra-value]');
        v.value = parseInt(v.value) + amount;
        updatePage(e.closest('[ra-page]'));
    }
    function resolveUsed(page) {
        return Array.from(page.querySelectorAll('input')).reduce((c, e) => c + parseInt(e.value), 0);
    }
    function isPageValid(page) {
        return resolveUsed(page) === max;
    }
    function updatePage(page) {
        let used = resolveUsed(page);
        let reached = used === max;
        page.querySelector('[ra-available]').innerText = max - used;
        page.querySelectorAll('[ra-answer]').forEach(answer => {
            let value = parseInt(answer.querySelector('[ra-value]').value);
            answer.querySelector('[ra-sub]').disabled = value === 0;
            answer.querySelector('[ra-add]').disabled = reached;
        });
    }
    function changePage(space, name) {
        space.querySelectorAll('[ra-page]').forEach(page => {
            page.toggleAttribute('ra-hide', page.getAttribute('ra-page') !== name)
        });
    }
    function resolveValue(space) {
        return Array.from(space.querySelectorAll('[ra-page-question]')).map(page => ({
            question: page.querySelector('[ra-question]').textContent,
            answer: Array.from(page.querySelectorAll('[ra-answer]')).map(answer => ({
                text: answer.querySelector('[ra-answer-text]').textContent,
                value: parseInt(answer.querySelector('[ra-value]').value),
            })),
        }));
    }
    function add(e) {
        updateValue(e, 1);
    }
    function sub(e) {
        updateValue(e, -1);
    }
    function prev(e, prev) {
        changePage(e.closest('[ra-space]'), prev);
    }
    function next(e, next) {
        let page = e.closest('[ra-page]');
        if (!isPageValid(page)) {
            page.querySelector('[ra-error]').removeAttribute('ra-hide');
            return;
        }
        changePage(e.closest('[ra-space]'), next);
    }
    function finish(e) {
        let page = e.closest('[ra-page]');
        if (!isPageValid(page)) {
            page.querySelector('[ra-error]').removeAttribute('ra-hide');
            return;
        }
        let space = e.closest('[ra-space]');
        space.querySelector('[ra-output]').textContent = JSON.stringify(resolveValue(space), null, 4);
        changePage(space, 'finished');
    }
    return {
        sub,
        add,
        next,
        prev,
        finish,
    };
})();
</script>
