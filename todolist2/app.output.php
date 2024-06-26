<script>
app.output = (function(){
    function init(e, data) {
        e.component().append(document.tpl('[app-output-tpl]'));
        write(e, data);
    }
    function write(e, data) {
        e.component().one('[app-output-display]').textContent = JSON.stringify(data, null, 4);
    }
    return {
        init,
        write,
    };
})();
</script>
<template app-output-tpl>
    <pre app-output-display></pre>
</template>