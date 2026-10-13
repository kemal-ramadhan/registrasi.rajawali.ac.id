<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="shortcut icon" href="{{ asset('assets/icons/IKes.png') }}" type="image/x-icon">
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <title>{{ $title }} | Penerimaan Mahasiswa Baru Institut Kesehatan Rajawali</title>
  <!-- SweetAlert2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.16/dist/sweetalert2.min.css" rel="stylesheet">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.16/dist/sweetalert2.min.js"></script>

{{-- select --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>
<body class="flex flex-col min-h-screen text-xs font-sora bg-latar">
    <main class="flex-grow">
        <!-- Konten utama -->
        <div class="py-2 bg-latar">
            <nav class="container mx-auto w-full" x-data="{ open: false }">
                <div class="mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center">
                        <!-- Sisi Kiri (Logo) -->
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('assets/icons/IKes.png') }}" alt="IKes Rajawali" style="width: 50px">
                            <div class="flex flex-col">
                                <h1 class="text-lg font-sora font-bold drop-shadow-[0_2px_2px_rgba(255,255,255,0.7)]">Institut Kesehatan Rajawali</h1>
                                <small class="font-sora font-semibold drop-shadow-[0_1px_1px_rgba(255,255,255,0.7)]"><i>Transforming New Generation</i></small>
                            </div>
                        </div>
        
                        <!-- Sisi Kanan (Profile - Desktop) -->
                        <div class="hidden md:flex items-center space-x-3">
                            @auth
                                <div class="relative" x-data="{ show: false }">
                                    <button @click="show = !show" class="flex items-center space-x-3 text-gray-700 focus:outline-none gap-3">
                                        <div class="flex flex-col gap-1 text-right">
                                            <span>{{ auth()->user()->name }}</span>
                                            <span>{{ auth()->user()->email }}</span>
                                        </div>
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}" 
                                             alt="Profile" class="w-8 h-8 rounded-full">
                                    </button>
        
                                    <!-- Dropdown Profile -->
                                    <div x-show="show" @click.away="show = false" class="absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-md p-2">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                                Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Login</a>
                            @endauth
                        </div>
                    </div>
        
                </div>
            </nav>
        </div>    

        <div class="flex gap-5 m-5 items-start justify-center">  
            {{-- main content --}}
            <div class="flex flex-col gap-5 text-xs w-full px-2 rounded-xl">
                @yield('content')
            </div>
        </div> 
    </main>
    

    <hr>
    <footer class="flex justify-center items-center py-3 px-3 mx-auto text-center">
        <small>Copyright &copy; {{ date('Y') }} - Sistem Penerimaan Mahasiswa Baru By HexagonInc</small>
    </footer>

    <!-- Menampilkan SweetAlert jika ada session 'success' -->
    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
        });
    </script>
    @endif
    @if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
        });
    </script>
    @endif

    
    
    <script>
        const menuBtn = document.getElementById('menu-btn');
        const closeBtn = document.getElementById('close-btn');
        const sidebar = document.getElementById('sidebar');

        menuBtn.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
        });

        closeBtn.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
        });
    </script>

    <script>
        function toggleMenu(id) {
            const submenu = document.getElementById(id);
            const icon = document.getElementById(`icon-${id}`);

            submenu.classList.toggle("hidden");
            icon.classList.toggle("rotate-180");
        }
    </script>   
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('navbar', () => ({
                open: false
            }));
        });
    </script>
</body>
</html>