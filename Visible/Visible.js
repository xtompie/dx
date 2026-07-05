const Visible = (function () {
    function Visible(ctx, tags) {
        const space = ctx.up('[visible-space]');
        space.all('[visible-tag]').each(function (el) {
            el.style.display = tags.includes(el.attr('visible-tag')) ? '' : 'none';
        });
        space.attr('visible-state', tags.join(' '));
    }

    function Toggle(ctx, when, then, otherwise) {
        const space = ctx.up('[visible-space]');
        Visible(space, space.attr('visible-state').split(' ').includes(when) ? then : otherwise);
    }

    return {
        Visible,
        Toggle,
    };
})();
