<!DOCTYPE html>
<html>
<head>
  <title>Test Coup Lobby</title>
</head>
<body>
  <h1>Coup Lobby Tester</h1>

  <button onclick="pollState()">Poll State</button>
  <button onclick="drawCards()">Draw Cards</button>

  <pre id="output">Waiting for action...</pre>

  <script>
    function pollState() {
      fetch("state.php")
        .then(res => res.json())
        .then(data => {
          document.getElementById("output").textContent = JSON.stringify(data, null, 2);
        })
        .catch(err => {
          document.getElementById("output").textContent = "Error: " + err;
        });
    }

    function drawCards() {
      fetch("action.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "action=draw"
      })
      .then(res => res.text())
      .then(text => {
        document.getElementById("output").textContent = text;
        pollState(); // Automatically update state after draw
      })
      .catch(err => {
        document.getElementById("output").textContent = "Error: " + err;
      });
    }
  </script>
</body>
</html>
