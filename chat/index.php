<!DOCTYPE html>
<html>
<body>
    <?php require 'js.index.php' ?>

    <button onclick="chat.main.minimize()">-</button>

    <div chat-conversation-list style="max-height: 200px; overflow:scroll; background:lightgray;"></div>
    <template chat-conversation-question>
        <div>
            <div chat-val="time"></div>
            <div chat-val="message"></div>
        </div>
    </template>
    <template chat-conversation-answer>
        <div>
            <div chat-val="time"></div>
            <div chat-val="message" chat-val-mode="html"></div>
        </div>
    </template>

    <div chat-loading-off>
        <input type="text" chat-input placeholder="Type a message">
        <button onclick="chat.input.submit()">►</button>
    </div>
    <div chat-loading-on>
        <input type="text" disabled="disabled">
        <button>...</button>
    </div>

    <script>
        chat.main.init();
    </script>

</body>
</html>