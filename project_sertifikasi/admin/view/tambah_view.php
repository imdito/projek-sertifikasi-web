<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulir Vote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap');

      body {
        font-family: 'Lato', sans-serif;
        background-color: #f8f9fa;
      }
      .form-container {
        max-width: 800px;
        margin: 40px auto;
        background: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      }
      #poster-display img {
        width: 100%;
        max-width: 250px;
        border-radius: 8px;
        margin-top: 10px;
        border: 1px solid #ddd;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-danger navbar-dark fw-bolder">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Manajemen Film</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    <a class="nav-link active" href="tambah_view.php">Tambah Film</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="form-container">
      <h2 class="text-center fw-bold mb-4">Tambah Film</h2>
      
      <form action="../controller/add_movie.php" method="POST">
        <div class="row">
          
          <div class="col-md-7">
            <div class="mb-3">
              <label for="nama" class="form-label">Judul</label>
              <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan judul film" required>
            </div>

            <div class="mb-3">
                <label for="genre" class="form-label">Genre</label>
                <select class="form-select" name="genre" id="genre" required>
                <option value="" selected disabled>Pilih genre film</option>
                <option value="romance">Romance</option>
                <option value="action">Action</option>
                <option value="comedy">Comedy</option>
                <option value="horror">Horror</option>
                </select>
            </div>
            
            <div class="mb-3">
              <label for="sutradara" class="form-label">Sutradara</label>
              <input type="text" class="form-control" id="sutradara" name="sutradara" placeholder="Masukkan nama sutradara" required>
            </div>

            <div class="mb-3">
              <label for="link_gambar" class="form-label">Link Gambar</label>
              <input type="text" class="form-control" id="link_gambar" name="gambar" placeholder="Masukkan link gambar">
            </div>
        

            
          </div>
          
          <div class="col-md-5">
            <h6 class="fw-bold">Poster Pilihanmu:</h6>
            <button type="button" class="btn">Lihat Gambar</button>
            <div id="poster-display" class="text-center text-md-start">
            </div>
          </div>
        </div>
        
        <div class="mt-4">
          <button type="submit" class="btn btn-danger w-100 btn-lg">Kirim Vote</button>
        </div>
        
      </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
      // Fungsi untuk menampilkan poster
      function showPoster(imageUrl) {
        const displayArea = document.getElementById('poster-display');
        displayArea.innerHTML = `<img src="${imageUrl}" alt="Movie Poster">`;
      }

      // Fungsi untuk handle submit vote
      function handleVote(event) {
        // 1. Mencegah form submit secara default
        event.preventDefault(); 
        
        // 2. Mendapatkan film yang dipilih
        const selectedMovie = document.querySelector('input[name="movie"]:checked');
        
        if (selectedMovie) {
          const movieName = selectedMovie.value;
          
          // 3. Menampilkan alert
          alert(`Terima kasih, suara Anda untuk ${movieName} telah dicatat.`);
          
          // 4. Mengarahkan kembali ke index.html
          window.location.href = 'index.html';
        } else {
          // Ini seharusnya tidak terjadi karena ada 'required', tapi sebagai penjagaan
          alert('Silakan pilih film terlebih dahulu.');
        }
      }
    </script>
  </body>
</html>