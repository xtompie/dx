<script>
app.todolist = (function(){
    function init(e, data) {
        let c = e.component();
        c.onec('app.items').exec('init', data);
        c.onec('app.input').exec('init');
        c.onec('app.output').exec('init', data);
    }
    function add(e, data) {
        e.onec('app.items').exec('add', data);
    }
    function update(e, data) {
        e.onec('app.output').exec('write', data);
    }
    return {
        init,
        add,
        update,
    };
})();
</script>
