<?php require_once '../helper/helper.php' ?>
<script>
var app = app || {};
app.shared = app.shared || {};
</script>

<script> module = {prefix: 'app-shared-val'}; </script>
<?php require '../val/val.php' ?>
<script> app.shared.val = module; </script>

<script> module = {prefix: 'app-shared-render'}; </script>
<?php require '../render/render.php' ?>
<script> app.shared.render = module; </script>

<script> module = {prefix: 'app-shared-visible'}; </script>
<?php require '../visible/visible.php' ?>
<script> app.shared.visible = module; </script>

<script> module = {prefix: 'app-shared-removeitem'}; </script>
<?php require '../removeitem/removeitem.php' ?>
<script> app.shared.removeitem = module; </script>