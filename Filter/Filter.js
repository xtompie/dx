const Filter = (() => {
    const Filter = (ctx) => {
        const space = ctx.up('[filter-space]');
        const query = space.one('[filter-query]').value.trim().toLowerCase();
        space.all('[filter-item]').each(el => {
            el.show(el.attr('filter-item').toLowerCase().includes(query));
        });
    };

    return { Filter };
})();
