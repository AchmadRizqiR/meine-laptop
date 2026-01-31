<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi - Meine Laptop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
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

    <div class="container mx-auto px-4 py-10 max-w-7xl mt-20">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-black tracking-tight">Riwayat Transaksi</h1>
                <p class="text-gray-500 mt-1 text-sm">Monitoring penyewaan unit laptop.</p>
            </div>
            <a href="<?= BASEURL; ?>/transaksi/tambah" 
               class="bg-black hover:bg-gray-800 text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center gap-2 text-sm">
                <i class="fa-solid fa-cart-plus"></i> Sewa Baru
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 overflow-hidden border border-gray-100">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-xs uppercase tracking-wider text-gray-500 font-bold">
                        <th class="p-6">Penyewa</th>
                        <th class="p-6">Unit Laptop</th>
                        <th class="p-6">Tanggal Sewa</th>
                        <th class="p-6 text-center">Status</th>
                        <th class="p-6 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php if(!empty($data['transaksi']) && is_array($data['transaksi'])): ?>
                        <?php foreach($data['transaksi'] as $sewa): ?>
                        <tr class="group hover:bg-gray-50 transition-colors duration-200">
                            <td class="p-6">
                                <div class="font-bold text-gray-900"><?= $sewa['penyewa']['nama'] ?? 'Unknown'; ?></div>
                                <div class="text-xs text-gray-500"><?= $sewa['penyewa']['telp'] ?? '-'; ?></div>
                            </td>
                            <td class="p-6">
                                <span class="bg-gray-100 text-gray-800 py-1 px-2 rounded text-xs font-bold font-mono">
                                    <?= $sewa['laptop']['kode_laptop'] ?? '?'; ?>
                                </span>
                                <div class="text-sm text-gray-600 mt-1">
                                    <?= $sewa['laptop']['brand'] ?? ''; ?> <?= $sewa['laptop']['model'] ?? ''; ?>
                                </div>
                            </td>
                            <td class="p-6">
                                <div class="flex flex-col text-sm">
                                    <span class="text-gray-500 text-xs">Mulai:</span>
                                    <span class="font-semibold"><?= date('d M Y', strtotime($sewa['tgl_mulai'])); ?></span>
                                    <span class="text-gray-500 text-xs mt-1">Selesai:</span>
                                    <span class="font-semibold"><?= date('d M Y', strtotime($sewa['tgl_selesai'])); ?></span>
                                </div>
                            </td>
                            <td class="p-6 text-center">
                                <?php 
                                    $isSelesai = ($sewa['status'] == 'selesai' || $sewa['tgl_dikembalikan'] != null);
                                    $statusClass = $isSelesai ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700';
                                    $statusText = $isSelesai ? 'Selesai' : 'Sedang Disewa';
                                ?>
                                <span class="<?= $statusClass; ?> py-1.5 px-4 rounded-full text-xs font-bold uppercase tracking-wider">
                                    <?= $statusText; ?>
                                </span>
                            </td>
                            <td class="p-6 text-center">
                                <?php if(!$isSelesai): ?>
                                    <a href="<?= BASEURL; ?>/transaksi/selesai/<?= $sewa['id_sewa']; ?>" 
                                       onclick="return confirm('Laptop sudah dikembalikan dan kondisi baik?')"
                                       class="inline-block bg-white border border-gray-300 hover:bg-black hover:text-white hover:border-black text-gray-700 font-bold py-2 px-4 rounded-lg text-xs transition-all shadow-sm">
                                        <i class="fa-solid fa-rotate-left mr-1"></i> Return
                                    </a>
                                <?php else: ?>
                                    <span class="text-gray-400 text-xs italic"><i class="fa-solid fa-check"></i> Done</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-400">Belum ada data transaksi.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>