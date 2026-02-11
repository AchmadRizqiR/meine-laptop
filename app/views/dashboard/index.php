<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Meine Laptop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stat-card:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 antialiased">

    <nav class="bg-white border-b border-gray-200 fixed w-full z-30 top-0">
        <div class="px-6 py-4 lg:px-12 flex justify-between items-center">
            <a href="<?= BASEURL; ?>/dashboard" class="text-xl font-extrabold tracking-tight text-black flex items-center gap-2">
                <i class="fa-solid fa-laptop-code"></i> Meine Laptop
            </a>
            <div class="hidden md:flex items-center gap-8 text-sm font-semibold text-gray-500">
                <a href="<?= BASEURL; ?>/dashboard" class="text-black border-b-2 border-black pb-1">Dashboard</a>
                <a href="<?= BASEURL; ?>/laptop" class="hover:text-black transition">Laptop</a>
                <a href="<?= BASEURL; ?>/penyewa" class="hover:text-black transition">Penyewa</a>
                <a href="<?= BASEURL; ?>/transaksi" class="hover:text-black transition">Transaksi</a>
            </div>
            <a href="<?= BASEURL; ?>/home" class="bg-gray-100 text-gray-900 px-5 py-2.5 rounded-full font-bold text-xs hover:bg-red-50 hover:text-red-600 transition">keluar</a>
        </div>
    </nav>

    <div class="container mx-auto px-6 py-10 max-w-7xl mt-20 animate-fade-in-up">
        <div class="mb-10">
            <h1 class="text-3xl font-extrabold text-black tracking-tight">Selamat Datang, Admin!</h1>
            <p class="text-gray-500 mt-2">Berikut adalah ringkasan operasional rental hari ini.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="stat-card bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center gap-5">
                <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-2xl">
                    <i class="fa-solid fa-laptop"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Unit</p>
                    <h3 class="text-2xl font-black text-black"><?= $data['total_laptop']; ?></h3>
                </div>
            </div>

            <div class="stat-card bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center gap-5">
                <div class="w-14 h-14 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center text-2xl">
                    <i class="fa-solid fa-check-circle"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Tersedia</p>
                    <h3 class="text-2xl font-black text-black"><?= $data['tersedia']; ?></h3>
                </div>
            </div>

            <div class="stat-card bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center gap-5">
                <div class="w-14 h-14 bg-black text-white rounded-2xl flex items-center justify-center text-2xl shadow-lg shadow-gray-200">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Active Rent</p>
                    <h3 class="text-2xl font-black text-black"><?= $data['transaksi_aktif']; ?></h3>
                </div>
            </div>

            <div class="stat-card bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center gap-5">
                <div class="w-14 h-14 bg-yellow-50 text-yellow-600 rounded-2xl flex items-center justify-center text-2xl">
                    <i class="fa-solid fa-wallet"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Revenue</p>
                    <h3 class="text-2xl font-black text-black">Rp <?= number_format($data['total_pendapatan'] / 1000000, 1); ?>Jt</h3>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-black p-8 rounded-3xl shadow-2xl text-white relative overflow-hidden group">
                    <i class="fa-solid fa-plus absolute -right-4 -bottom-4 text-8xl opacity-10 group-hover:scale-110 transition-transform"></i>
                    <h4 class="text-xl font-bold mb-2">Butuh Sewa Cepat?</h4>
                    <p class="text-gray-400 text-sm mb-6">Input transaksi baru langsung tanpa ribet.</p>
                    <a href="<?= BASEURL; ?>/transaksi/tambah" class="inline-block bg-white text-black font-bold py-3 px-6 rounded-xl text-sm hover:bg-gray-100 transition shadow-lg">
                        Buat Transaksi
                    </a>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                    <h4 class="font-bold text-black mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-lightbulb text-yellow-500"></i> Tips Admin
                    </h4>
                    <ul class="text-sm text-gray-500 space-y-3">
                        <li class="flex items-start gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-black mt-1.5"></span>
                            Cek denda secara berkala pada kolom transaksi.
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-black mt-1.5"></span>
                            Pastikan status laptop diupdate setelah maintenance.
                        </li>
                    </ul>
                </div>
            </div>

            <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                <div class="flex justify-between items-center mb-6">
                    <h4 class="text-xl font-bold text-black tracking-tight">Status Inventaris</h4>
                    <a href="<?= BASEURL; ?>/laptop" class="text-sm font-bold text-gray-400 hover:text-black transition">Lihat Semua &rarr;</a>
                </div>

                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-xs font-bold mb-2">
                            <span class="text-gray-400 uppercase">Utilisasi Laptop</span>
                            <span class="text-black"><?= round(($data['transaksi_aktif'] / $data['total_laptop']) * 100); ?>%</span>
                        </div>
                        <div class="w-full bg-gray-100 h-3 rounded-full overflow-hidden">
                            <div class="bg-blue-500 h-full rounded-full" style="width: <?= ($data['transaksi_aktif'] / $data['total_laptop']) * 100; ?>%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>