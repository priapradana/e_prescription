<header class="mb-6 flex justify-between items-center border-b pb-4">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    {{-- Kiri: Judul + Toggle --}}
    <div class="flex items-center space-x-4">
        <button id="toggleSidebar" class="text-primary focus:outline-none">
            <i class="fas fa-bars text-xl"></i>
        </button>
        <div>
            <h1 class="text-xl font-semibold text-primary">Sipatex</h1>
            <p class="text-sm text-gray-500">Sistem E‑Prescription Apotek</p>
        </div>

    </div>

    {{-- Kanan: User Info + Logout --}}
    <div class="flex items-center space-x-4">
        <span class="text-sm text-gray-600 hidden sm:inline">
            👤 {{ Auth::user()->name ?? 'Tamu' }}
        </span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="text-sm px-4 py-2 border border-red-600 text-red-600 bg-white hover:bg-red-50 rounded-md transition font-medium">
                Logout
            </button>
        </form>
    </div>
</header>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const labels = document.querySelectorAll('.sidebar-label');
        const submenus = document.querySelectorAll('.submenu');

        toggleBtn?.addEventListener('click', () => {
            sidebar.classList.toggle('w-50');
            sidebar.classList.toggle('w-20');

            labels.forEach(el => el.classList.toggle('hidden'));

            if (sidebar.classList.contains('w-20')) {
                submenus.forEach(el => el.classList.add('hidden'));
            }
        });
    });

    function toggleSubmenu(id) {
        const sidebar = document.getElementById('sidebar');
        const submenu = document.getElementById(id);

        // Jika sidebar sedang kecil, perbesar dulu
        if (sidebar.classList.contains('w-20')) {
            sidebar.classList.remove('w-20');
            sidebar.classList.add('w-50');

            // Tampilkan semua label
            document.querySelectorAll('.sidebar-label').forEach(el => el.classList.remove('hidden'));
        }

        // Toggle submenu
        submenu?.classList.toggle('hidden');
    }
</script>




