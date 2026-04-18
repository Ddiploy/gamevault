<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("config/db.php");
include("includes/header.php");

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$genre = isset($_GET['genre']) ? trim($_GET['genre']) : '';

$sql = "SELECT * FROM games WHERE 1=1";
$params = [];
$types = "";

if (!empty($search)) {
    $sql .= " AND title LIKE ?";
    $params[] = "%" . $search . "%";
    $types .= "s";
}

if (!empty($genre)) {
    $sql .= " AND genre = ?";
    $params[] = $genre;
    $types .= "s";
}

$sql .= " ORDER BY RAND()";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("<p style='color:red; padding:20px;'>Prepare failed: " . htmlspecialchars($conn->error) . "</p>");
}

if (!empty($params)) {
    if (!$stmt->bind_param($types, ...$params)) {
        die("<p style='color:red; padding:20px;'>bind_param failed.</p>");
    }
}

if (!$stmt->execute()) {
    die("<p style='color:red; padding:20px;'>Execute failed: " . htmlspecialchars($stmt->error) . "</p>");
}

$result = $stmt->get_result();

if (!$result) {
    die("<p style='color:red; padding:20px;'>get_result failed.</p>");
}

echo "<p style='color:white; padding:20px;'>Debug: page loaded</p>";
echo "<p style='color:white; padding:20px;'>Rows found: " . $result->num_rows . "</p>";
?>

<h2>Featured Games</h2>

<form method="GET" action="index.php" class="search-form">
    <input type="text" name="search" placeholder="Search for a game..." value="<?php echo htmlspecialchars($search); ?>">

    <select name="genre">
        <option value="">All Genres</option>
        <option value="Action" <?php echo ($genre == 'Action') ? 'selected' : ''; ?>>Action</option>
        <option value="RPG" <?php echo ($genre == 'RPG') ? 'selected' : ''; ?>>RPG</option>
        <option value="Sports" <?php echo ($genre == 'Sports') ? 'selected' : ''; ?>>Sports</option>
        <option value="Horror" <?php echo ($genre == 'Horror') ? 'selected' : ''; ?>>Horror</option>
        <option value="Strategy" <?php echo ($genre == 'Strategy') ? 'selected' : ''; ?>>Strategy</option>
    </select>

    <button type="submit">Search</button>
</form>

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