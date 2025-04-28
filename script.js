// Login
document.getElementById('loginForm')?.addEventListener('submit', function(e) {
  e.preventDefault();
  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;

  fetch('php/login.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `username=${username}&password=${password}`
  })
  .then(res => res.text())
  .then(data => {
    if (data.trim() === "success") {
      window.location.href = "php/dashboard.php";
    } else {
      alert(data);
    }
  })
  .catch(error => {
    console.error('Error:', error);
  });
});

// Register
document.getElementById('registerForm')?.addEventListener('submit', function(e) {
  e.preventDefault();
  const username = document.getElementById('newUsername').value;
  const password = document.getElementById('newPassword').value;

  fetch('php/register.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `username=${username}&password=${password}`
  })
  .then(res => res.text())
  .then(data => {
    if (data === "success") {
      window.location.href = "index.html";
    } else {
      alert(data);
    }
  })
  .catch(error => {
    console.error('Error:', error);
  });
});

// Add Song
// Add Song
document.getElementById('songForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    const title = document.getElementById('title').value;
    const artist = document.getElementById('artist').value;

    fetch('addSong.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `title=${encodeURIComponent(title)}&artist=${encodeURIComponent(artist)}`
    })
    .then(res => res.text())
    .then(data => {
        document.getElementById('message').textContent = 
            data === "success" ? "Song added successfully!" : data;
        if (data === "success") {
            document.getElementById('songForm').reset();
            loadSongs();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('message').textContent = "Error adding song";
    });
});

// Load Songs
function loadSongs() {
  fetch('fetchSongs.php') // <== FIXED (removed php/)
  .then(res => res.json())
  .then(data => {
    const songList = document.getElementById('songList');
    songList.innerHTML = "";
    data.forEach(song => {
      songList.innerHTML += `
        <div class="song">
          <strong>${song.title}</strong> by ${song.artist}
          <button onclick="deleteSong(${song.id})">Delete</button>
        </div>
      `;
    });
  })
  .catch(error => {
    console.error('Error loading songs:', error);
  });
}

// Delete Song
function deleteSong(id) {
  fetch(`deleteSong.php?id=${id}`) // <== FIXED (removed php/)
  .then(res => res.text())
  .then(data => {
    if (data === "success") {
      loadSongs();
    } else {
      alert(data);
    }
  })
  .catch(error => {
    console.error('Error deleting song:', error);
  });
}

// Auto load songs if on dashboard
if (window.location.pathname.includes('dashboard.php')) {
  loadSongs();
}

