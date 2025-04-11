<?php
$code = $_GET['code'] ?? '';
$lobbies = json_decode(file_get_contents('lobbies.json'), true);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Lobby <?php echo htmlspecialchars($code); ?></title>
</head>
<body>
  <h1>Lobby Code: <?php echo htmlspecialchars($code); ?></h1>

  <?php if (isset($lobbies[$code])): ?>
    <p>Waiting for players...</p>
  <?php else: ?>
    <p style="color:red;">Lobby not found.</p>
  <?php endif; ?>
</body>
</html>
<?php