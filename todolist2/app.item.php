<style>
[app-item-status="done"] [app-item-text] {
    text-decoration: line-through;
}
</style>
<script>
app.item = (function(){
    function init(text, done) {
        let t = document.one('[app-item-tpl]').tpl();
        t.one('[app-item-text]').textContent = text;
        t.one('[app-item-checkbox]').checked = done;
        this.append(t);
        this.attr('app-item-status', done ? 'done' : '');
    }
    function check() {
        let c = this.component();
        c.attr('app-item-status', c.one('[app-item-checkbox]').checked ? 'done' : '');
        this.emmit('onchange', this.fn.value());
    }
    function value() {
        let c = this.component();
        return {
            done: c.attr('app-item-status') === 'done',
            text: c.one('[app-item-text]').textContent,
        };
    }
    function remove() {
        this.emmit('onremove', this.component());
    }
    return {
        init,
        check,
        value,
        remove,
    };
})();
</script>
<template app-item-tpl>
    <div app-item>
        <input type="checkbox" app-item-checkbox onchange="this.fn.check()" />
        <span app-item-text></span>
        <button onclick="this.fn.remove()">remove</button>
    </div>
</template>