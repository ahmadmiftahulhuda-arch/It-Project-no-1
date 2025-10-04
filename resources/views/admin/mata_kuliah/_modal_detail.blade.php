<!-- Modal Detail -->
<div id="detailModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center px-4 sm:px-0 modal-leave-active">
    <div id="detailModalContent" class="bg-white rounded-lg shadow-xl w-full max-w-lg p-6 mx-4 sm:mx-0 modal-enter">
        <div class="flex items-center justify-between pb-4 border-b">
            <h3 class="text-xl font-semibold text-gray-800">Detail Mata Kuliah</h3>
            <button onclick="closeDetailModal()" class="text-gray-400 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
        <div class="mt-6 space-y-4 text-sm">
            <div class="flex justify-between">
                <span class="font-medium text-gray-500">Nama Mata Kuliah</span>
                <span id="detail_nama" class="text-gray-900 font-semibold"></span>
            </div>
            <div class="flex justify-between">
                <span class="font-medium text-gray-500">Kode</span>
                <span id="detail_kode" class="text-gray-900"></span>
            </div>
            <div class="flex justify-between">
                <span class="font-medium text-gray-500">Semester</span>
                <span id="detail_semester" class="text-gray-900"></span>
            </div>
        </div>
        <div class="flex items-center justify-end pt-6 border-t mt-6">
            <button onclick="closeDetailModal()" type="button" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Tutup</button>
        </div>
    </div>
</div>