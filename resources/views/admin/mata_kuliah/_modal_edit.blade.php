<!-- Modal Edit -->
<div id="editModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center px-4 sm:px-0 modal-leave-active">
    <div id="editModalContent" class="bg-white rounded-lg shadow-xl w-full max-w-lg p-6 mx-4 sm:mx-0 modal-enter">
        <div class="flex items-center justify-between pb-4 border-b">
            <h3 class="text-xl font-semibold text-gray-800">Edit Mata Kuliah</h3>
            <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
        <form id="editForm" action="{{ route('mata_kuliah.update', ['mata_kuliah' => 'PLACEHOLDER']) }}" method="POST" class="mt-6">
            @csrf
            @method('PUT')
            <div class="space-y-5">
                <div>
                    <label for="edit_nama" class="text-sm font-medium text-gray-700">Nama Mata Kuliah</label>
                    <input type="text" id="edit_nama" name="nama" required
                        class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="edit_kode" class="text-sm font-medium text-gray-700">Kode</label>
                        <input type="text" id="edit_kode" name="kode" required
                            class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                    </div>
                    <div>
                        <label for="edit_semester" class="text-sm font-medium text-gray-700">Semester</label>
                        <input type="number" id="edit_semester" name="semester" required
                            class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end pt-6 border-t mt-6">
                <button onclick="closeEditModal()" type="button" class="text-gray-600 bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 mr-2">Batal</button>
                <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
