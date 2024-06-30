<div class="flex items-center justify-center min-h-screen">
    <div wire:poll="updateRfid" class="max-w-md mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-4">
            @if (is_null($rfidExists))
                <p class="mt-4 p-4 bg-gray-100 border border-gray-200 rounded-lg">Scan RFID Anda untuk melakukan absensi.</p>
            @elseif (!$rfidExists)
                <div class="mt-4 p-4 bg-red-100 border border-red-200 rounded-lg">
                    <span class="text-red-800">RFID Anda belum terdaftar.</span>
                </div>
            @elseif (is_null($ongoingPeriod))
                <div class="mt-4 p-4 bg-red-100 border border-red-200 rounded-lg">
                    <span class="text-red-800">Waktu absensi belum dimulai.</span>
                </div>
            @elseif ($hasAttended)
                <div class="mt-4 p-4 bg-yellow-100 border border-yellow-200 rounded-lg">
                    <span class="text-yellow-800">Anda sudah absen hari ini.</span>
                </div>
            @elseif ($roomFull)
                <div class="mt-4 p-4 bg-red-100 border border-red-200 rounded-lg">
                    <span class="text-red-800">Assisten sudah mencapai batas maksimal ruangan ini.</span>
                </div>
            @elseif ($name)
                <div class="mt-4 p-4 bg-blue-100 border border-blue-200 rounded-lg">
                    <span class="text-blue-800">Selamat Datang, <strong>{{ $name }}</strong>!</span>
                </div>
            @else
                <p class="mt-4 p-4 bg-gray-100 border border-gray-200 rounded-lg">Scan RFID Anda untuk melakukan absensi.</p>
            @endif
        </div>
    </div>
</div>
