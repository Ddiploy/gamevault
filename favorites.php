<?php
include("config/db.php");
include("includes/header.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

$stmt = $conn->prepare("
    SELECT games.id, games.title, games.image, games.genre, games.release_year
    FROM favourites
    JOIN games ON favourites.game_id = games.id
    WHERE favourites.user_id = ?
    ORDER BY favourites.id DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<h2>My Favorites</h2>

<div class="game-grid">
    <?php if ($result->num_rows > 0): ?>
        <?php while ($game = $result->fetch_assoc()): ?>
            <div class="game-card">
                <img src="<?php echo htmlspecialchars($game["image"]); ?>" alt="game">
                <h3><?php echo htmlspecialchars($game["title"]); ?></h3>
                <p>Genre: <?php echo htmlspecialchars($game["genre"]); ?></p>
                <p>Year: <?php echo htmlspecialchars($game["release_year"]); ?></p>
                <a href="game.php?id=<?php echo $game["id"]; ?>">View Details</a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No favorites yet.</p>
    <?php endif; ?>
</div>

<?php include("includes/footer.php"); ?>