<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Mata Kuliah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        :root{
            --primary:#3b5998; /* biru tua */
            --secondary:#6d84b4; /* biru muda */
        }

        .sidebar{
            position:fixed;
            top:0; left:0;
            width:250px; height:100vh;
            background:linear-gradient(180deg,var(--primary),var(--secondary));
            color:#fff;
            box-shadow:2px 0 10px rgba(0,0,0,.08);
            display:flex; flex-direction:column;
            transition: width 0.3s ease;
        }

        .sidebar-header{
            padding:24px 20px;
            text-align:center;
            border-bottom:1px solid rgba(255,255,255,.15);
        }
        .sidebar-logo{
            font-size:32px; opacity:.9; margin-bottom:8px;
        }
        .sidebar-header h2{
            font-size:28px; font-weight:700; margin:0;
        }

        .sidebar-menu{
            padding:10px 0; overflow-y:auto; flex:1;
        }
        .sidebar-menu::-webkit-scrollbar {
            display: none;
        }
        .sidebar-menu {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
        .sidebar-menu::-webkit-scrollbar {
            display: none;
        }
        .sidebar-menu {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
        .sidebar-menu::-webkit-scrollbar {
            display: none;
        }
        .sidebar-menu {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
        .sidebar-menu a{
            display:flex; align-items:center; gap:12px;
            padding:12px 20px;
            color:rgba(255,255,255,.85);
            text-decoration:none;
            border-left:4px solid transparent;
            transition:.2s ease;
        }
        .sidebar-menu a i{
            width:20px; text-align:center; opacity:.9;
        }
        .sidebar-menu a:hover{
            background-color:rgba(255,255,255,.10);
            color:#fff;
        }
        .sidebar-menu a.active{
            background-color:rgba(255,255,255,.18);
            color:#fff;
            border-left-color:#fff;
        }

        .main-content {
            margin-left: 250px;
            transition: margin-left 0.3s ease;
        }

        .modal-enter {
            opacity: 0;
            transform: translateY(20px) scale(0.95);
        }
        .modal-enter-active {
            opacity: 1;
            transform: translateY(0) scale(1);
            transition: all 300ms ease-out;
        }
        .modal-leave-active {
            opacity: 0;
            transform: translateY(20px) scale(0.95);
            transition: all 200ms ease-in;
        }
        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px){
            .sidebar{ width:70px; }
            .sidebar-header h2{ display:none; }
            .sidebar-menu a{ justify-content:center; }
            .sidebar-menu a span{ display:none; }
            .main-content { margin-left: 70px; }
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo"><i class="fas fa-laptop-code"></i></div>
            <h2>Admin TI</h2>
        </div>

        <nav class="sidebar-menu">
            <a href="/admin/dashboard">
                <i class="fas fa-home"></i><span>Dashboard</span>
            </a>
            <a href="/admin/peminjaman">
                <i class="fas fa-hand-holding"></i><span>Peminjaman</span>
            </a>
            <a href="/admin/pengembalian">
                <i class="fas fa-undo"></i><span>Pengembalian</span>
            </a>
            <a href="/admin/riwayat">
                <i class="fas fa-history"></i><span>Riwayat Peminjaman</span>
            </a>
            <a href="/admin/feedback">
                <i class="fas fa-comment"></i><span>Feedback</span>
            </a>
            <a href="/admin/proyektor">
                <i class="fas fa-video"></i><span>Proyektor</span>
            </a>
            <a href="/admin/jadwalperkuliahan">
                <i class="fas fa-calendar-alt"></i><span>Jadwal Perkuliahan</span>
            </a>
            <a href="/admin/ruangan">
                <i class="fas fa-door-open"></i><span>Ruangan</span>
            </a>
            <a href="/admin/slotwaktu">
                <i class="fas fa-clock"></i><span>Slot Waktu</span>
            </a>
            <a href="{{ route('mata_kuliah.index') }}" class="active">
                <i class="fas fa-book"></i><span>Matakuliah</span>
            </a>
            <a href="/admin/kelas">
                <i class="fas fa-users"></i><span>Kelas</span>
            </a>
            <a href="/admin/laporan">
                <i class="fas fa-chart-bar"></i><span>Statistik</span>
            </a>
            <a href="/admin/pengaturan">
                <i class="fas fa-cog"></i><span>Pengaturan</span>
            </a>
        </nav>
    </aside>

    <main class="main-content">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 shadow-lg fade-in">
            <div class="container mx-auto px-4 sm:px-8 py-12">
                <div class="flex items-center text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v11.494m-9-5.747h18" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 21.75l4.5-4.5-4.5-4.5" />
                    </svg>
                    <div>
                        <h1 class="text-3xl font-bold">Manajemen Mata Kuliah</h1>
                        <p class="text-indigo-200 mt-1">Platform terpusat untuk mengelola data mata kuliah secara efisien.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-4 sm:px-8 py-8 fade-in" style="animation-delay: 100ms;">
            
            <!-- Action Bar -->
            <div class="p-4 bg-white rounded-lg shadow-md mb-6 flex items-center justify-between">
                <form action="{{ route('mata_kuliah.index') }}" method="GET" class="flex-grow max-w-lg">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                        <input type="text" name="search" placeholder="Cari berdasarkan nama atau kode..." value="{{ request('search') }}"
                            class="w-full pl-10 pr-4 py-2 border rounded-lg text-sm text-gray-700 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </form>
                <button onclick="openCreateModal()"
                    class="ml-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Baru
                </button>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Mata Kuliah</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kode</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Semester</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($mataKuliahs as $mk)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm font-semibold text-gray-900">{{ $mk->nama }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $mk->kode }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm text-gray-700">Semester {{ $mk->semester }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <div class="flex justify-center items-center gap-4">
                                    <button onclick="openDetailModal('{{ $mk->kode }}','{{ $mk->nama }}','{{ $mk->semester }}')" class="text-blue-500 hover:text-blue-700 transition-transform transform hover:scale-110" title="Lihat Detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.523 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <button onclick="openEditModal('{{ $mk->id }}','{{ $mk->kode }}','{{ $mk->nama }}','{{ $mk->semester }}')" class="text-yellow-500 hover:text-yellow-700 transition-transform transform hover:scale-110" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <form action="{{ route('mata_kuliah.destroy',$mk->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 transition-transform transform hover:scale-110" title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm4 0a1 1 0 012 0v6a1 1 0 11-2 0V8z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-16 px-4">
                            <div class="flex flex-col items-center justify-center text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                    <h3 class="text-lg font-semibold">Belum Ada Data</h3>
                                    <p class="text-sm">Silakan tambahkan mata kuliah baru untuk memulai.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Modals -->
    @include('admin.mata_kuliah._modal_create')
    @include('admin.mata_kuliah._modal_edit')
    @include('admin.mata_kuliah._modal_detail')

    <script>
        const createModal = document.getElementById('createModal');
        const createModalContent = document.getElementById('createModalContent');
        const editModal = document.getElementById('editModal');
        const editModalContent = document.getElementById('editModalContent');
        const detailModal = document.getElementById('detailModal');
        const detailModalContent = document.getElementById('detailModalContent');

        function openCreateModal() {
            createModal.classList.remove('hidden', 'modal-leave-active');
            createModalContent.classList.add('modal-enter-active');
            createModalContent.classList.remove('modal-enter');
        }
        function closeCreateModal() {
            createModalContent.classList.remove('modal-enter-active');
            createModalContent.classList.add('modal-leave-active');
            setTimeout(() => {
                createModal.classList.add('hidden');
            }, 200);
        }

        function openEditModal(id, kode, nama, semester) {
            let form = document.getElementById('editForm');
            let action = "{{ route('mata_kuliah.update', ['mata_kuliah' => 'PLACEHOLDER']) }}";
            form.setAttribute('action', action.replace('PLACEHOLDER', id));
            document.getElementById('edit_kode').value = kode;
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_semester').value = semester;
            editModal.classList.remove('hidden', 'modal-leave-active');
            editModalContent.classList.add('modal-enter-active');
            editModalContent.classList.remove('modal-enter');
        }
        function closeEditModal() {
            editModalContent.classList.remove('modal-enter-active');
            editModalContent.classList.add('modal-leave-active');
            setTimeout(() => {
                editModal.classList.add('hidden');
            }, 200);
        }

        function openDetailModal(kode, nama, semester) {
            document.getElementById('detail_kode').innerText = kode;
            document.getElementById('detail_nama').innerText = nama;
            document.getElementById('detail_semester').innerText = 'Semester ' + semester;
            
            detailModal.classList.remove('hidden', 'modal-leave-active');
            detailModalContent.classList.add('modal-enter-active');
            detailModalContent.classList.remove('modal-enter');
        }
        function closeDetailModal() {
            detailModalContent.classList.remove('modal-enter-active');
            detailModalContent.classList.add('modal-leave-active');
            setTimeout(() => {
                detailModal.classList.add('hidden');
            }, 200);
        }
    </script>

</body>
</html>