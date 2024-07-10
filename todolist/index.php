<?php require_once '../helper/helper.php' ?>
<script>
let todo = (function(){
    function add(ctx) {
        let space = ctx.up('[todo-space]');
        let item = space.one('[todo-item-tpl]').tpl();
        item.one('[todo-item-text]').textContent = space.one('[todo-add-text]').value;
        space.one('[todo-add-text]').value = '';
        space.one('[todo-items]').append(item);
        output(space);
    }
    function check(ctx) {
        let space = ctx.up('[todo-space]');
        let item = ctx.up('[todo-item]');
        let done = item.one('[todo-item-checkbox]').checked;
        item.attr('todo-item-status', done ? 'done' : '');
        output(space);
    }
    function remove(ctx) {
        let space = ctx.up('[todo-space]');
        ctx.up('[todo-item]').remove();
        output(space);
    }
    function output(space) {
        let data = space.all('[todo-item]').map(item => ({
            done: item.attr('todo-item-status') === 'done',
            text: item.one('[todo-item-text]').textContent,
        }));
        space.one('[todo-output]').textContent = JSON.stringify(data, null, 4);
    }
    return {
        add,
        check,
        remove,
    }
})();
</script>

<style>
[todo-item-status="done"] [todo-item-text] {
    text-decoration: line-through;
}
.container {
    display: flex;
    gap: 1rem;
}
</style>

<div class="container">
    <div todo-space>
        <template todo-item-tpl>
            <div todo-item todo-item-status="">
                <input type="checkbox" todo-item-checkbox onchange="todo.check(this)" />
                <span todo-item-text></span>
                <button onclick="todo.remove(this)">remove</button>
            </div>
        </template>
        <div todo-items></div>
        <div>
            <input type="text" todo-add-text />
            <button onclick="todo.add(this)">add</button>
        </div>
        <pre todo-output></pre>
    </div>
</div>
