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

<script>
document.addEventListener("DOMContentLoaded", function () {
    const header = document.getElementById("main-header");
    if (!header) return;

    function handleHeaderVisibility() {
        if (window.innerWidth <= 768) {
            if (window.scrollY > 120) {
                header.classList.add("header-hidden");
            } else {
                header.classList.remove("header-hidden");
            }
        } else {
            header.classList.remove("header-hidden");
        }
    }

    window.addEventListener("scroll", handleHeaderVisibility);
    window.addEventListener("resize", handleHeaderVisibility);
    handleHeaderVisibility();
});
</script>
</script>
</body>
</html>