<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Laptop - Meine Laptop</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out;
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

        .table-row-hover:hover {
            background-color: #f9fafb;
            transform: scale-[1.01];
            transition: all 0.2s ease;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800 antialiased">

    <nav class="bg-white border-b border-gray-200 fixed w-full z-30 top-0">
        <div class="px-6 py-4 lg:px-12 flex justify-between items-center">
            <a href="<?= BASEURL; ?>/dashboard" class="text-xl font-extrabold tracking-tight text-black flex items-center gap-2">
                <i class="fa-solid fa-laptop-code"></i> Meine Laptop
            </a>
            <div class="hidden md:flex items-center gap-8 text-sm font-semibold text-gray-500">
                <a href="<?= BASEURL; ?>/dashboard" class="hover:text-black transition">Dashboard</a>
                <a href="<?= BASEURL; ?>/laptop" class="text-black border-b-2 border-black pb-1">Laptop</a>
                <a href="<?= BASEURL; ?>/penyewa" class="hover:text-black transition">Penyewa</a>
                <a href="<?= BASEURL; ?>/transaksi" class="hover:text-black transition">Transaksi</a>
            </div>
            <div>
                <a href="<?= BASEURL; ?>/login/logout" class="bg-gray-100 text-gray-900 px-5 py-2.5 rounded-full font-bold text-xs hover:bg-red-50 hover:text-red-600 transition">Log Out</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-10 max-w-7xl mt-20 animate-fade-in-up">

        <div class="flex flex-col md:flex-row justify-between items-center mb-8">
            <div class="mb-4 md:mb-0">
                <h1 class="text-3xl font-extrabold text-black tracking-tight">Daftar Laptop</h1>
                <p class="text-gray-500 mt-2 text-sm">Manage all laptops in one place.</p>
            </div>

            <a href="<?= BASEURL; ?>/laptop/tambah"
                class="group relative inline-flex items-center justify-center px-6 py-3 text-sm font-bold text-white transition-all duration-300 bg-black rounded-xl hover:bg-gray-800 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                <i class="fa-solid fa-plus mr-2 transition-transform group-hover:rotate-90"></i>
                Tambah Unit
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-200" style="animation-delay: 0.2s;">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase tracking-wider text-gray-500 font-bold">
                        <th class="px-6 py-5">Kode</th>
                        <th class="px-6 py-5">Brand & Model</th>
                        <th class="px-6 py-5">Harga Sewa</th>
                        <th class="px-6 py-5 text-center">Status</th>
                        <th class="px-6 py-5 text-center">Detail</th>
                        <th class="px-6 py-5 text-center">Aksi</th>
                    </tr>
                </thead>

                <?php if (!empty($data['laptops'])): ?>
                    <?php foreach ($data['laptops'] as $laptop): ?>
                        <tbody x-data="{ open: false }" class="border-b border-gray-100 group hover:bg-gray-50/50 transition-colors duration-150">
                            <tr class="table-row-hover bg-white transition-colors duration-200">
                                <td class="px-6 py-5 align-middle">
                                    <span class="inline-block bg-white text-gray-600 text-xs px-2 py-1 rounded border border-gray-300 font-mono font-bold shadow-sm">
                                        <?= $laptop['kode_laptop']; ?>
                                    </span>
                                </td>

                                <td class="px-6 py-5 align-middle">
                                    <div class="flex flex-col">
                                        <span class="text-black font-bold text-base"><?= $laptop['brand']; ?></span>
                                        <span class="text-gray-500 text-sm"><?= $laptop['model']; ?></span>
                                    </div>
                                </td>

                                <td class="px-6 py-5 align-middle">
                                    <span class="text-black font-extrabold text-sm">Rp <?= number_format($laptop['harga_sewa'], 0, ',', '.'); ?></span>
                                    <span class="text-gray-400 text-xs font-medium">/bulan</span>
                                </td>

                                <td class="px-6 py-5 align-middle text-center">
                                    <?php
                                    $status = $laptop['status'];
                                    $statusStyle = match ($status) {
                                        'available' => 'bg-white text-black border border-gray-300 shadow-sm',
                                        'disewa' => 'bg-black text-white border border-black shadow-md',
                                        'tidak disewakan' => 'bg-gray-100 text-gray-400 border border-gray-200',
                                        default => 'bg-gray-100 text-gray-600'
                                    };
                                    $dot = ($status == 'available') ? '<span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse mr-2"></span>' : '';
                                    ?>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold <?= $statusStyle; ?>">
                                        <?= $dot; ?> <?= ucfirst($status); ?>
                                    </span>
                                </td>

                                <td class="px-6 py-5 align-middle text-center">
                                    <button @click="open = !open"
                                        class="group inline-flex items-center justify-center px-3 py-1.5 rounded-full border border-gray-200 hover:border-black bg-white hover:bg-gray-50 transition-all duration-300 focus:outline-none shadow-sm">
                                        <span class="text-xs font-semibold text-gray-500 group-hover:text-black mr-2 transition-colors duration-300"
                                            x-text="open ? 'Tutup' : 'Lihat'"></span>
                                        <i class="fa-solid fa-chevron-down text-xs text-gray-400 group-hover:text-black transition-transform duration-500"
                                            :class="{'rotate-180': open}"></i>
                                    </button>
                                </td>

                                <td class="px-6 py-5 align-middle text-center">
                                    <div class="flex justify-center items-center space-x-3">
                                        <?php if ($laptop['status'] == 'disewa'): ?>
                                            <button type="button" class="text-gray-300 cursor-not-allowed" title="Sedang disewa">
                                                <i class="fa-solid fa-pen-to-square text-lg"></i>
                                            </button>
                                        <?php else: ?>
                                            <a href="<?= BASEURL; ?>/laptop/edit/<?= $laptop['id_laptop']; ?>" class="text-gray-400 hover:text-black hover:scale-110 transition-transform duration-200">
                                                <i class="fa-solid fa-pen-to-square text-lg"></i>
                                            </a>
                                        <?php endif; ?>

                                        <a href="<?= BASEURL; ?>/laptop/hapus/<?= $laptop['id_laptop']; ?>"
                                            onclick="return confirm('Hapus data ini?');"
                                            class="text-gray-400 hover:text-red-600 hover:scale-110 transition-transform duration-200">
                                            <i class="fa-solid fa-trash-can text-lg"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <tr x-show="open" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" class="bg-gray-50 shadow-inner">
                                <td colspan="6" class="p-6">
                                    <div class="flex items-start gap-6 pl-4">
                                        <div class="w-12 h-12 rounded-xl bg-black flex items-center justify-center text-white shadow-lg">
                                            <i class="fa-solid fa-microchip text-xl"></i>
                                        </div>
                                        <div class="flex-grow">
                                            <h4 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Spesifikasi Teknis</h4>
                                            <p class="text-gray-800 text-sm leading-relaxed bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                                <?= $laptop['spesifikasi']; ?>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tbody>
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center text-gray-400 bg-white">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fa-regular fa-folder-open text-4xl mb-3 text-gray-200"></i>
                                    <p class="font-medium text-gray-500">Belum ada data laptop.</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                <?php endif; ?>
            </table>
        </div>

        <div class="mt-8 text-center text-xs text-gray-400">
            &copy; <?= date('Y'); ?> Meine Laptop System.
        </div>
    </div>
</body>

</html>