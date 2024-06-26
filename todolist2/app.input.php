<script>
app.input = (function(){
    function init(e) {
        c = e.component().append(document.tpl('[app-input-tpl]'));
    }
    function add(e) {
        let input = e.component().one('[app-input-text]');
        let text = input.value;
        input.value = '';
        e.emmit('onadd', text);
    }
    return {
        init,
        add,
    };
})();
</script>
<template app-input-tpl>
    <div>
        <input type="text" app-input-text />
        <button onclick="app.input.add(this)">add</button>
    </div>
</template>