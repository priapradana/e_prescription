e-Prescription Sipatex adalah aplikasi manajemen resep apotek berbasis Laravel yang dirancang untuk menangani input resep racikan dan non-racikan, pengelolaan data obat, signa, serta pencetakan resep dalam format PDF.

🚀 Requirement Environment

📦 Laravel 11+
💊 PHP 8.1+
📃 MySQL/MariaDB

🛠️ Instalasi
1. Clone repository:
    <pre class="bg-gray-100 rounded-lg p-4 text-sm border border-gray-300 overflow-x-auto">
        <code class="text-gray-800 font-mono">
            git clone https://github.com/username/e-prescription.git
            cd e-prescription
        </code>
    </pre>
    
2. Generate app key:
    <pre class="bg-gray-100 rounded-lg p-4 text-sm border border-gray-300 overflow-x-auto">
        <code class="text-gray-800 font-mono">
            php artisan key:generate
        </code>
    </pre>
    
3. Akses PHPMyAdmin dan Buat database
    <pre class="bg-gray-100 rounded-lg p-4 text-sm border border-gray-300 overflow-x-auto">
        <code class="text-gray-800 font-mono">
            CREATE DATABASE eprescription CHARACTER SET latin1 COLLATE latin1_swedish_ci;
        </code>
    </pre>
    
4. Import Data SQL
Buka folder sql >> Import sql ke database yang sebelumnya dibuat dan import obtalkes_m terlebih dulu, baru selanjutnya signa_m baru terakhir users

5. Jalankan Migrasi
   <pre class="bg-gray-100 rounded-lg p-4 text-sm border border-gray-300 overflow-x-auto">
        <code class="text-gray-800 font-mono">
            php artisan migrate
        </code>
    </pre>
    
6. Akses login di file akses_login.txt yang berada di luar (ini wajib users.sql di import ke database terlebih dulu).

7. Terima Kasih
