<?php require 'Visible.php' ?>

<div visible-space visible-state="hide">
    <button  onclick="Visible.Toggle(this, 'hide', ['show'], ['hide'])">
        <span visible-tag="show" style="display:none;">Hide</span>
        <span visible-tag="hide">Show</span>
    </button>
    <div visible-tag="show" style="display:none;">
        <p>
            Content <span onclick="Visible.Visible(this, ['hide'])">X</span>
        </p>
    </div>
</div>
