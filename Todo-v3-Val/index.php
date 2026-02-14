<?php require_once '../Util/Util.php' ?>
<?php require_once '../Val/Val.php' ?>
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
        <div todo-item>
            <div
                val
                val-set="(d) => this.up().attr('todo-item-status', d.status)"
                val-get="() => ({status: this.up().attr('todo-item-status')})"
            ></div>
            <input type="checkbox" todo-item-checkbox onchange="Todo.Check(this)" />
            <span todo-item-text val val-fx="Text" val-key="text"></span>
            <button onclick="Todo.Remove(this)">remove</button>
        </div>
    </template>
    <div todo-items val-tpl="[todo-item-tpl]"></div>
    <div todo-add val val-fx="Obj">
        <input val val-fx="Input" val-key="text" type="text" />
        <button onclick="Todo.Add(this)">add</button>
    </div>
    <pre todo-output></pre>
</div>
