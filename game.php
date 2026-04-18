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
$favorite_message = "";

/* Check if logged in user already reviewed this game */
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

    /* Add to favorites */
    if (isset($_POST["add_favorite"])) {
        $fav_stmt = $conn->prepare("INSERT IGNORE INTO favourites (user_id, game_id) VALUES (?, ?)");
        $fav_stmt->bind_param("ii", $user_id, $game_id);
        $fav_stmt->execute();

        if ($fav_stmt->affected_rows > 0) {
            $favorite_message = "Game added to favorites.";
        } else {
            $favorite_message = "This game is already in your favorites.";
        }
    }

    /* Submit review */
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit_review"]) && !$user_has_reviewed) {
        $rating = (int) $_POST["rating"];
        $comment = trim($_POST["comment"]);

        if ($rating >= 1 && $rating <= 5 && !empty($comment)) {
            $insert_sql = "INSERT INTO reviews (user_id, game_id, rating, comment)
                           VALUES (?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($insert_sql);
            $stmt_insert->bind_param("iiis", $user_id, $game_id, $rating, $comment);
            $stmt_insert->execute();

            header("Location: game.php?id=" . $game_id);
            exit();
        }
    }
}

/* Average rating */
$sql_avg = "SELECT AVG(rating) AS avg_rating FROM reviews WHERE game_id = ?";
$stmt_avg = $conn->prepare($sql_avg);
$stmt_avg->bind_param("i", $game_id);
$stmt_avg->execute();
$result_avg = $stmt_avg->get_result();
$data_avg = $result_avg->fetch_assoc();

/* Reviews list */
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

    <?php if (!empty($data_avg["avg_rating"])): ?>
        <p><strong>Average Rating:</strong> <?php echo round($data_avg["avg_rating"], 1); ?> ⭐</p>
    <?php else: ?>
        <p><strong>Average Rating:</strong> No ratings yet</p>
    <?php endif; ?>

    <?php if (isset($_SESSION["user_id"])): ?>
        <form method="POST" class="game-actions">
            <button type="submit" name="add_favorite">Add to Favorites</button>
        </form>

        <?php if (!empty($favorite_message)): ?>
            <p style="margin-top: 10px; color: #00e676; font-weight: bold;">
                <?php echo htmlspecialchars($favorite_message); ?>
            </p>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php if (isset($_SESSION["user_id"])): ?>
    <?php if (!$user_has_reviewed): ?>
        <div class="form-container">
            <h3>Leave a Review</h3>

            <form method="POST">
                <label>Rating (1–5)</label>
                <input type="number" name="rating" min="1" max="5" required>

                <label>Comment</label>
                <textarea name="comment" required></textarea>

                <button type="submit" name="submit_review">Submit Review</button>
            </form>
        </div>
    <?php else: ?>
        <p style="max-width: 800px; margin: 20px auto;">You already reviewed this game.</p>
    <?php endif; ?>
<?php else: ?>
    <p style="max-width: 800px; margin: 20px auto;">Please <a href="login.php">login</a> to leave a review and manage favorites.</p>
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