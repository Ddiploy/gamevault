<?php
include("config/db.php");
include("includes/header.php");

$sql = "SELECT * FROM games ORDER BY RAND()";
$result = $conn->query($sql);
?>

<h2>Featured Games</h2>

<div class="game-grid">
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="game-card">
                <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="game">
                <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                <p>Genre: <?php echo htmlspecialchars($row['genre']); ?></p>
                <p>Year: <?php echo htmlspecialchars($row['release_year']); ?></p>
                <a href="game.php?id=<?php echo $row['id']; ?>">View Details</a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No games found.</p>
    <?php endif; ?>
</div>

<?php include("includes/footer.php"); ?>