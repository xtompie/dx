<?php require_once '../prototype/prototype.php' ?>
<?php require_once 'js.php' ?>
<div visible-space visible-state="hide">
    <button visible-tag="show" onclick="visible(this, ['hide'])" style="display:none;">Hide</button>
    <button visible-tag="hide" onclick="visible(this, ['show'])">Show</button>
    <div visible-tag="show" style="display:none;">
        <p>Content</p>
    </div>
</div>
