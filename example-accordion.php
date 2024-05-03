<script>
let accordion = (function() {
    function item(item) {
        item
            .closest('[accordion-space]')
            .querySelectorAll(['[accordion-item]'])
            .forEach(
                i => i.querySelector(['[accordion-content]']).style.display = i === item ? '' : 'none'
            )
        ;
    }
    function show(ctx) {
        item(ctx.closest('[accordion-item]'));
    }
    function init(ctx) {
        item(ctx.closest('[accordion-space]').querySelector('[accordion-item]'));
    }
    return {
        init,
        show,
    }
})();
</script>

<div accordion-space>
    <div accordion-item>
        <div onclick="accordion.show(this)">1</div>
        <div accordion-content>Content1</div>
    </div>
    <div accordion-item>
        <div onclick="accordion.show(this)">2</div>
        <div accordion-content>Content2</div>
    </div>
    <script>accordion.init(document.currentScript)</script>
</div>

