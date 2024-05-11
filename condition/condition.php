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
var dx = dx || {};
dx.condition = (() => {
    function isEnabled(variable, operator, val) {
        if (operator === '!=') {
            return variable !== val;
        }
        else {
            return variable === val;
        }
    }
    function getElementValue(el) {
        return el.tagName === "SELECT" ? el.options[el.selectedIndex].value : el.value;
    }
    function getVariableValue(ctx, name) {
        return getElementValue(
            ctx.up('[dx-condition-space]').one(`[dx-condition-model="${name}"]`)
        );
    }
    function getDependants(ctx, name) {
        return ctx.up('[dx-condition-space]').all(`[dx-condition-variable="${name}"]`);
    }
    function updateDependant(el, variable) {
        let value = el.getAttribute('dx-condition-value');
        let operator = el.getAttribute('dx-condition-operator');
        let enabled = isEnabled(variable, operator, value);
        el.style.display = enabled ? '' : 'none';
    }
    function model(ctx, name) {
        variable(ctx, name, getVariableValue(ctx, name));
    }
    function variable(ctx, name, value) {
        getDependants(ctx, name).each(el => updateDependant(el, value));
    }
    return {
        model,
        variable,
    };
})();
</script>