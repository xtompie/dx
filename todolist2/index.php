<?php require_once 'framework.php' ?>
<?php require_once 'app.item.php' ?>
<?php require_once 'app.items.php' ?>
<?php require_once 'app.input.php' ?>
<?php require_once 'app.output.php' ?>
<?php require_once 'app.todolist.php' ?>

<div component="app.todolist">
    <div component="app.items" onchange="(v) => this.parentNode.exec('update', v)"></div>
    <div component="app.input" onadd="(v) => this.parentNode.exec('add', v)"></div>
    <div component="app.output"></div>
    <script>
        document.currentScript.exec('init', [
            {"done": false, "text": "buy milk"},
            {"done": true, "text": "throw out rubbish"}
        ]);
    </script>
</div>
