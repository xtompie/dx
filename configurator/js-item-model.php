<script>
if (typeof c === 'undefined') {
    let c = {};
}
c.item = c.item || {};
c.item.engine = c.item.engine || {};
c.item.engine.vm = (function(){
    function select() {
        return {
            'fuel': [
                {
                    'name': 'all',
                    'value': null,
                },
                ...c.config.item
                    .filter(item => item.key === 'model')
                    .map(item => item.prop.fuel)
                    .unique()
                    .map(fuel => {
                        return {
                            'name': fuel,
                            'value': fuel,
                        };
                    }),
            ],
        }
    }
    return {
        select,
    };
})();

</script>

