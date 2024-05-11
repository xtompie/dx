<?php require_once 'condition.php' ?>

<div dx-condition-space>

    <select dx-condition-model="size">
        <option value="m" selected="selected">medium</option>
        <option value="l">large</option>
    </select>
    <button onclick="dx.condition.model(this, 'size')">update</button>

    <div dx-condition-variable="size" dx-condition-value="m">medium</div>
    <div dx-condition-variable="size" dx-condition-value="l">large</div>

    <button onclick="dx.condition.variable(this, 'size', 'm')">medium</button>

    <script>
        dx.condition.model(document.currentScript, 'size');
    </script>

</div>