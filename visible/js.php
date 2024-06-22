<script>
const visible = (function(){
    function visible(ctx, tags) {
        const space = ctx.up('[visible-space]');
        space.all('[visible-tag]').each(function (el) {
            el.style.display = tags.includes(el.attr('visible-tag')) ? '' : 'none';
        });
        space.attr('visible-state', tags.join(' '));
    };
    function toggle(ctx, when, then, otherwise) {
        const space = ctx.up('[visible-space]');
        visible(space, space.attr('visible-state').split(' ').includes(when) ? then : otherwise);
    };
    return {
        visible,
        toggle,
    }
})();
</script>
