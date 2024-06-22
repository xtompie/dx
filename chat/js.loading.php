<script>
var chat = chat || {};
chat.loading = (function() {
    function on() {
        update(true);
    }
    function off() {
        update(false);
    }
    function update(loading) {
        document.querySelectorAll('[chat-loading-on]').forEach(el => el.style.display = loading ? '' : 'none')
        document.querySelectorAll('[chat-loading-off]').forEach(el => el.style.display = loading ? 'none' : '')
    }
    return {
        on,
        off,
    }
})();
</script>