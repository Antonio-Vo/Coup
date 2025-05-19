<?php
$db = new PDO("mysql:host=sql304.byethost31.com;dbname=b31_38711838_online_users", "b31_38711838", "Class2025");
$threshold = time() - 300;
$stmt = $db->prepare("SELECT COUNT(*) FROM online_users WHERE last_active >= ?");
$stmt->execute([$threshold]);
$count = $stmt->fetchColumn();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Users Online</title>
    <script>
    // Automatically update the user presence by calling update_presence.php every 5 seconds
    function updatePresence() {
        fetch('update_presence.php', { method: 'GET', cache: 'no-store' })
            .then(response => response.text()) // Ensure the response is handled
            .then(() => { 
                // Optionally log or do something when update is successful
            });
    }

    // Update every 5 seconds
    setInterval(updatePresence, 5000); // 5000ms = 5 seconds

    // This function fetches the live online user count every 5 seconds and updates it
    function updateOnlineCount() {
        fetch('get_online_count.php', { cache: 'no-store' })
            .then(res => res.text())
            .then(count => {
                document.getElementById('online-count').textContent = count;
            });
    }

    // Update the online count every 5 seconds
    setInterval(updateOnlineCount, 5000);
    
    window.onload = function() {
        updatePresence(); // Start presence tracking when the page loads
        updateOnlineCount(); // Start fetching user count when the page loads
    };
    </script>
</head>
<body>
    <h1>Users Online as of the last 5 minutes: <span id="online-count"><?php echo $count; ?></span></h1>
    <a href="lobbies/lobby1.html">Join Lobby 1</a>

</body>
</html>
