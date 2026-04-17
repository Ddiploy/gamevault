<?php
include("config/db.php");
include("includes/header.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$success = "";
$error = "";

// Handle profile update
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $new_username = trim($_POST["username"]);
    $new_email = trim($_POST["email"]);
    $new_password = trim($_POST["password"]);

    if (empty($new_username) || empty($new_email)) {
        $error = "Username and email cannot be empty.";
    } else {
        // Check if username or email already exists for another user
        $check_stmt = $conn->prepare("SELECT id FROM users WHERE (username = ? OR email = ?) AND id != ?");
        $check_stmt->bind_param("ssi", $new_username, $new_email, $user_id);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            $error = "Username or email is already being used by another account.";
        } else {
            if (!empty($new_password)) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update_stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
                $update_stmt->bind_param("sssi", $new_username, $new_email, $hashed_password, $user_id);
            } else {
                $update_stmt = $conn->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
                $update_stmt->bind_param("ssi", $new_username, $new_email, $user_id);
            }

            if ($update_stmt->execute()) {
                $_SESSION["username"] = $new_username;
                $success = "Profile updated successfully.";
            } else {
                $error = "Something went wrong while updating your profile.";
            }
        }
    }
}

// Get user information
$user_stmt = $conn->prepare("SELECT username, email FROM users WHERE id = ?");
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user_result = $user_stmt->get_result();
$user = $user_result->fetch_assoc();

// Get user reviews
$review_stmt = $conn->prepare("
    SELECT reviews.id, reviews.comment, reviews.rating, games.title
    FROM reviews
    JOIN games ON reviews.game_id = games.id
    WHERE reviews.user_id = ?
    ORDER BY reviews.id DESC
");
$review_stmt->bind_param("i", $user_id);
$review_stmt->execute();
$reviews = $review_stmt->get_result();
?>

<div class="account-page">
    <h2>My Account</h2>

    <div class="account-box">
        <h3>Profile Information</h3>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($user["username"]); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user["email"]); ?></p>
    </div>

    <div class="account-box">
        <h3>Update Profile</h3>

        <?php if (!empty($success)): ?>
            <p class="success-message"><?php echo $success; ?></p>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST" class="account-form">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($user["username"]); ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user["email"]); ?>" required>

            <label>New Password</label>
            <input type="password" name="password" placeholder="Leave blank if you do not want to change it">

            <button type="submit">Update Profile</button>
        </form>
    </div>

    <div class="account-box">
        <h3>My Reviews</h3>

        <?php if ($reviews->num_rows > 0): ?>
            <?php while ($review = $reviews->fetch_assoc()): ?>
                <div class="review-item">
                    <h4><?php echo htmlspecialchars($review["title"]); ?></h4>
                    <p><strong>Rating:</strong> <?php echo htmlspecialchars($review["rating"]); ?>/5</p>
                    <p><?php echo htmlspecialchars($review["comment"]); ?></p>
                    <a href="edit_review.php?id=<?php echo $review["id"]; ?>">Edit Review</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>You have not submitted any reviews yet.</p>
        <?php endif; ?>
    </div>
</div>

<?php include("includes/footer.php"); ?>