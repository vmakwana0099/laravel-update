</div>
<!-- Main Wrapper E -->
<!-- Java Script Link S -->
<script type="text/javascript">
    function loadjs(e, t) {
        var a = document.createElement("script");
        a.src = e;
        var n = document.getElementsByTagName("script")[0];
        n.parentNode.insertBefore(a, n);
        var o = !1;

        function r() {
            o || (o = !0, t && t())
        }
        a.onload = r, a.onreadystatechange = function() {
            "loaded" !== this.readyState && "complete" !== this.readyState || setTimeout(r, 0)
        }
    }
    loadjs('assets/js/main-min.js', function() {});
</script>
<!-- Java Script Link E -->
</body>
<!-- Body E -->

</html>