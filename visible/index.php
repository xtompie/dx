<script> module = {prefix: 'visible'}; </script>
<?php require 'visible.php' ?>
<script> let visible = module; </script>

<div visible-space visible-state="hide">
    <button  onclick="visible.toggle(this, 'hide', ['show'], ['hide'])">
        <span visible-tag="show" style="display:none;">Hide</span>
        <span visible-tag="hide">Show</span>
    </button>
    <div visible-tag="show" style="display:none;">
        <p>
            Content <span onclick="visible.visible(this, ['hide'])">X</span>
        </p>
    </div>
</div>
