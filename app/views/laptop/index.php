<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Laptop - Meine Laptop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
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
                <a href="<?= BASEURL; ?>/login/logout" class="bg-gray-100 text-gray-900 px-5 py-2.5 rounded-full font-bold text-xs hover:bg-red-50 hover:text-red-600 transition">
                    Log Out
                </a>
            </div>
        </div>
    </nav>
    <div class="container mx-auto px-4 py-10 max-w-7xl mt-20"> <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-black tracking-tight">Manage Laptop</h1>
                <p class="text-gray-500 mt-1 text-sm">Kelola inventaris unit laptop rental.</p>
            </div>
            <a href="<?= BASEURL; ?>/laptop/tambah" 
               class="bg-black hover:bg-gray-800 text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center gap-2 text-sm">
                <i class="fa-solid fa-plus"></i> Tambah Unit
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 overflow-hidden border border-gray-100">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-xs uppercase tracking-wider text-gray-500 font-bold">
                        <th class="p-6">Unit Info</th>
                        <th class="p-6">Kode</th>
                        <th class="p-6">Harga/Hari</th>
                        <th class="p-6 text-center">Status</th>
                        <th class="p-6 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php if(!empty($data['laptops']) && is_array($data['laptops'])): ?>
                        <?php foreach($data['laptops'] as $laptop): ?>
                        <tr class="group hover:bg-gray-50 transition-colors duration-200">
                            <td class="p-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center text-gray-400">
                                        <i class="fa-solid fa-laptop text-xl"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900 text-base"><?= $laptop['brand']; ?></div>
                                        <div class="text-sm text-gray-500"><?= $laptop['model']; ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-6">
                                <span class="bg-gray-100 text-gray-600 py-1 px-3 rounded-lg text-xs font-mono font-bold">
                                    <?= $laptop['kode_laptop']; ?>
                                </span>
                            </td>
                            <td class="p-6 font-semibold text-gray-700">
                                Rp <?= number_format($laptop['harga_sewa'], 0, ',', '.'); ?>
                            </td>
                            <td class="p-6 text-center">
                                <?php 
                                    $statusClass = ($laptop['status'] == 'available') ? 'bg-green-100 text-green-700' : 
                                                  (($laptop['status'] == 'disewa') ? 'bg-blue-100 text-blue-700' : 'bg-red-100 text-red-700');
                                ?>
                                <span class="<?= $statusClass; ?> py-1.5 px-4 rounded-full text-xs font-bold capitalize">
                                    <?= $laptop['status']; ?>
                                </span>
                            </td>
                            <td class="p-6">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="<?= BASEURL; ?>/laptop/edit/<?= $laptop['id_laptop']; ?>" 
                                       class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 text-gray-600 hover:bg-black hover:text-white transition-all shadow-sm">
                                        <i class="fa-solid fa-pen text-xs"></i>
                                    </a>
                                    <a href="<?= BASEURL; ?>/laptop/hapus/<?= $laptop['id_laptop']; ?>" 
                                       onclick="return confirm('Yakin ingin menghapus?')"
                                       class="w-8 h-8 flex items-center justify-center rounded-full bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all shadow-sm">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-400">Belum ada data laptop.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>