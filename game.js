if (!localStorage.getItem('playerId')) {
  localStorage.setItem('playerId', crypto.randomUUID());
}
const playerId = localStorage.getItem('playerId');

function updateUI(state) {
  const slots = document.getElementById('slots');
  slots.innerHTML = '';
  state.players.forEach((player, index) => {
    const div = document.createElement('div');
    div.innerText = player.name || `Slot ${index + 1} (Click to Join)`;
    if (!player.name) {
      div.onclick = () => {
        const name = prompt('Enter your name');
        if (!name) return;
        fetch('api/join.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ name, slot: index, playerId })
        }).then(() => loadState());
      };
    }
    // Highlight the current player's turn
    if (index === state.currentTurn) {
      div.style.background = '#dff0d8';
      if (player.id === playerId) {
        // Enable action buttons for this player
        // e.g., document.getElementById('incomeBtn').disabled = false;
      }
    } else {
      div.style.opacity = 0.5;
      if (player.id === playerId) {
        // Disable action buttons for this player
        // e.g., document.getElementById('incomeBtn').disabled = true;
      }
    }
    slots.appendChild(div);
  });

  const log = document.getElementById('log');
  log.innerHTML = state.log.map(entry => `<div>${entry}</div>`).join('');
}

function loadState() {
  fetch('api/state.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ playerId })
  })
    .then(res => res.json())
    .then(updateUI);
}

document.getElementById('start').onclick = function() {
  fetch('api/start.php', { method: 'POST' }).then(() => loadState());
};

setInterval(loadState, 1000);
loadState();

