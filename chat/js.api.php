<script>
var chat = chat || {};
chat.api = (function(){
    function query(data) {
        return new Promise((resolve) => {
            setTimeout(
                () => resolve({message: 'Hello world!', session: 'abc123'}),
                1000
            );
        });
    }
    return {
        query,
    }
})();
</script>