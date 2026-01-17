let Todo = (() => {
    const Add = (ctx) => {
        let space = ctx.up('[todo-space]');
        let item = space.one('[todo-item-tpl]').tpl();
        item.one('[todo-item-text]').textContent = space.one('[todo-add-text]').value;
        space.one('[todo-add-text]').value = '';
        space.one('[todo-items]').append(item);
        Output(space);
    };
    const Check = (ctx) => {
        let space = ctx.up('[todo-space]');
        let item = ctx.up('[todo-item]');
        let done = item.one('[todo-item-checkbox]').checked;
        item.attr('todo-item-status', done ? 'done' : '');
        Output(space);
    };
    const Remove = (ctx) => {
        let space = ctx.up('[todo-space]');
        ctx.up('[todo-item]').remove();
        Output(space);
    };
    const Output = (space) => {
        let data = space.all('[todo-item]').map(item => ({
            done: item.attr('todo-item-status') === 'done',
            text: item.one('[todo-item-text]').textContent,
        }));
        space.one('[todo-output]').textContent = JSON.stringify(data, null, 4);
    }
    return {
        Add,
        Check,
        Remove,
    }
})();