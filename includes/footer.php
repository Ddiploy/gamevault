</main>

<footer>
    <p>© 2026 GameVault</p>
</footer>

<script src="assets/js/main.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const nav = document.getElementById("main-nav");
    if (!nav) return;

    function handleNavVisibility() {
        if (window.innerWidth <= 768) {
            if (window.scrollY > 120) {
                nav.classList.add("nav-hidden");
            } else {
                nav.classList.remove("nav-hidden");
            }
        } else {
            nav.classList.remove("nav-hidden");
        }
    }

    window.addEventListener("scroll", handleNavVisibility);
    window.addEventListener("resize", handleNavVisibility);
    handleNavVisibility();
});
</script>
</body>
</html>