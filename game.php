<?php
include("config/db.php");
include("includes/header.php");

if (!isset($_GET['id'])) {
    echo "<p>Game not found.</p>";
    include("includes/footer.php");
    exit;
}

$game_id = (int) $_GET['id'];

$sql = "SELECT * FROM games WHERE id = ?";
$stmt_game = $conn->prepare($sql);
$stmt_game->bind_param("i", $game_id);
$stmt_game->execute();
$result_game = $stmt_game->get_result();

if ($result_game->num_rows === 0) {
    echo "<p>Game not found.</p>";
    include("includes/footer.php");
    exit;
}

$game = $result_game->fetch_assoc();

$user_has_reviewed = false;

if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];

    $check_sql = "SELECT * FROM reviews WHERE user_id = ? AND game_id = ?";
    $stmt_check = $conn->prepare($check_sql);
    $stmt_check->bind_param("ii", $user_id, $game_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $user_has_reviewed = true;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !$user_has_reviewed) {
        $rating = (int) $_POST["rating"];
        $comment = trim($_POST["comment"]);

        $insert_sql = "INSERT INTO reviews (user_id, game_id, rating, comment)
                       VALUES (?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($insert_sql);
        $stmt_insert->bind_param("iiis", $user_id, $game_id, $rating, $comment);
        $stmt_insert->execute();

        header("Location: game.php?id=" . $game_id);
        exit();
    }
}

$sql_avg = "SELECT AVG(rating) AS avg_rating FROM reviews WHERE game_id = ?";
$stmt_avg = $conn->prepare($sql_avg);
$stmt_avg->bind_param("i", $game_id);
$stmt_avg->execute();
$result_avg = $stmt_avg->get_result();
$data_avg = $result_avg->fetch_assoc();

$sql_reviews = "SELECT reviews.*, users.username
                FROM reviews
                JOIN users ON reviews.user_id = users.id
                WHERE game_id = ?
                ORDER BY created_at DESC";

$stmt_reviews = $conn->prepare($sql_reviews);
$stmt_reviews->bind_param("i", $game_id);
$stmt_reviews->execute();
$result_reviews = $stmt_reviews->get_result();
?>

<div class="game-detail">
   <img src="<?php echo htmlspecialchars($game['image']); ?>" alt="game">

    <h2><?php echo htmlspecialchars($game['title']); ?></h2>

    <p><strong>Genre:</strong> <?php echo htmlspecialchars($game['genre']); ?></p>
    <p><strong>Description:</strong> <?php echo htmlspecialchars($game['description']); ?></p>
    <p><strong>Developer:</strong> <?php echo htmlspecialchars($game['developer']); ?></p>
    <p><strong>Publisher:</strong> <?php echo htmlspecialchars($game['publisher']); ?></p>
    <p><strong>Release Year:</strong> <?php echo htmlspecialchars($game['release_year']); ?></p>
    <p><strong>Platforms:</strong> <?php echo htmlspecialchars($game['platforms']); ?></p>
</div>




<?php if (!empty($data_avg["avg_rating"])): ?>
    <p style="max-width: 800px; margin: 20px auto;">
        <strong>Average Rating:</strong>
        <?php echo round($data_avg["avg_rating"], 1); ?> ⭐
    </p>
<?php endif; ?>

<?php if (isset($_SESSION["user_id"])): ?>
    <?php if (!$user_has_reviewed): ?>
        <div class="form-container">
            <h3>Leave a Review</h3>

            <form method="POST">
                <label>Rating (1–5)</label>
                <input type="number" name="rating" min="1" max="5" required>

                <label>Comment</label>
                <textarea name="comment" required></textarea>

                <button type="submit">Submit Review</button>
            </form>
        </div>
    <?php else: ?>
        <p style="max-width: 800px; margin: 20px auto;">You already reviewed this game.</p>
    <?php endif; ?>
<?php else: ?>
    <p style="max-width: 800px; margin: 20px auto;">Please <a href="login.php">login</a> to leave a review.</p>
<?php endif; ?>

<h3 style="max-width: 800px; margin: 20px auto;">Reviews</h3>

<?php if ($result_reviews->num_rows > 0): ?>
    <?php while ($row = $result_reviews->fetch_assoc()): ?>
        <div class="review">
            <strong><?php echo htmlspecialchars($row["username"]); ?></strong>
            <?php echo str_repeat("⭐", (int)$row["rating"]); ?>
            <p><?php echo htmlspecialchars($row["comment"]); ?></p>

            <?php if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] == $row["user_id"]): ?>
                <a href="edit_review.php?id=<?php echo $row["id"]; ?>" class="edit-btn">Edit Review</a>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p style="max-width: 800px; margin: 20px auto;">No reviews yet. Be the first!</p>
<?php endif; ?>

<?php include("includes/footer.php"); ?>