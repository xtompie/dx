<script>
app.items = (function() {
    function init(data) {
        let c = this.component();
        c.append(document.tpl('[app-items-tpl]'));
        data.each(i => append(c, i.text, i.done));
    }
    function add(text) {
        let c = this.component();
        append(c, text, false);
        this.emmit('onchange', value(c));
    }
    function change() {
        this.emmit('onchange', value(this));
    }
    function remove(item) {
        item.remove();
        this.emmit('onchange', value(this));
    }
    function value(c) {
        return c.allc('app.item').map(item => item.fn.value());
    }
    function append(c, text, done) {
        let i = document.createElement('div');
        i.attr('component', 'app.item');
        i.attr('onchange', "() => this.up().fn.change()");
        i.attr('onremove', "() => this.up().fn.remove(this)");
        c.one('[app-items-list]').append(i);
        i.fn.init(text, done);
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
