async function createLobby() {
    const response = await fetch('create_lobby.php');
    const data = await response.json();
    if (data.success) {
        window.location.href = `lobby.html?code=${data.code}`;
    } else {
        alert('Could not create lobby.');
    }
}


  async function joinLobby() {
    const code = document.getElementById("joinCode").value.trim().toUpperCase();
    const res = await fetch(`join_lobby.php?code=${code}`);
    const data = await res.json();
    if (data.success) {
      window.location.href = `lobby.html?code=${code}`;
    } else {
      alert("Lobby not found.");
    }
  }

  fetch('create_lobby.php')
  fetch('game.php')