<script>
var sender = (function(){
    function all(e){
        e.closest('[sender-space]').querySelectorAll('[sender-option]').forEach(i => i.checked = e.checked);
    }
    function filter(e){
        e.closest('[sender-space]').querySelectorAll('[sender-filter]').forEach(i =>
            i.style.display = i.getAttribute('sender-filter').toLowerCase().indexOf(e.value.toLowerCase()) > -1 ? '' : 'none'
        );
        e.closest('[sender-space]').querySelectorAll('[sender-group]').forEach(i =>
            i.style.display = i.querySelectorAll('[sender-filter]:not([style="display: none;"])').length > 0 ? '' : 'none'
        );
    }
    function group(e){
        e.closest('[sender-group]').querySelectorAll('[sender-option]').forEach(i => i.checked = e.checked);
    }
    function submit(e){
        let a = Array.from(e.closest('[sender-space]').querySelectorAll('[sender-option]:checked')).map(i => i.value);
        let x = e.closest('[sender-space]').getAttribute('sender-success');
        eval(`(${x})(a)`);
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
    <div><input type="checkbox" onclick="sender.all(this)"/> All</div>
    <div><input type="text" oninput="sender.filter(this)"></div>
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
