<style>
[app-item-status="done"] [app-item-text] {
    text-decoration: line-through;
}
</style>
<script>
app.item = (function(){
    function init(e, text, done) {
        let t = document.tpl('[app-item-tpl]');
        t.one('[app-item-text]').textContent = text;
        t.one('[app-item-checkbox]').checked = done;
        let c = e.component();
        c.attr('app-item-status', done ? 'done' : '');
        c.append(t);
    }
    function check(e) {
        e.component().attr('app-item-status', e.component().one('[app-item-checkbox]').checked ? 'done' : '');
        e.emmit('onchange', value(e));
    }
    function value(e) {
        return {
            done: e.component().attr('app-item-status') === 'done',
            text: e.component().one('[app-item-text]').textContent,
        };
    }
    function remove(e) {
        e.emmit('onremove', e.component());
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
    <div app-item app-item-status="">
        <input type="checkbox" app-item-checkbox onchange="app.item.check(this)" />
        <span app-item-text></span>
        <button onclick="app.item.remove(this)">remove</button>
    </div>
</template>