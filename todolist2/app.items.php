<script>
app.items = (function() {
    function init(e, data) {
        let c = e.component();
        c.append(document.tpl('[app-items-tpl]'));
        data.each(i => append(c, i.text, i.done));
    }
    function append(e, text, done) {
        let i = document.createElement('div');
        i.attr('component', 'app.item');
        i.attr('onchange', "() => this.parentNode.exec('change')");
        i.attr('onremove', "(e) => this.parentNode.exec('remove', e)");
        e.component().one('[app-items-list]').append(i);
        i.exec('init', text, done);
    }
    function add(e, text) {
        append(e, text, false);
        e.emmit('onchange', value(e));
    }
    function change(e) {
        e.emmit('onchange', value(e.upc('app.items')));
    }
    function remove(e, item) {
        item.remove();
        e.emmit('onchange', value(e));
    }
    function value(e) {
        return e.component().allc('app.item').map(item => app.item.value(item));
    }
    return {
        init,
        add,
        change,
        remove,
    };
})();
</script>
<template app-items-tpl>
    <div app-items-list>
    </div>
</template>
