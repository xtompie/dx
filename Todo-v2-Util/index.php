<?php require_once '../Util/Util.php' ?>
<script>
    <?php require_once 'Todo.js' ?>
</script>

<style>
[todo-item-status="done"] [todo-item-text] {
    text-decoration: line-through;
}
</style>

<div todo-space>
    <template todo-item-tpl>
        <div todo-item todo-item-status="">
            <input type="checkbox" todo-item-checkbox onchange="Todo.Check(this)" />
            <span todo-item-text></span>
            <button onclick="Todo.Remove(this)">remove</button>
        </div>
    </template>
    <div todo-items></div>
    <div>
        <input type="text" todo-add-text />
        <button onclick="Todo.Add(this)">add</button>
    </div>
    <pre todo-output></pre>
</div>
