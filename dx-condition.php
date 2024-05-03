<?php require_once 'dx-space.php' ?>

<script>
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
            dx.space(ctx, '[dx-condition-space]').querySelector(`[dx-condition-model="${name}"]`)
        );
    }
    function getDependants(ctx, name) {
        return dx.space(ctx, '[dx-condition-space]').querySelectorAll(`[dx-condition-variable="${name}"]`);
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
        getDependants(ctx, name).forEach(el => updateDependant(el, value));
    }
    return {
        model,
        variable,
    };
})();
</script>