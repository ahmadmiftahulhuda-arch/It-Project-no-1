<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FAQ Peminjaman Sarpas Prodi TI</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #eef3ff;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 900px;
      margin: 40px auto;
      padding: 20px;
    }

    .search-box {
      width: 100%;
      padding: 12px;
      border-radius: 10px;
      border: 1px solid #ccc;
      font-size: 16px;
      margin-bottom: 20px;
    }

    .faq-section {
      background: linear-gradient(to right, #2a5ee8, #5166f0);
      color: white;
      padding: 12px 20px;
      border-radius: 10px 10px 0 0;
      margin-top: 25px;
      font-weight: bold;
      font-size: 18px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .faq-item {
      background: #fff;
      border-bottom: 1px solid #eee;
      cursor: pointer;
      padding: 16px 20px;
      font-size: 16px;
      font-weight: bold;
      position: relative;
    }

    .faq-item::after {
      content: "▾";
      position: absolute;
      right: 20px;
      font-size: 16px;
      transition: transform 0.3s;
    }

    .faq-item.active::after {
      transform: rotate(180deg);
    }

    .faq-answer {
      display: none;
      padding: 14px 20px;
      background: #f0f6ff;
      font-size: 15px;
      border-left: 4px solid #2a5ee8;
      margin: 0 0 10px 0;
      border-radius: 4px;
      line-height: 1.6;
    }

    .faq-item.active + .faq-answer {
      display: block;
    }
  </style>
</head>
<body>
  <div class="container">
    <input type="text" id="search" class="search-box" placeholder="Cari pertanyaan atau jawaban...">

    <!-- Umum -->
    <div class="faq-section">❓ Umum</div>
    <div class="faq-item">Apa itu sistem peminjaman sarana dan prasarana Prodi TI?</div>
    <div class="faq-answer">
      Sistem peminjaman sarana dan prasarana Prodi TI adalah platform digital yang memungkinkan mahasiswa, dosen, dan staf untuk meminjam berbagai fasilitas dan peralatan yang tersedia di Program Studi Teknik Informatika secara online. Sistem ini dirancang untuk mempermudah proses peminjaman dan pengelolaan inventaris.
    </div>

    <div class="faq-item">Siapa saja yang dapat menggunakan layanan ini?</div>
    <div class="faq-answer">
      Layanan ini dapat digunakan oleh:  
      1) Mahasiswa aktif Prodi TI,  
      2) Dosen dan staf pengajar Prodi TI,  
      3) Staf administrasi dan teknisi Prodi TI,  
      4) Mahasiswa dari prodi lain dengan persetujuan khusus untuk keperluan akademik tertentu.
    </div>

    <div class="faq-item">Apa saja fasilitas/sarana yang bisa dipinjam melalui sistem ini?</div>
    <div class="faq-answer">
      Fasilitas yang tersedia meliputi: Laptop dan komputer portable, Proyektor dan layar presentasi, Kamera dan peralatan dokumentasi, Peralatan jaringan (router, switch, kabel), Ruang meeting dan laboratorium, Peralatan praktikum (Arduino, Raspberry Pi, sensor), Whiteboard portable, dan peralatan presentasi lainnya.
    </div>

    <!-- Bagian lain tinggal dilanjutkan sama seperti pola di atas -->
  </div>

  <script>
    // Toggle FAQ
    document.querySelectorAll('.faq-item').forEach(item => {
      item.addEventListener('click', () => {
        item.classList.toggle('active');
      });
    });

    // Search FAQ
    document.getElementById('search').addEventListener('keyup', function () {
      let filter = this.value.toLowerCase();
      document.querySelectorAll('.faq-item, .faq-answer').forEach(el => {
        if (el.textContent.toLowerCase().includes(filter)) {
          el.style.display = '';
        } else {
          el.style.display = 'none';
        }
      });
    });
  </script>
</body>
</html>
