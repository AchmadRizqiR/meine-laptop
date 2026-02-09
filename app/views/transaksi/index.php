<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penyewaan - Meine Laptop</title>

    <script src="https://cdn.tailwindcss.com"></script>
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
                <a href="<?= BASEURL; ?>/laptop" class="hover:text-black transition">Laptop</a>
                <a href="<?= BASEURL; ?>/penyewa" class="hover:text-black transition">Penyewa</a>
                <a href="<?= BASEURL; ?>/transaksi" class="text-black border-b-2 border-black pb-1">Transaksi</a>
            </div>
            <div>
                <a href="<?= BASEURL; ?>/login/logout" class="bg-gray-100 text-gray-900 px-5 py-2.5 rounded-full font-bold text-xs hover:bg-red-50 hover:text-red-600 transition">Log Out</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-10 max-w-7xl mt-20 animate-fade-in-up">

        <div class="flex flex-col md:flex-row justify-between items-center mb-8">
            <div class="mb-4 md:mb-0">
                <h1 class="text-3xl font-extrabold text-black flex items-center gap-3 tracking-tight">
                    Rental Dashboard
                </h1>
                <p class="text-gray-500 text-sm mt-2 ml-1">Manage all transactions in one place.</p>
            </div>

            <div class="flex flex-row space-x-4">
                <button onclick="toggleModal('exportModal')" class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl font-bold text-sm flex items-center gap-2 shadow-md transition-all">
                    <i class="fa-solid fa-file-excel"></i> Export Laporan
                </button>

                <a href="<?= BASEURL; ?>/transaksi/tambah" class="group bg-black text-white px-6 py-3 rounded-xl shadow-lg hover:bg-gray-800 transition-all duration-300 transform hover:-translate-y-0.5 flex items-center gap-2 font-medium text-sm">
                    <i class="fa-solid fa-plus transition-transform group-hover:rotate-90"></i>
                    <span>Sewa Baru</span>
                </a>
            </div>
        </div>

        <div class="bg-white shadow-xl rounded-3xl overflow-hidden border border-gray-200 " style="animation-delay: 0.2s;">
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-gray-500 uppercase text-xs font-bold tracking-wider">
                            <th class="px-6 py-5 text-left">Kode</th>
                            <th class="px-6 py-5 text-left">Penyewa & Unit</th>
                            <th class="px-6 py-5 text-center">Jadwal & Status</th>
                            <th class="px-6 py-5 text-right">Tagihan</th>
                            <th class="px-6 py-5 text-right">Denda</th>
                            <th class="px-6 py-5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm divide-y divide-gray-100">
                        <?php if (!empty($data['transaksi'])): ?>
                            <?php foreach ($data['transaksi'] as $sewa): ?>
                                <?php
                                $isSelesai = ($sewa['status'] == 'selesai');
                                ?>
                                <tr class="table-row-hover bg-white transition-colors duration-200 group">

                                    <td class="px-6 py-5 align-middle">
                                        <span class="font-mono font-bold text-xs text-gray-600 border border-gray-300 px-2 py-1 rounded">
                                            <?= $sewa['kode_sewa']; ?>
                                        </span>
                                    </td>

                                    <td class="px-6 py-5 align-middle">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-black text-base"><?= $sewa['nama']; ?></span>
                                            <span class="text-xs text-gray-400 mb-1"><?= $sewa['telp']; ?></span>

                                            <div class="inline-flex items-center gap-1 mt-1">
                                                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-md text-xs font-medium border border-gray-200">
                                                    <?= $sewa['brand']; ?> <?= $sewa['model']; ?>
                                                </span>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-5 text-center align-middle">
                                        <div class="flex flex-col items-center gap-1">
                                            <div class="text-xs text-gray-500">
                                                <?= date('d M', strtotime($sewa['tgl_mulai'])); ?>
                                                <span class="text-gray-300 mx-1">&rarr;</span>
                                                <?= date('d M', strtotime($sewa['tgl_selesai'])); ?>
                                            </div>

                                            <div class="mt-2">
                                                <?php if (!$isSelesai): ?>
                                                    <span class="inline-flex items-center gap-2 px-3 py-1 font-bold text-gray-800 bg-white border border-gray-300 rounded-full text-xs shadow-sm">
                                                        <span class="w-2 h-2 rounded-full bg-black animate-pulse"></span>
                                                        Sedang Sewa
                                                    </span>
                                                <?php else: ?>
                                                    <span class="inline-flex items-center gap-1 px-3 py-1 font-bold text-white bg-black rounded-full text-xs">
                                                        <i class="fa-solid fa-check"></i> Selesai
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-5 text-right align-middle">
                                        <?php if ($sewa['harga']): ?>
                                            <span class="font-bold text-black text-sm">
                                                Rp <?= number_format($sewa['harga'], 0, ',', '.'); ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="text-gray-400 text-xs">-</span>
                                        <?php endif; ?>
                                    </td>

                                    <td class="px-6 py-5 text-right align-middle">
                                        <?php if ($isSelesai): ?>
                                            <?php if ($sewa['denda'] > 0): ?>
                                                <span class="font-bold text-gray-900 border-b-2 border-gray-900 pb-0.5">
                                                    Rp <?= number_format($sewa['denda'], 0, ',', '.'); ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="text-gray-400 text-xs font-medium">Aman</span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <span class="text-gray-300">-</span>
                                        <?php endif; ?>
                                    </td>

                                    <td class="px-6 py-5 text-center align-middle">
                                        <?php if (!$isSelesai): ?>
                                            <a href="<?= BASEURL; ?>/transaksi/selesai/<?= $sewa['id_sewa']; ?>"
                                                onclick="return confirm('Konfirmasi pengembalian laptop? Total harga & denda akan dihitung otomatis.')"
                                                class="bg-black hover:bg-gray-800 text-white text-xs font-bold py-2 px-4 rounded-lg shadow-md transition-all transform hover:-translate-y-0.5 flex items-center gap-2 mx-auto w-fit">
                                                <i class="fa-solid fa-rotate-left"></i> Return
                                            </a>
                                        <?php else: ?>
                                            <span class="text-gray-400 text-xs font-medium flex justify-center items-center gap-1">
                                                <i class="fa-solid fa-check-circle"></i> Closed
                                            </span>
                                        <?php endif; ?>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center text-gray-400 bg-white">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="fa-regular fa-folder-open text-4xl mb-3 text-gray-200"></i>
                                        <p class="font-medium">Belum ada data penyewaan.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 text-center text-xs text-gray-400">
            &copy; <?= date('Y'); ?> Meine Laptop System.
        </div>
    </div>

    <div id="exportModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="toggleModal('exportModal')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                <form action="<?= BASEURL; ?>/transaksi/export" method="POST">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                <i class="fa-solid fa-file-excel text-green-600"></i>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Export Laporan Transaksi</h3>
                                <div class="mt-4 grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">Dari Tanggal</label>
                                        <input type="date" name="start_date" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-black">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">Sampai Tanggal</label>
                                        <input type="date" name="end_date" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-black">
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">*Semua transaksi pada rentang tanggal ini akan diunduh.</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                        <button type="submit" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                            Download .CSV
                        </button>
                        <button type="button" onclick="toggleModal('exportModal')" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleModal(modalID) {
            document.getElementById(modalID).classList.toggle("hidden");
        }
    </script>
</body>

</html>