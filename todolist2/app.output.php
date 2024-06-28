<script>
app.output = (function(){
    function init(data) {
        this.append(document.one('[app-output-tpl]').tpl());
        this.fn.write(data);
    }
    function write(data) {
        this.one('[app-output-display]').textContent = JSON.stringify(data, null, 4);
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