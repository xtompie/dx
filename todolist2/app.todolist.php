<script>
app.todolist = (function(){
    function init(data) {
        this.onec('app.items').fn.init(data);
        this.onec('app.input').fn.init();
        this.onec('app.output').fn.init(data);
    }
    function add(data) {
        this.onec('app.items').fn.add(data);
    }
    function update(data) {
        this.onec('app.output').fn.write(data);
    }
    return {
        init,
        add,
        update,
    };
})();
</script>
