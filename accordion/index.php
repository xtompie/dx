<script> module = {prefix: 'accordion'}; </script>
<?php require 'accordion.php' ?>
<script> let accordion = module; </script>

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

