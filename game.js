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

setInterval(loadState, 1000);
loadState();