<script>
var chat = chat || {};
chat.input = (function() {
    function submit() {
        let input = document.querySelector('[chat-input]');
        let value = input.value;
        input.value = '';
        chat.main.ask(value);
    }
    return {
        submit,
    }
})();
</script>