<div class="flex items-center justify-center min-h-screen">
    <div wire:poll="updateRfid" class="max-w-md mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Tab Navigation -->
        <div class="flex">
            <button class="flex-1 py-4 text-gray-500 {{ $activeTab == 'masuk' ? 'bg-blue-500 text-white' : 'bg-gray-100' }}" wire:click="switchTab('masuk')">
                Masuk
            </button>
            <button class="flex-1 py-4 text-gray-500 {{ $activeTab == 'keluar' ? 'bg-blue-500 text-white' : 'bg-gray-100' }}" wire:click="switchTab('keluar')">
                Keluar
            </button>
        </div>

        <!-- Tab Content -->
        <div class="p-4">
            @if ($activeTab == 'masuk')
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Absensi Masuk</h3>
                    @if ($hasAttended)
                        <div class="mt-4 p-4 bg-yellow-100 border border-yellow-200 rounded-lg">
                            <span class="text-yellow-800">Anda sudah absen masuk hari ini.</span>
                        </div>
                    @elseif ($name)
                        <div class="mt-4 p-4 bg-blue-100 border border-blue-200 rounded-lg">
                            <span class="text-blue-800">Selamat Datang, <strong>{{ $name }}</strong>!</span>
                        </div>
                    @else
                        <p class="mt-4 p-4 bg-gray-100 border border-gray-200 rounded-lg">Scan RFID Anda untuk melakukan absensi masuk.</p>
                    @endif
                </div>
            @elseif ($activeTab == 'keluar')
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Absensi Keluar</h3>
                    @if ($hasAttended)
                        <div class="mt-4 p-4 bg-yellow-100 border border-yellow-200 rounded-lg">
                            <span class="text-yellow-800">Anda sudah absen keluar hari ini.</span>
                        </div>
                    @elseif ($name)
                        <div class="mt-4 p-4 bg-red-100 border border-red-200 rounded-lg">
                            <span class="text-red-800">Selamat Tinggal, <strong>{{ $name }}</strong>!</span>
                        </div>
                    @else
                        <p class="mt-4 p-4 bg-gray-100 border border-gray-200 rounded-lg">Scan RFID Anda untuk melakukan absensi keluar.</p>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
