@extends('admin.template.template', ['title' => 'Atur Jalur Pendaftaran', 'menu' => 'biaya'])

@section('content')
  <div class="w-full bg-white rounded-2xl p-6 outline outline-1 outline-gray-200">
    <div class="flex items-center justify-between mb-5">
      <div>
        <h1 class="font-sora font-semibold text-lg">Atur Jalur Pendaftaran</h1>
        <p class="text-sm text-gray-500">Biaya: <span class="font-semibold">{{ $biaya->biaya }}</span> &mdash;
          Rp {{ number_format($biaya->nominal, 0, ',', '.') }}</p>
      </div>
      <a href="{{ route('biayareferensi.show', $biaya->id) }}" class="text-sm text-primary hover:underline">&larr;
        Kembali</a>
    </div>

    @if (session('success'))
      <div class="bg-green-50 text-green-700 text-sm p-3 rounded-lg mb-4">
        {{ session('success') }}
      </div>
    @endif

    <p class="text-sm text-gray-500 mb-4">
      Centang jalur pendaftaran yang berhak membayar biaya ini. Anda bisa mencentang lebih dari satu jalur
      jika biaya ini sama untuk beberapa jalur sekaligus. Kosongkan kolom <em>tengat akhir</em> jika ingin
      memakai tengat akhir default ({{ $biaya->tengat_akhir ?? '-' }}) milik biaya ini.
    </p>

    <form action="{{ route('biaya.jalur.store', $biaya->id) }}" method="POST">
      @csrf

      <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
          <thead>
            <tr class="border-b border-gray-200 text-gray-500">
              <th class="py-2 pr-3 w-10"></th>
              <th class="py-2 pr-3">Nama Jalur</th>
              <th class="py-2 pr-3">Gelombang / Kode</th>
              <th class="py-2 pr-3">Tengat Akhir Khusus (opsional)</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($registrationPaths as $path)
              @php
                $isChecked = in_array($path->id, $assignedPathIds);
                $existingDeadline = $pivotByPathId[$path->id]->pivot->tengat_akhir ?? null;
              @endphp
              <tr class="border-b border-gray-100">
                <td class="py-3 pr-3">
                  <input type="checkbox" name="registration_path_ids[]" value="{{ $path->id }}" class="jalur-checkbox"
                    data-target="tengat-{{ $path->id }}" {{ $isChecked ? 'checked' : '' }}>
                </td>
                <td class="py-3 pr-3 font-medium">{{ $path->name }}</td>
                <td class="py-3 pr-3 text-gray-500">{{ $path->title }} ({{ $path->code }})</td>
                <td class="py-3 pr-3">
                  <input type="date" id="tengat-{{ $path->id }}" name="tengat_akhir[{{ $path->id }}]"
                    value="{{ $existingDeadline }}" class="border border-gray-200 rounded-md px-2 py-1 text-sm"
                    {{ $isChecked ? '' : 'disabled' }}>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="py-6 text-center text-gray-400">Belum ada jalur pendaftaran.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="mt-5 flex justify-end">
        <button type="submit" class="bg-primary hover:bg-primary-hover text-white px-5 py-2 rounded-md text-sm">
          Simpan Pengaturan Jalur
        </button>
      </div>
    </form>
  </div>

  <script>
    // Aktif/nonaktifkan input tanggal sesuai checkbox, dan kosongkan nilai saat unchecked
    // supaya tidak terkirim tengat_akhir untuk jalur yang tidak dicentang.
    document.querySelectorAll('.jalur-checkbox').forEach(function(checkbox) {
      checkbox.addEventListener('change', function() {
        var target = document.getElementById(this.dataset.target);
        target.disabled = !this.checked;
        if (!this.checked) {
          target.value = '';
        }
      });
    });
  </script>
@endsection
