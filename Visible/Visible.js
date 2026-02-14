const Visible = (function () {
    const prefix = 'visible';

    function Visible(ctx, tags) {
        const space = ctx.up(`[${prefix}-space]`);
        space.all(`[${prefix}-tag]`).each(function (el) {
            el.style.display = tags.includes(el.attr(`${prefix}-tag`)) ? '' : 'none';
        });
        space.attr(`${prefix}-state`, tags.join(' '));
    }

    function Toggle(ctx, when, then, otherwise) {
        const space = ctx.up(`[${prefix}-space]`);
        Visible(space, space.attr(`${prefix}-state`).split(' ').includes(when) ? then : otherwise);
    }

    return {
        Visible,
        Toggle,
    };
})();

