<script>
Array.prototype.unique = function() {
    return [...new Set(this)];
}
</script>