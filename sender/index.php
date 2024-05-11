<script>
HTMLElement.prototype.up = function(s) {
    return this.closest(s);
}
HTMLElement.prototype.one = function(s) {
    return this.querySelector(s);
}
HTMLElement.prototype.all = function(s) {
    return Array.from(this.querySelectorAll(s));
}
Array.prototype.each = function(f) {
    return this.forEach(f);
}
var sender = (function() {
    function all(e) {
        e.closest('[sender-space]').all('[sender-option]').each(i => i.checked = e.checked);
    }
    function filter(e) {
        let space = e.closest('[sender-space]');
        space.all('[sender-filter]').each(i =>
            i.style.display = i.getAttribute('sender-filter').toLowerCase().indexOf(e.value.toLowerCase()) > -1 ? '' : 'none'
        );
        space.all('[sender-group]').each(i =>
            i.style.display = i.all('[sender-filter]:not([style="display: none;"])').length > 0 ? '' : 'none'
        );
    }
    function group(e) {
        e.closest('[sender-group]').all('[sender-option]').each(i => i.checked = e.checked);
    }
    function submit(e) {
        let space = e.closest('[sender-space]');
        let selected = Array.from(space.all('[sender-option]:checked')).map(i => i.value);
        let fn = space.getAttribute('sender-success');
        eval(`(${fn})(selected)`);d
    }
    return {
        all,
        filter,
        group,
        submit,
    }
})();
</script>
<div sender-space sender-success="(a) => alert(a.join(','))">
    <div><input type="checkbox" onclick="sender.all(this)" /> All</div>
    <div><input type="text" oninput="sender.filter(this)" /></div>
    <div sender-group>
        <div>
            <input type="checkbox" onclick="sender.group(this)"/> <strong>A</strong>
        </div>
        <div>
            <span sender-filter="A1"><input type="checkbox" sender-option value="a1" /> A1</span>
            <span sender-filter="A2"><input type="checkbox" sender-option value="a2" /> A2</span>
        </div>
    </div>
    <div sender-group>
        <div>
            <input type="checkbox" onclick="sender.group(this)"/> <strong>B</strong>
        </div>
        <div>
            <span sender-filter="B1"><input type="checkbox" sender-option value="b1" /> B1</span>
            <span sender-filter="B2"><input type="checkbox" sender-option value="b2" /> B2</span>
        </div>
    </div>
    <button onclick="sender.submit(this)">Ok</button>
</div>
