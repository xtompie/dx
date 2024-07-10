<script>
module = (function () {
    function walk (key, val) {
        var k, tmp = [];
        if (val === true) {
            val = "1";
        }
        else if (val === false) {
            val = "0";
        }
        if (val != null) {
            if (typeof val === "object") {
                for (k in val) {
                    if (val[k] != null) {
                        tmp.push(walk(key + "[" + k + "]", val[k]));
                    }
                }
                return tmp.join('&');
            }
            else if (typeof val !== "function") {
                return encodeURIComponent(key) + "=" + encodeURIComponent(val);
            }
        } else {
            return '';
        }
    };
    function main(params) {
        var value, key, tmp = [];
        for (key in params) {
            value = params[key];
            var query = walk(key, value);
            if(query !== '') {
                tmp.push(query);
            }
        }
        return tmp.join('&');
    }
    return main;
})();
</script>
