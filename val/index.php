<script> module = {prefix: 'val'}; </script>
<?php require 'val.php' ?>
<script> let val = module; </script>

<div ticket>
    <h1 val="() => ({title: this.textContent})">Ticket #123</h1>
    <div>
        Author:
        <span val="() => ({author: val.obj(this)})">
            <span val="() => ({name: this.textContent})">John Doe</span>
            (<span val="() => ({email: this.textContent})">j.doe@example.com</span>)
        </span>
    </div>
    <div>Assigned:
        <span val="() => ({assigned: val.obj(this)})">
            <span val="() => ({name: this.textContent})">Max Mustermann</span>
            (<span val="() => ({email: this.textContent})">m.mustermann@example.com</span>)
        </span>
    </div>
    <p val="() => ({description: this.innerHTML})"><b>Warning!</b> Some description</p>
    <div val="() => ({comments: val.arr(this)})">
        <div val="() => val.obj(this)">
            <span val="() => ({author: val.obj(this)})">
                <span val="() => ({name: this.textContent})">John Doe</span>
                (<span val="() => ({email: this.textContent})">j.doe@example.com</span>)
            </span>:
            <div val="() => ({text: this.textContent})">Some comment 1 </div>
        </div>
        <div val="() => val.obj(this)">
            <span val="() => ({author: val.obj(this)})">
                <span val="() => ({name: this.textContent})">John Doe</span>
                (<span val="() => ({email: this.textContent})">j.doe@example.com</span>)
            </span>:
            <div val="() => ({text: this.textContent})">Some comment 2 </div>
        </div>
        <div val="() => val.obj(this)">
            <span val="() => ({author: val.obj(this)})">
                <span val="() => ({name: this.textContent})">John Doe</span>
                (<span val="() => ({email: this.textContent})">j.doe@example.com</span>)
            </span>:
            <div val="() => ({text: this.textContent})">Some comment 3 </div>
        </div>
    </div>
</div>
<script>
    console.log(val.obj(document.querySelector('[ticket]')));
</script>