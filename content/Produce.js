const Produce = (() => {
    const Init = (ctx, items) => {
        ctx.up('[produce-space]')
            .one('[produce-list]')
            .vappend(items.map(p => ({ ...p, match: `${p.name} ${p.category}` })));
    };

    return { Init };
})();
