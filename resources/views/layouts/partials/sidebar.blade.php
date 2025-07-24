<aside id="sidebar" class="bg-blue-100 border-r shadow-sm w-50 md:block transition-all duration-300 overflow-hidden">

    {{-- Logo --}}
    <div class="p-4 flex items-center space-x-2 justify-center md:justify-start">
        <img src="{{ asset('img/logo/sipatex.png') }}"
            class="w-10 h-10 rounded-full object-cover border border-white shadow" />
        
        {{-- Label akan hilang saat sidebar kecil --}}
        <span class="sidebar-label font-bold text-primary">Sipatex</span>
    </div>


    {{-- Navigasi --}}
    <nav class="p-2 text-primary space-y-2">
        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
        class="flex items-center px-4 py-2 space-x-2 rounded
                {{ request()->routeIs('dashboard') ? 'bg-white text-primary font-semibold' : 'hover:text-primary-dark' }}">
            <i class="fas fa-tachometer-alt text-xl"></i>
            <span class="sidebar-label">Dashboard</span>
        </a>


        {{-- Master --}}
        @php
            $isMasterActive = request()->routeIs('master.obat', 'master.signa', 'master.resep');
        @endphp

        <div class="space-y-1">
            <button type="button"
                    onclick="toggleSubmenu('submenu-master')"
                    class="flex items-center w-full px-4 py-2 space-x-2 rounded
                        {{ $isMasterActive ? 'bg-white text-primary font-semibold' : 'hover:text-primary-dark' }}">
                <i class="fas fa-pills text-xl"></i>
                <span class="sidebar-label">Master</span>
                <i class="fas fa-chevron-down ml-auto text-xs sidebar-label"></i>
            </button>

            {{-- Submenu --}}
            <div id="submenu-master"
                class="ml-10 mt-1 space-y-1 submenu {{ $isMasterActive ? '' : 'hidden' }}">
                <a href="{{ route('master.obat') }}"
                    class="block text-sm rounded px-2 py-1
                            {{ request()->routeIs('master.obat') ? 'bg-blue-200 text-blue-800 font-semibold' : 'hover:text-primary-dark' }}">
                        Data Obat
                </a>
                <a href="{{ route('master.signa') }}"
                    class="block text-sm rounded px-2 py-1
                            {{ request()->routeIs('master.signa') ? 'bg-blue-200 text-blue-800 font-semibold' : 'hover:text-primary-dark' }}">
                        Data Signa
                </a>
                <a href="{{ route('master.resep') }}"
                class="block text-sm rounded px-2 py-1
                        {{ request()->routeIs('master.resep') ? 'bg-blue-200 text-blue-800 font-semibold' : 'hover:text-primary-dark' }}">
                    Data Resep
                </a>
            </div>
        </div>

        {{-- Input Resep --}}
        <a href="{{ route('resep.index') }}"
        class="flex items-center px-4 py-2 space-x-2 rounded
                {{ request()->routeIs('resep.index') ? 'bg-white text-primary font-semibold' : 'hover:text-primary-dark' }}">
            <i class="fas fa-file-medical text-xl"></i>
            <span class="sidebar-label">Input Resep</span>
        </a>
    </nav>

</aside>
