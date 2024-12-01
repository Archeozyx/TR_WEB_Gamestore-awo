<?php
require 'koneksi.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';
$search_param = '%' . $search . '%';

$stmt = $conn->prepare("SELECT * FROM games WHERE title LIKE ? ORDER BY title ASC");
$stmt->bind_param('s', $search_param);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameList</title>
    <link rel="stylesheet" href="game_list.css">
</head>

<body>
    <div id="game-list" class="game-list">
        <a href="javascript:history.back()" class="back-button">← Back</a>

        <form method="GET" action="">
            <input type="text" name="search" placeholder="Search games..."
                value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Search</button>
        </form>

        <div class="game-grid">
            <?php while ($game = $result->fetch_assoc()): ?>
                <div class="game-item">
                    <a href="game_detail.php?id=<?php echo $game['id']; ?>">
                        <img src=>
                        <div class="game-info">
                            <div class="game-title"><?php echo htmlspecialchars($game['title']); ?></div>
                            <div class="game-price">$<?php echo number_format($game['price'], 2); ?></div>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

</body>


</html>