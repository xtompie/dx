<script>
HTMLElement.prototype.up = function (selector) {
    return this.closest(selector);
}
HTMLElement.prototype.all = function (selector) {
    return Array.from(this.querySelectorAll(selector));
}
HTMLElement.prototype.one = function (selector) {
    return this.querySelector(selector);
}
Array.prototype.each = function(f) {
    return this.forEach(f);
}
let ra = (function() {
    let max = 3;
    function value(e, amount) {
        let value = e.up('[ra-answer]').one('[ra-value]');
        value.value = parseInt(value.value) + amount;
        let page = e.up('[ra-page]');
        let sum = used(page);
        let reached = sum === max;
        page.one('[ra-available]').innerText = max - sum;
        page.all('[ra-answer]').each(answer => {
            answer.one('[ra-sub]').disabled = parseInt(answer.one('[ra-value]').value) === 0;
            answer.one('[ra-add]').disabled = reached;
        });
    }
    function used(page) {
        return page.all('input').reduce((c, e) => c + parseInt(e.value), 0);
    }
    function validate(page) {
        let valid = used(page) === max;
        if (!valid) {
            page.one('[ra-error]').removeAttribute('ra-hide');
        }
        return valid;
    }
    function page(space, name) {
        space.all('[ra-page]').each(page => {
            page.toggleAttribute('ra-hide', page.getAttribute('ra-page') !== name)
        });
    }
    function output(space) {
        return space.all('[ra-page-question]').map(page => ({
            question: page.one('[ra-question]').textContent,
            answer: page.all('[ra-answer]').map(answer => ({
                text: answer.one('[ra-answer-text]').textContent,
                value: parseInt(answer.one('[ra-value]').value),
            })),
        }));
    }
    function add(e) {
        value(e, 1);
    }
    function sub(e) {
        value(e, -1);
    }
    function prev(e, prev) {
        page(e.up('[ra-space]'), prev);
    }
    function next(e, next) {
        if (!validate(e.up('[ra-page]'))) {
            return;
        }
        page(e.up('[ra-space]'), next);
    }
    function finish(e) {
        if (!validate(e.up('[ra-page]'))) {
            return;
        }
        let space = e.up('[ra-space]');
        space.one('[ra-output]').textContent = JSON.stringify(output(space), null, 4);
        page(space, 'finished');
    }
    let a = [];
    a.each
    return {
        sub,
        add,
        next,
        prev,
        finish,
    };
})();
</script>
