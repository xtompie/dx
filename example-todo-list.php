<script>
let todo = (function(){
    function add(ctx) {
        let space = ctx.closest('[todo-space]');
        let item = document.querySelector('[todo-item-tpl]').content.cloneNode(true);
        item.querySelector('[todo-item-text]').textContent = space.querySelector('[todo-add-text]').value;
        space.querySelector('[todo-add-text]').value = '';
        space.querySelector('[todo-items]').append(item);
        output(space);
    }
    function check(ctx) {
        let item = ctx.closest('[todo-item]');
        let done = item.querySelector('[todo-item-checkbox]').checked;
        item.setAttribute('todo-item-status', done ? 'done' : '');
        output();
    }
    function remove(ctx) {
        ctx.closest('[todo-item]').remove();
        output();
    }
    function output(space) {
        let data = Array.from(space.querySelectorAll('[todo-item]')).map(item => ({
            done: item.getAttribute('todo-item-status') === 'done',
            text: item.querySelector('[todo-item-text]').textContent,
        }));
        space.querySelector('[todo-output]').textContent = JSON.stringify(data, null, 4);
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

<template todo-item-tpl>
    <div todo-item todo-item-status="">
        <input type="checkbox" todo-item-checkbox onchange="todo.check(this)" />
        <span todo-item-text></span>
        <button onclick="todo.remove(this)">remove</button>
    </div>
</template>
<div class="container">
    <div todo-space>
        <div todo-items></div>
        <div>
            <input type="text" todo-add-text />
            <button onclick="todo.add(this)">add</button>
        </div>
        <pre todo-output></pre>
    </div>
    <div todo-space>
        <div todo-items></div>
        <div>
            <input type="text" todo-add-text />
            <button onclick="todo.add(this)">add</button>
        </div>
        <pre todo-output></pre>
    </div>
</div>
