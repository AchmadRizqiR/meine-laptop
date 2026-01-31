<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa Baru - Meine Laptop</title>
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

    <div class="container mx-auto px-4 py-10 max-w-3xl mt-20">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-black tracking-tight">Transaksi Baru</h1>
                <p class="text-gray-500 mt-1 text-sm">Input data penyewaan unit laptop.</p>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
            <form action="<?= BASEURL; ?>/transaksi/simpan" method="POST">
                <div class="grid grid-cols-1 gap-6">
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Penyewa</label>
                        <select name="id_penyewa" required class="w-full border border-gray-200 rounded-xl py-3 px-4 bg-gray-50 focus:bg-white focus:outline-none">
                            <option value="">-- Cari Nama Penyewa --</option>
                            <?php foreach($data['penyewas'] as $p): ?>
                                <option value="<?= $p['id_penyewa']; ?>"><?= $p['nama']; ?> (<?= $p['telp']; ?>)</option>
                            <?php endforeach; ?>
                        </select>
                        <p class="text-xs text-gray-400 mt-1">*Jika nama belum ada, tambahkan di menu Penyewa dulu.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Unit Laptop</label>
                        <select name="id_laptop" id="laptopSelect" required onchange="hitungTotal()" 
                                class="w-full border border-gray-200 rounded-xl py-3 px-4 bg-gray-50 focus:bg-white focus:outline-none">
                            <option value="" data-price="0">-- Pilih Laptop Available --</option>
                            <?php foreach($data['laptops'] as $l): ?>
                                <option value="<?= $l['id_laptop']; ?>" data-price="<?= $l['harga_sewa']; ?>">
                                    <?= $l['brand']; ?> <?= $l['model']; ?> - Rp <?= number_format($l['harga_sewa']); ?>/hari
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Mulai</label>
                            <input type="date" name="tgl_mulai" id="tglMulai" required onchange="hitungTotal()"
                                   class="w-full border border-gray-200 rounded-xl py-3 px-4 bg-gray-50 focus:bg-white focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Selesai</label>
                            <input type="date" name="tgl_selesai" id="tglSelesai" required onchange="hitungTotal()"
                                   class="w-full border border-gray-200 rounded-xl py-3 px-4 bg-gray-50 focus:bg-white focus:outline-none">
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-6 flex justify-between items-center border border-gray-100">
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase tracking-wide">Estimasi Total</p>
                            <p class="text-xs text-gray-400" id="infoDurasi">0 Hari</p>
                        </div>
                        <div class="text-2xl font-extrabold text-black" id="displayHarga">Rp 0</div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100 mt-4">
                        <a href="<?= BASEURL; ?>/transaksi" class="px-6 py-3 rounded-xl text-gray-600 hover:bg-gray-100 font-semibold text-sm">Cancel</a>
                        <button type="submit" class="bg-black hover:bg-gray-800 text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all text-sm">
                            <i class="fa-solid fa-paper-plane"></i> Process Transaction
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <script>
        function hitungTotal() {
            const laptopSelect = document.getElementById('laptopSelect');
            const pricePerDay = laptopSelect.options[laptopSelect.selectedIndex].getAttribute('data-price') || 0;
            
            const start = document.getElementById('tglMulai').value;
            const end = document.getElementById('tglSelesai').value;

            if(start && end && pricePerDay > 0) {
                const date1 = new Date(start);
                const date2 = new Date(end);
                
                // Hitung selisih waktu
                const diffTime = Math.abs(date2 - date1);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
                
                // Minimal 1 hari kalau tanggal sama
                const days = diffDays === 0 ? 1 : diffDays;

                const total = days * pricePerDay;

                document.getElementById('infoDurasi').innerText = days + " Hari";
                document.getElementById('displayHarga').innerText = "Rp " + new Intl.NumberFormat('id-ID').format(total);
            } else {
                document.getElementById('infoDurasi').innerText = "0 Hari";
                document.getElementById('displayHarga').innerText = "Rp 0";
            }
        }
    </script>
</body>
</html>