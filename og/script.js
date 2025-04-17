async function updatePlayerCount() {
    try {
      const res = await fetch('get_user_count.php');
      const data = await res.json();
      document.getElementById('playerCount').textContent = data.count;
    } catch (err) {
      console.error('Failed to get player count:', err);
      document.getElementById('playerCount').textContent = 'Error';
    }
  }
  
  document.addEventListener('DOMContentLoaded', () => {
    updatePlayerCount();
    setInterval(updatePlayerCount, 5000); // update every 5 sec
  });
  