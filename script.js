async function createLobby() {
  const response = await fetch('createLobby.php');

    const data = await response.json();
    if (data.success) {
      window.location.href = `lobby.php?code=${data.code}`;

    } else {
        alert('Could not create lobby.');
    }
}


  async function joinLobby() {
    const code = document.getElementById("joinCode").value.trim().toUpperCase();
    const res = await fetch(`join_lobby.php?code=${code}`);
    const data = await res.json();
    if (data.success) {
      window.location.href = `lobby.php?code=${data.code}`;
      alert("Joined lobby successfully.");
    } else {
      alert("Lobby not found.");
    }
  }

  fetch('createLobby.php')
  fetch('game.php')