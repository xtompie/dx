<script>
var chat = chat || {};
chat.conversation = (function() {
    function addMessage(message) {
        let tpl = document.querySelector('[chat-conversation-' + message.type + ']').content.cloneNode(true);
        chat.val.set(tpl, message);
        document.querySelector('[chat-conversation-list]').appendChild(tpl);
        document.querySelector('[chat-conversation-list]').scrollTop = document.querySelector('[chat-conversation-list]').scrollHeight;
    }
    function clear() {
        document.querySelector('[chat-conversation-list]').innerHTML = '';
    }
    function addMessages(messages) {
        messages.forEach(addMessage);
    }
    return {
        addMessage,
        clear,
        addMessages,
    }
})();
</script>