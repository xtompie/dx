<script>
const visible = function(ctx, tags) {
    const space = ctx.up('[visible-space]');
    space.all('[visible-tag]').each(function (el) {
        el.style.display = tags.includes(el.attr('visible-tag')) ? '' : 'none';
    });
    space.attr('visible-state', tags.join(' '));
};
</script>
