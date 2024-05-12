<script>
if (typeof c === 'undefined') {
    let c = {};
}
c.value = (function(){
    let _value = {};
    function props() {
        return _value.reduce((c, i) => Object.assign({}, c, i), {});
    }
    function sums() {
        return _value.reduce((c, i) => Object.keys(i).reduce((c, k) => {
            c[k] = (c[k] || 0) + i[k];
            return c;
        }, c), {});
    }
    function value() {
        return JSON.parse(JSON.stringify(_value));
    }
    function update(value) {
        Object.assign(_value, value);
        change();
    }
    function remove(key) {
        delete _value[key];
        change();
    }
    function change() {
    }
    return {
        props,
        sums,
        value,
        update,
        remove
    };
})();

</script>