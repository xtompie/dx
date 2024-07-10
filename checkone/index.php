<script> module = {prefix: 'checkone'}; </script>
<?php require 'checkone.php' ?>
<script> let checkone = module; </script>

<div checkone-space>
    <input type="checkbox" checkone-option onclick="checkone(this)"> 1
    <input type="checkbox" checkone-option onclick="checkone(this)"> 2
    <input type="checkbox" checkone-option onclick="checkone(this)"> 3
</div>
