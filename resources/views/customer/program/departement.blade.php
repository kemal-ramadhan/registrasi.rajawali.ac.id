@extends('customer.template.template', ['title' => 'Menu Utama', 'menu' => 'pendaftaran'])

@section('content')
    <div class="w-full">
        <div class="w-full">
            <div class="w-full bg-white hidden md:flex items-center p-5 rounded-2xl outline outline-1 outline-gray-200 mb-5">
                <div class="">
                    <div class="flex gap-2">
                        <small class="font-sora flex gap-2">
                            <span>
                                <a href="{{ route('jalur.pendaftaran') }}" class="font-bold">Jalur Pendaftaran / </a>
                                <a href="{{ route('registration.program') }}" class="font-bold">Pilih Jenjang Studi / </a>
                                <a href="{{ route('registration.fakultas', $fakultas->id) }}"
                                    class="font-bold">{{ $fakultas->name }}</a>
                            </span>
                        </small>
                    </div>
                </div>
            </div>
            <div class="md:col-span-6 p-5 bg-white outline outline-1 outline-gray-200 rounded-2xl">
                <div class="flex flex-col gap-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach ($departements as $item)
                            <a href="{{ route('registration.path', ['id' => $item->id]) }}">
                                <div class="relative overflow-hidden flex flex-col gap-3 outline h-30 outline-1 outline-gray-200 p-5 rounded-2xl bg-primary text-white hover:bg-primary-hover hover:text-white hover:shadow-lg">
                                    <img src="{{ asset('assets/icons/outline.png') }}" alt="outline" class="w-20 absolute bottom-0 -right-5 opacity-50">
                                    <h1 class="font-sora font-semibold">{{ $item->name }}</h1>
                                    <small class="font-sora font-light line-clamp-3">{!! $item->description !!}</small>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
