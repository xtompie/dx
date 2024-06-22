<script>
var chat = chat || {};
chat.storage = (function() {
    function getMessages() {
        return JSON.parse(localStorage.getItem('chat.messages')) || [];
    }
    function addMessage(message) {
        let messages = getMessages();
        messages.push(message);
        localStorage.setItem('chat.messages', JSON.stringify(messages));
    }
    function clearMessages() {
        localStorage.removeItem('chat.messages');
    }
    function setSession(session) {
        localStorage.setItem('chat.session', session);
    }
    function getSession() {
        return localStorage.getItem('chat.session');
    }
    function clearSession() {
        localStorage.removeItem('chat.session');
    }
    return {
        getMessages,
        addMessage,
        clearMessages,
        setSession,
        getSession,
        clearSession,
    }
})();
</script>