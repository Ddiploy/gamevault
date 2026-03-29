console.log("GameVault JavaScript loaded successfully.");

// Confirm before leaving an edit page or future delete actions
document.addEventListener("DOMContentLoaded", function () {
    const deleteLinks = document.querySelectorAll(".delete-btn");

    deleteLinks.forEach(link => {
        link.addEventListener("click", function (event) {
            const confirmed = confirm("Are you sure you want to delete this review?");
            if (!confirmed) {
                event.preventDefault();
            }
        });
    });
});