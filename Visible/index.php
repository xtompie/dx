<?php require 'Visible.php' ?>

<div Visible-space Visible-state="hide">
    <button  onclick="Visible.Toggle(this, 'hide', ['show'], ['hide'])">
        <span Visible-tag="show" style="display:none;">Hide</span>
        <span Visible-tag="hide">Show</span>
    </button>
    <div Visible-tag="show" style="display:none;">
        <p>
            Content <span onclick="Visible.Visible(this, ['hide'])">X</span>
        </p>
    </div>
</div>
