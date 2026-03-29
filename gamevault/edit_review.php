<?php
include("config/db.php");
include("includes/header.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET["id"])) {
    echo "<p>Review not found.</p>";
    include("includes/footer.php");
    exit();
}

$review_id = (int) $_GET["id"];
$user_id = $_SESSION["user_id"];
$message = "";

$sql = "SELECT * FROM reviews WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $review_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<p>Review not found or you do not have permission to edit it.</p>";
    include("includes/footer.php");
    exit();
}

$review = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rating = (int) $_POST["rating"];
    $comment = trim($_POST["comment"]);

    $update_sql = "UPDATE reviews SET rating = ?, comment = ? WHERE id = ? AND user_id = ?";
    $stmt_update = $conn->prepare($update_sql);
    $stmt_update->bind_param("isii", $rating, $comment, $review_id, $user_id);

    if ($stmt_update->execute()) {
        header("Location: game.php?id=" . $review["game_id"]);
        exit();
    } else {
        $message = "Something went wrong. Please try again.";
    }
}
?>

<div class="form-container">
    <h2>Edit Your Review</h2>

    <?php if (!empty($message)) : ?>
        <p class="message"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Rating (1–5)</label>
        <input type="number" name="rating" min="1" max="5"
               value="<?php echo htmlspecialchars($review["rating"]); ?>" required>

        <label>Comment</label>
        <textarea name="comment" required><?php echo htmlspecialchars($review["comment"]); ?></textarea>

        <button type="submit">Update Review</button>
    </form>
</div>

<?php include("includes/footer.php"); ?>