<script>
var chat = chat || {};
chat.val = (function() {
    function set(element, value) {
        element.querySelectorAll('[chat-val]').forEach(el => {
            let key = el.getAttribute('chat-val');
            if (!key in value) {
                return;
            }
            let val = value[key];
            let mode = el.getAttribute('chat-val-mode') || 'text';
            if (mode === 'text') {
                el.textContent = val;
            } else if (mode === 'html') {
                el.innerHTML = val;
            }
        });
    }
    return {
        set,
    }
})();
</script>