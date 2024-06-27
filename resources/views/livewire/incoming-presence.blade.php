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
            @if (!$rfidExists)
                <div class="mt-4 p-4 bg-red-100 border border-red-200 rounded-lg">
                    <span class="text-red-800">RFID Anda belum terdaftar.</span>
                </div>
            @elseif ($hasAttended)
                <div class="mt-4 p-4 bg-yellow-100 border border-yellow-200 rounded-lg">
                    <span class="text-yellow-800">Anda sudah absen {{ $activeTab == 'masuk' ? 'masuk' : 'keluar' }} hari ini.</span>
                </div>
            @elseif ($name)
                <div class="mt-4 p-4 bg-{{ $activeTab == 'masuk' ? 'blue' : 'red' }}-100 border border-{{ $activeTab == 'masuk' ? 'blue' : 'red' }}-200 rounded-lg">
                    <span class="text-{{ $activeTab == 'masuk' ? 'blue' : 'red' }}-800">{{ $activeTab == 'masuk' ? 'Selamat Datang' : 'Selamat Tinggal' }}, <strong>{{ $name }}</strong>!</span>
                </div>
            @else
                <p class="mt-4 p-4 bg-gray-100 border border-gray-200 rounded-lg">Scan RFID Anda untuk melakukan absensi {{ $activeTab == 'masuk' ? 'masuk' : 'keluar' }}.</p>
            @endif
        </div>
    </div>
</div>
