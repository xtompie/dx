<script>
HTMLElement.prototype.up = function(s) {
    return this.closest(s);
}
HTMLElement.prototype.one = function(s) {
    return this.querySelector(s);
}
HTMLElement.prototype.all = function(s) {
    return Array.from(this.querySelectorAll(s));
}
HTMLElement.prototype.tpl = function(s) {
    return this.one(s).content.cloneNode(true);
}
DocumentFragment.prototype.one = function(s) {
    return this.querySelector(s);
}
let todo = (function(){
    function add(ctx) {
        let space = ctx.up('[todo-space]');
        let item = space.tpl('[todo-item-tpl]')
        item.one('[todo-item-text]').textContent = space.one('[todo-add-text]').value;
        space.one('[todo-add-text]').value = '';
        space.one('[todo-items]').append(item);
        output(space);
    }
    function check(ctx) {
        let space = ctx.up('[todo-space]');
        let item = ctx.up('[todo-item]');
        let done = item.one('[todo-item-checkbox]').checked;
        item.setAttribute('todo-item-status', done ? 'done' : '');
        output(space);
    }
    function remove(ctx) {
        let space = ctx.up('[todo-space]');
        ctx.up('[todo-item]').remove();
        output(space);
    }
    function output(space) {
        let data = space.all('[todo-item]').map(item => ({
            done: item.getAttribute('todo-item-status') === 'done',
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
