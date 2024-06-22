<script>
var chat = chat || {};
chat.main = (function() {
    function init() {
        chat.loading.off();
        chat.conversation.addMessages(chat.storage.getMessages());
    }
    function minimize() {
        window.parent.postMessage({ action: 'chat.close' }, '*')
    }
    function ask(question) {
        chat.loading.on();
        message(question, 'question');
        chat.api
            .query({session: chat.storage.getSession(), question})
            .then(function(r) {
                message(r.message, 'answer');
                chat.storage.setSession(r.session);
                chat.loading.off();
            })
        ;
    }
    function message(message, type) {
        let msg = {message, type, time: chat.time.now()};
        chat.storage.addMessage(msg);
        chat.conversation.addMessage(msg);
    }
    return {
        init,
        minimize,
        ask,
    }
})();
</script>