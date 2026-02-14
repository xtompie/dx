let Todo = (() => {
    const Add = (ctx) => {
        let space = ctx.closest('[todo-space]');
        let item = space.querySelector('[todo-item-tpl]').content.firstElementChild.cloneNode(true);
        item.querySelector('[todo-item-text]').textContent = space.querySelector('[todo-add-text]').value;
        space.querySelector('[todo-add-text]').value = '';
        space.querySelector('[todo-items]').append(item);
        Output(space);
    };
    const Check = (ctx) => {
        let space = ctx.closest('[todo-space]');
        let item = ctx.closest('[todo-item]');
        let done = item.querySelector('[todo-item-checkbox]').checked;
        item.setAttribute('todo-item-status', done ? 'done' : '');
        Output(space);
    };
    const Remove = (ctx) => {
        let space = ctx.closest('[todo-space]');
        ctx.closest('[todo-item]').remove();
        Output(space);
    };
    const Output = (space) => {
        let data = Array.from(space.querySelectorAll('[todo-item]')).map(item => ({
            done: item.getAttribute('todo-item-status') === 'done',
            text: item.querySelector('[todo-item-text]').textContent,
        }));
        space.querySelector('[todo-output]').textContent = JSON.stringify(data, null, 4);
    };
    return {
        Add,
        Check,
        Remove,
    };
})();