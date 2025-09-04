<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Perkuliahan - Sarpras TI</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3b5998;
            --secondary-color: #6d84b4;
            --accent-color: #4c6baf;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f8fa;
            color: #333;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        /* ===== NAVBAR STYLES ===== */
        .navbar {
            background-color: var(--primary-color);
            padding: 0.8rem 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .logo {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            display: flex;
            align-items: center;
        }
        
        .logo i {
            margin-right: 10px;
        }
        
        .navbar ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
            align-items: center;
        }
        
        .navbar ul li {
            margin-left: 1.2rem;
        }
        
        .navbar ul li a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 0.8rem;
            border-radius: 4px;
            transition: all 0.3s;
            font-weight: 500;
        }
        
        .navbar ul li a:hover, 
        .navbar ul li a.active {
            background-color: rgba(255, 255, 255, 0.15);
        }
        
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
            transform: translateY(-2px);
        }
        
        /* ===== BREADCRUMB ===== */
        .breadcrumb-container {
            background-color: #e9ecef;
            padding: 1rem 0;
        }
        
        .breadcrumb {
            margin-bottom: 0;
            padding: 0 1rem;
        }
        
        /* ===== MAIN CONTENT ===== */
        .main-content {
            padding: 2rem 1rem;
            flex: 1;
        }
        
        .page-header {
            margin-bottom: 2rem;
        }
        
        .page-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .page-description {
            color: #6c757d;
            margin-bottom: 1.5rem;
        }
        
        /* ===== FILTER SECTION ===== */
        .filter-section {
            background-color: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }
        
        .filter-title {
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }
        
        /* ===== CALENDAR SECTION ===== */
        .calendar-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 1.8rem;
            margin-bottom: 2.5rem;
        }
        
        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .month-navigation {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .month-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
            min-width: 180px;
            text-align: center;
        }
        
        .calendar-controls {
            display: flex;
            gap: 0.5rem;
        }
        
        .calendar {
            width: 100%;
            border-collapse: collapse;
        }
        
        .calendar th {
            color: var(--primary-color);
            text-align: center;
            padding: 1rem 0.5rem;
            font-weight: 600;
            border-bottom: 2px solid #dee2e6;
        }
        
        .calendar td {
            text-align: center;
            padding: 0.8rem 0.5rem;
            position: relative;
            border-radius: 8px;
            transition: background-color 0.2s;
            height: 100px;
            vertical-align: top;
            border: 1px solid #dee2e6;
        }
        
        .calendar td:hover {
            background-color: #f5f8fa;
        }
        
        .day-number {
            display: block;
            text-align: left;
            font-weight: 500;
            margin-bottom: 5px;
        }
        
        .today {
            background-color: rgba(59, 89, 152, 0.1);
            border: 2px solid var(--primary-color);
        }
        
        .today .day-number {
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .event {
            background-color: #e9ecef;
            border-radius: 4px;
            padding: 2px 5px;
            margin-top: 2px;
            font-size: 0.75rem;
            text-align: left;
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .event.lecture {
            background-color: #d1ecf1;
            border-left: 3px solid #0dcaf0;
        }
        
        .event.lab {
            background-color: #d4edda;
            border-left: 3px solid #198754;
        }
        
        .event.exam {
            background-color: #f8d7da;
            border-left: 3px solid #dc3545;
        }
        
        .event.meeting {
            background-color: #e7f1ff;
            border-left: 3px solid #0d6efd;
        }
        
        /* ===== LEGEND ===== */
        .legend {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-top: 1.8rem;
        }
        
        .legend-item {
            display: flex;
            align-items: center;
        }
        
        .legend-color {
            width: 16px;
            height: 16px;
            border-radius: 3px;
            margin-right: 8px;
            flex-shrink: 0;
        }
        
        .lecture-color {
            background-color: #d1ecf1;
            border-left: 3px solid #0dcaf0;
        }
        
        .lab-color {
            background-color: #d4edda;
            border-left: 3px solid #198754;
        }
        
        .exam-color {
            background-color: #f8d7da;
            border-left: 3px solid #dc3545;
        }
        
        .meeting-color {
            background-color: #e7f1ff;
            border-left: 3px solid #0d6efd;
        }
        
        /* ===== SCHEDULE LIST ===== */
        .schedule-list {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 1.8rem;
            margin-bottom: 2.5rem;
        }
        
        .schedule-item {
            display: flex;
            border-bottom: 1px solid #dee2e6;
            padding: 1rem 0;
        }
        
        .schedule-item:last-child {
            border-bottom: none;
        }
        
        .schedule-date {
            min-width: 80px;
            text-align: center;
            padding-right: 1rem;
        }
        
        .schedule-day {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            line-height: 1;
        }
        
        .schedule-month {
            font-size: 0.85rem;
            color: #6c757d;
            text-transform: uppercase;
        }
        
        .schedule-details {
            flex: 1;
        }
        
        .schedule-time {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.25rem;
        }
        
        .schedule-title {
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: var(--dark-color);
        }
        
        .schedule-location {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
        }
        
        .schedule-type {
            display: inline-block;
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .type-lecture {
            background-color: #d1ecf1;
            color: #055160;
        }
        
        .type-lab {
            background-color: #d4edda;
            color: #0f5132;
        }
        
        .type-exam {
            background-color: #f8d7da;
            color: #842029;
        }
        
        /* ===== FOOTER STYLES ===== */
        .footer {
            background-color: var(--dark-color);
            color: white;
            padding: 3rem 0 1.5rem;
            margin-top: auto;
        }
        
        .footer-content {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            justify-content: space-between;
        }
        
        .footer-section {
            flex: 1;
            min-width: 250px;
        }
        
        .footer h5 {
            color: #fff;
            margin-bottom: 1.2rem;
            font-weight: 600;
            position: relative;
            padding-bottom: 0.5rem;
        }
        
        .footer h5::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 2px;
            background-color: var(--primary-color);
        }
        
        .quick-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: block;
            margin-bottom: 0.7rem;
            transition: color 0.3s;
        }
        
        .quick-links a:hover {
            color: white;
        }
        
        .footer p {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 0.8rem;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        
        .footer i {
            width: 20px;
            margin-top: 4px;
        }
        
        .copyright {
            text-align: center;
            margin-top: 2.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.6);
            width: 100%;
        }
        
        /* ===== RESPONSIVE ADJUSTMENTS ===== */
        @media (max-width: 992px) {
            .navbar ul {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .navbar ul li {
                margin: 0.3rem;
            }
            
            .calendar-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .calendar td {
                height: 80px;
                padding: 0.5rem 0.3rem;
            }
            
            .event {
                font-size: 0.7rem;
            }
        }
        
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 1rem;
            }
            
            .logo {
                margin-bottom: 1rem;
            }
            
            .calendar-container, 
            .schedule-list {
                padding: 1.2rem;
            }
            
            .calendar th, 
            .calendar td {
                padding: 0.5rem 0.2rem;
            }
            
            .day-number {
                font-size: 0.9rem;
            }
            
            .schedule-item {
                flex-direction: column;
            }
            
            .schedule-date {
                display: flex;
                align-items: center;
                gap: 1rem;
                margin-bottom: 0.5rem;
            }
            
            .schedule-day {
                font-size: 1.25rem;
            }
            
            .footer-section {
                flex: 0 0 100%;
            }
        }
        
        @media (max-width: 576px) {
            .calendar th, 
            .calendar td {
                padding: 0.3rem 0.1rem;
                font-size: 0.8rem;
            }
            
            .day-number {
                font-size: 0.8rem;
            }
            
            .event {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <i class="fas fa-building"></i>SarPras TI
        </div>
        <ul>
            <li><a href="/home">Beranda</a></li>
            <li><a href="/kalender" class="active">Kalender Perkuliahan</a></li>
            <li><a href="/peminjaman">Daftar Peminjaman</a></li>
            <li><a href="/berita">Berita</a></li>
            <li><a href="/about">Tentang</a></li>
            <li>
                <a href="/login" class="btn-warning">
                    <i class="fa-solid fa-right-to-bracket"></i> Login
                </a>
            </li>
        </ul>
    </nav>

    <!-- Breadcrumb -->
    <div class="breadcrumb-container">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kalender Perkuliahan</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container main-content">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title"><i class="fa-solid fa-calendar-days"></i> Kalender Perkuliahan</h1>
            <p class="page-description">Lihat jadwal perkuliahan, ujian, dan kegiatan akademik lainnya</p>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <h3 class="filter-title"><i class="fa-solid fa-filter"></i> Filter Jadwal</h3>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="programFilter" class="form-label">Program Studi</label>
                    <select class="form-select" id="programFilter">
                        <option selected>Semua Program Studi</option>
                        <option>Teknologi Informasi</option>
                        <option>Sistem Informasi</option>
                        <option>Informatika</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="monthFilter" class="form-label">Bulan</label>
                    <select class="form-select" id="monthFilter">
                        <option selected>September 2025</option>
                        <option>Oktober 2025</option>
                        <option>November 2025</option>
                        <option>Desember 2025</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="eventTypeFilter" class="form-label">Jenis Kegiatan</label>
                    <select class="form-select" id="eventTypeFilter">
                        <option selected>Semua Kegiatan</option>
                        <option>Perkuliahan</option>
                        <option>Praktikum</option>
                        <option>Ujian</option>
                        <option>Rapat</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Calendar Section -->
        <div class="calendar-container">
            <div class="calendar-header">
                <div class="month-navigation">
                    <button class="btn btn-outline-primary">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <h2 class="month-title">September 2025</h2>
                    <button class="btn btn-outline-primary">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
                <div class="calendar-controls">
                    <button class="btn btn-outline-secondary">
                        <i class="fa-solid fa-download"></i> Unduh
                    </button>
                    <button class="btn btn-primary">
                        <i class="fa-solid fa-print"></i> Cetak
                    </button>
                </div>
            </div>
            
            <div class="calendar">
                <table>
                    <thead>
                        <tr>
                            <th>Senin</th>
                            <th>Selasa</th>
                            <th>Rabu</th>
                            <th>Kamis</th>
                            <th>Jumat</th>
                            <th>Sabtu</th>
                            <th>Minggu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <span class="day-number">1</span>
                            </td>
                            <td>
                                <span class="day-number">2</span>
                            </td>
                            <td>
                                <span class="day-number">3</span>
                                <span class="event lecture">Pemrograman Web (08:00)</span>
                                <span class="event lab">Praktikum Jaringan (13:00)</span>
                            </td>
                            <td>
                                <span class="day-number">4</span>
                                <span class="event lecture">Basis Data (10:00)</span>
                            </td>
                            <td>
                                <span class="day-number">5</span>
                                <span class="event meeting">Rapat Dosen (14:00)</span>
                            </td>
                            <td>
                                <span class="day-number">6</span>
                            </td>
                            <td>
                                <span class="day-number">7</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="day-number">8</span>
                                <span class="event lecture">Sistem Operasi (09:00)</span>
                            </td>
                            <td>
                                <span class="day-number">9</span>
                                <span class="event exam">UTS - Algoritma (10:00)</span>
                            </td>
                            <td>
                                <span class="day-number">10</span>
                                <span class="event lecture">Pemrograman Web (08:00)</span>
                            </td>
                            <td>
                                <span class="day-number">11</span>
                                <span class="event lecture">Basis Data (10:00)</span>
                                <span class="event lab">Praktikum Mobile (13:00)</span>
                            </td>
                            <td>
                                <span class="day-number">12</span>
                            </td>
                            <td>
                                <span class="day-number">13</span>
                                <span class="event lecture">Kuliah Umum (09:00)</span>
                            </td>
                            <td>
                                <span class="day-number">14</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="day-number">15</span>
                                <span class="event lecture">Sistem Operasi (09:00)</span>
                            </td>
                            <td>
                                <span class="day-number">16</span>
                                <span class="event lecture">Jaringan Komputer (11:00)</span>
                            </td>
                            <td>
                                <span class="day-number">17</span>
                                <span class="event lecture">Pemrograman Web (08:00)</span>
                                <span class="event lab">Praktikum Jaringan (13:00)</span>
                            </td>
                            <td>
                                <span class="day-number">18</span>
                                <span class="event lecture">Basis Data (10:00)</span>
                            </td>
                            <td>
                                <span class="day-number">19</span>
                                <span class="event exam">UAS - Matematika (08:00)</span>
                            </td>
                            <td>
                                <span class="day-number">20</span>
                            </td>
                            <td>
                                <span class="day-number">21</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="day-number">22</span>
                                <span class="event lecture">Sistem Operasi (09:00)</span>
                            </td>
                            <td>
                                <span class="day-number">23</span>
                                <span class="event lecture">Jaringan Komputer (11:00)</span>
                            </td>
                            <td>
                                <span class="day-number">24</span>
                                <span class="event lecture">Pemrograman Web (08:00)</span>
                            </td>
                            <td>
                                <span class="day-number">25</span>
                                <span class="event lecture">Basis Data (10:00)</span>
                                <span class="event lab">Praktikum Mobile (13:00)</span>
                            </td>
                            <td>
                                <span class="day-number">26</span>
                                <span class="event exam">UAS - Pemrograman (08:00)</span>
                            </td>
                            <td>
                                <span class="day-number">27</span>
                            </td>
                            <td>
                                <span class="day-number">28</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="day-number">29</span>
                                <span class="event lecture">Sistem Operasi (09:00)</span>
                            </td>
                            <td>
                                <span class="day-number">30</span>
                                <span class="event lecture">Jaringan Komputer (11:00)</span>
                                <span class="event meeting">Seminar TA (14:00)</span>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="legend">
                <div class="legend-item">
                    <div class="legend-color lecture-color"></div>
                    <span>Perkuliahan</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color lab-color"></div>
                    <span>Praktikum/Lab</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color exam-color"></div>
                    <span>Ujian</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color meeting-color"></div>
                    <span>Rapat/Seminar</span>
                </div>
            </div>
        </div>

        <!-- Schedule List -->
        <div class="schedule-list">
            <h3 class="mb-4"><i class="fa-solid fa-list"></i> Daftar Kegiatan Bulan September 2025</h3>
            
            <div class="schedule-item">
                <div class="schedule-date">
                    <div class="schedule-day">3</div>
                    <div class="schedule-month">Sep</div>
                </div>
                <div class="schedule-details">
                    <div class="schedule-time">08:00 - 10:00</div>
                    <h4 class="schedule-title">Pemrograman Web</h4>
                    <div class="schedule-location">Ruang Kelas A, Gedung TI</div>
                    <span class="schedule-type type-lecture">Perkuliahan</span>
                </div>
            </div>
            
            <div class="schedule-item">
                <div class="schedule-date">
                    <div class="schedule-day">3</div>
                    <div class="schedule-month">Sep</div>
                </div>
                <div class="schedule-details">
                    <div class="schedule-time">13:00 - 15:00</div>
                    <h4 class="schedule-title">Praktikum Jaringan Komputer</h4>
                    <div class="schedule-location">Lab Jaringan, Gedung TI</div>
                    <span class="schedule-type type-lab">Praktikum</span>
                </div>
            </div>
            
            <div class="schedule-item">
                <div class="schedule-date">
                    <div class="schedule-day">4</div>
                    <div class="schedule-month">Sep</div>
                </div>
                <div class="schedule-details">
                    <div class="schedule-time">10:00 - 12:00</div>
                    <h4 class="schedule-title">Basis Data</h4>
                    <div class="schedule-location">Ruang Kelas B, Gedung TI</div>
                    <span class="schedule-type type-lecture">Perkuliahan</span>
                </div>
            </div>
            
            <div class="schedule-item">
                <div class="schedule-date">
                    <div class="schedule-day">9</div>
                    <div class="schedule-month">Sep</div>
                </div>
                <div class="schedule-details">
                    <div class="schedule-time">10:00 - 12:00</div>
                    <h4 class="schedule-title">Ujian Tengah Semester - Algoritma</h4>
                    <div class="schedule-location">Ruang Ujian 1, Gedung TI</div>
                    <span class="schedule-type type-exam">Ujian</span>
                </div>
            </div>
            
            <div class="schedule-item">
                <div class="schedule-date">
                    <div class="schedule-day">13</div>
                    <div class="schedule-month">Sep</div>
                </div>
                <div class="schedule-details">
                    <div class="schedule-time">09:00 - 11:00</div>
                    <h4 class="schedule-title">Kuliah Umum: Tren Teknologi Terkini</h4>
                    <div class="schedule-location">Auditorium, Gedung Utama</div>
                    <span class="schedule-type type-lecture">Kuliah Umum</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h5>Prodi Teknologi Informasi</h5>
                    <p>Sistem Peminjaman Sarana Prasarana</p>
                    <p>Platform digital untuk mengelola dan memantau ketersediaan ruangan serta proyektor secara real-time di Program Studi Teknologi Informasi.</p>
                </div>
                <div class="footer-section quick-links">
                    <h5>Link Cepat</h5>
                    <a href="#">Beranda</a>
                    <a href="#">Kalender</a>
                    <a href="#">Peminjaman</a>
                    <a href="#">Panduan</a>
                </div>
                <div class="footer-section">
                    <h5>Kontak</h5>
                    <p><i class="fa-solid fa-phone"></i> (021) 7918-1234</p>
                    <p><i class="fa-solid fa-envelope"></i> info@ti.university.ac.id</p>
                    <p><i class="fa-solid fa-location-dot"></i> Gedung Teknologi Informasi</p>
                </div>
            </div>
            <div class="copyright">
                <p>© 2025 Program Studi Teknologi Informasi. Semua hak cipta dilindungi.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>