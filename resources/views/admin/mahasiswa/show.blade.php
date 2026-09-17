@extends('admin.template.template', ['title' => 'Detail Mahasiswa'])

@section('content')
    <div class="bg-white rounded-xl p-5">
        <table class="w-full border-collapse border border-gray-300">
            {{-- Personal Data --}}
            <tr class="border-b border-gray-300">
                <td class="p-3 font-semibold bg-gray-100" colspan="2">Personal Data</td>
            </tr>
            <tr>
                <td class="p-3 font-semibold bg-gray-100">Nama Lengkap</td>
                <td class="p-3">{{ $user->name }}</td>
            </tr>
            <tr>
                <td class="p-3 font-semibold bg-gray-100">Alamat Email</td>
                <td class="p-3">{{ $user->email }}</td>
            </tr>
            <tr>
                <td class="p-3 font-semibold bg-gray-100">No Telepon / WhatsApp</td>
                <td class="p-3">{{ $user->phone }}</td>
            </tr>
            <tr>
                <td class="p-3 font-semibold bg-gray-100">NIK</td>
                <td class="p-3">{{ optional($personalData)->nik ?? 'Belum diisi' }}</td>
            </tr>
            <tr>
                <td class="p-3 font-semibold bg-gray-100">NISN</td>
                <td class="p-3">{{ optional($personalData)->nisn ?? 'Belum diisi' }}</td>
            </tr>
            <tr>
                <td class="p-3 font-semibold bg-gray-100">Tempat, Tanggal Lahir</td>
                <td class="p-3">{{ optional($personalData)->place_of_birth ?? '-' }},
                    {{ optional($personalData)->date_of_birth ?? '-' }}</td>
            </tr>
            <tr>
                <td class="p-3 font-semibold bg-gray-100">Agama</td>
                <td class="p-3">{{ optional($personalData)->religion ?? 'Belum diisi' }}</td>
            </tr>
            <tr>
                <td class="p-3 font-semibold bg-gray-100">Media Informasi PMB</td>
                <td class="p-3">{{ optional($personalData)->media_information ?? 'Belum diisi' }}</td>
            </tr>

            {{-- Pendidikan --}}
            <tr>
                <td class="p-3 font-semibold bg-gray-100" colspan="2">Pendidikan Terakhir</td>
            </tr>
            <tr>
                <td class="p-3 font-semibold bg-gray-100">Pendidikan Terakhir</td>
                <td class="p-3">{{ optional($education)->last_education ?? 'Belum diisi' }}</td>
            </tr>
            <tr>
                <td class="p-3 font-semibold bg-gray-100">Negara</td>
                <td class="p-3">{{ optional($education)->country ?? 'Belum diisi' }}</td>
            </tr>
            <tr>
                <td class="p-3 font-semibold bg-gray-100">Provinsi</td>
                <td class="p-3">{{ optional($education)->province ?? 'Belum diisi' }}</td>
            </tr>
            <tr>
                <td class="p-3 font-semibold bg-gray-100">Kota / Kabupaten</td>
                <td class="p-3">{{ optional($education)->city ?? 'Belum diisi' }}</td>
            </tr>
            <tr>
                <td class="p-3 font-semibold bg-gray-100">Jenis Sekolah</td>
                <td class="p-3">{{ optional($education)->type ?? 'Belum diisi' }}</td>
            </tr>
            <tr>
                <td class="p-3 font-semibold bg-gray-100">Nama Sekolah</td>
                <td class="p-3">{{ optional($education)->name_of_institution ?? 'Belum diisi' }}</td>
            </tr>
            <tr>
                <td class="p-3 font-semibold bg-gray-100">Jurusan / Program Studi</td>
                <td class="p-3">{{ optional($education)->departement ?? 'Belum diisi' }}</td>
            </tr>
            <tr>
                <td class="p-3 font-semibold bg-gray-100">Tahun Lulus</td>
                <td class="p-3">{{ optional($education)->year_of_graduation ?? 'Belum diisi' }}</td>
            </tr>
            <tr>
                <td class="p-3 font-semibold bg-gray-100">Nilai Akhir / GPA / IPK</td>
                <td class="p-3">{{ optional($education)->grade ?? 'Belum diisi' }}</td>
            </tr>

            {{-- Alamat --}}
            <tr>
                <td class="p-3 font-semibold bg-gray-100" colspan="2">Alamat Pribadi</td>
            </tr>
            <tr>
                <td class="p-3 font-semibold bg-gray-100">Negara</td>
                <td class="p-3">{{ optional($address)->country ?? 'Belum diisi' }}</td>
            </tr>
            <tr>
                <td class="p-3 font-semibold bg-gray-100">Provinsi</td>
                <td class="p-3">{{ optional($address)->province ?? 'Belum diisi' }}</td>
            </tr>
            <tr>
                <td class="p-3 font-semibold bg-gray-100">Kota / Kabupaten</td>
                <td class="p-3">{{ optional($address)->city ?? 'Belum diisi' }}</td>
            </tr>
            <tr>
                <td class="p-3 font-semibold bg-gray-100">Kecamatan</td>
                <td class="p-3">{{ optional($address)->district ?? 'Belum diisi' }}</td>
            </tr>
            <tr>
                <td class="p-3 font-semibold bg-gray-100">Kelurahan</td>
                <td class="p-3">{{ optional($address)->village ?? 'Belum diisi' }}</td>
            </tr>
            <tr>
                <td class="p-3 font-semibold bg-gray-100">Kode Pos</td>
                <td class="p-3">{{ optional($address)->code ?? 'Belum diisi' }}</td>
            </tr>
            <tr>
                <td class="p-3 font-semibold bg-gray-100">Alamat Lengkap</td>
                <td class="p-3">{{ optional($address)->address ?? 'Belum diisi' }}</td>
            </tr>

            {{-- Penghasilan --}}
            <tr>
                <td class="p-3 font-semibold bg-gray-100" colspan="2">Penghasilan</td>
            </tr>
            <tr>
                <td class="p-3 font-semibold bg-gray-100">Sumber Penghasilan</td>
                <td class="p-3">{{ optional($income)->source ?? 'Belum diisi' }}</td>
            </tr>
            <tr>
                <td class="p-3 font-semibold bg-gray-100">Penghasilan</td>
                <td class="p-3">
                    Rp {{ optional($income)->amount ? number_format($income->amount, 0, ',', '.') : '0' }}
                </td>
            </tr>

            {{-- Keluarga --}}
            <tr>
                <td class="p-3 font-semibold bg-gray-100" colspan="2">Keluarga</td>
            </tr>
            @forelse ($families as $familie)
                <tr>
                    <td class="p-3 font-semibold bg-gray-100">Hubungan</td>
                    <td class="p-3">{{ $familie->relation }}</td>
                </tr>
                <tr>
                    <td class="p-3 font-semibold bg-gray-100">Nama Lengkap</td>
                    <td class="p-3">{{ $familie->name }}</td>
                </tr>
                <tr>
                    <td class="p-3 font-semibold bg-gray-100">Status</td>
                    <td class="p-3">{{ $familie->status }}</td>
                </tr>
                <tr>
                    <td class="p-3 font-semibold bg-gray-100">Nomor Telepon</td>
                    <td class="p-3">{{ $familie->phone }}</td>
                </tr>
                <tr>
                    <td class="p-3 font-semibold bg-gray-100">Pekerjaan</td>
                    <td class="p-3">{{ $familie->job }}</td>
                </tr>
                <tr>
                    <td class="p-3 font-semibold bg-gray-100">Pendidikan</td>
                    <td class="p-3">{{ $familie->education }}</td>
                </tr>
                <tr>
                    <td class="p-3 font-semibold bg-gray-100">Alamat</td>
                    <td class="p-3">{{ $familie->address }}</td>
                </tr>
            @empty
                <tr>
                    <td class="p-3 text-center" colspan="2">Belum ada data keluarga.</td>
                </tr>
            @endforelse
            {{-- Keluarga --}}
            <tr>
                <td class="p-3 font-semibold bg-gray-100" colspan="2">Kode Referal</td>
            </tr>
            <form id="updateForm" action="{{ route('mahasiswa.updateReferal', ['id' => $personalData->id]) }}"
                method="post">
                @csrf
                @method('PUT')
                <tr>
                    <td class="p-3 font-semibold bg-gray-100">Kode Referal</td>
                    <td class="p-3">
                        <div class="flex flex-col mb-3">
                            <label for="referal_id" class="font-sora font-semibold">Kode Referal (Tidak Wajib)</label>
                            <small class="font-sora mb-3"><i>Code Referal</i></small>

                            <select name="referal_id" id="referal_id"
                                class="py-2 px-5 border border-gray-500 w-full rounded-md my-2 bg-transparent select2">
                                <option value="">Pilih Code Referal</option>

                                @foreach ($referals as $referal)
                                    <option value="{{ $referal->id }}"
                                        {{ isset($personalData->referal_id) && $personalData->referal_id == $referal->id ? 'selected' : '' }}>
                                        {{ $referal->code }} - {{ $referal->institution }}
                                    </option>
                                @endforeach
                            </select>

                            @error('referal_id')
                                <div>
                                    <small class="text-red-500"><i>{{ $message }}</i></small>
                                </div>
                            @enderror
                        </div>
                    </td>
                </tr>
        </table>
        <div class="my-5 flex justify-end">
            <button type="submit"
                class="py-3 px-5 text-center bg-primary text-white font-sora font-semibold rounded-lg">Perbaharui
                Data</button>
        </div>
        </form>
    </div>


    <script>
        $(document).ready(function() {
            $('#referal_id').select2({
                placeholder: "Pilih Code Referal",
                allowClear: true,
                width: '100%',
            });
        });
    </script>

    <script>
        document.getElementById('updateForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Cegah submit langsung

            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Data pribadi akan diperbarui.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, perbarui!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // Submit form kalau dikonfirmasi
                }
            });
        });
    </script>
@endsection
