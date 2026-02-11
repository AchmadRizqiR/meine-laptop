<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Laptop - Meine Laptop</title>
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
                <a href="<?= BASEURL; ?>/home" class="bg-gray-100 text-gray-900 px-5 py-2.5 rounded-full font-bold text-xs hover:bg-red-50 hover:text-red-600 transition">
                    keluar
                </a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-10 max-w-4xl mt-20">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-black tracking-tight">Edit Laptop</h1>
                <p class="text-gray-500 mt-1 text-sm">Perbarui informasi unit laptop.</p>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
            <form action="<?= BASEURL; ?>/laptop/update/<?= $data['laptop']['id_laptop']; ?>" method="POST">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Kode Laptop</label>
                        <input type="text" name="kode_laptop" value="<?= $data['laptop']['kode_laptop']; ?>" required 
                               class="w-full border border-gray-200 rounded-xl py-3 px-4 bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-black transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Brand</label>
                        <input type="text" name="brand" value="<?= $data['laptop']['brand']; ?>" required
                               class="w-full border border-gray-200 rounded-xl py-3 px-4 bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-black transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Model</label>
                        <input type="text" name="model" value="<?= $data['laptop']['model']; ?>" required 
                               class="w-full border border-gray-200 rounded-xl py-3 px-4 bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-black transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Harga Sewa (Rp)</label>
                        <input type="number" name="harga_sewa" value="<?= $data['laptop']['harga_sewa']; ?>" required 
                               class="w-full border border-gray-200 rounded-xl py-3 px-4 bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-black transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Status</label>
                        <select name="status" class="w-full border border-gray-200 rounded-xl py-3 px-4 bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-black transition-all">
                            <option value="available" <?= ($data['laptop']['status'] == 'available') ? 'selected' : ''; ?>>Available</option>
                            <option value="disewa" <?= ($data['laptop']['status'] == 'disewa') ? 'selected' : ''; ?>>Disewa</option>
                            <option value="tidak disewakan" <?= ($data['laptop']['status'] == 'tidak disewakan') ? 'selected' : ''; ?>>Maintenance</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Spesifikasi</label>
                        <textarea name="spesifikasi" rows="4" required class="w-full border border-gray-200 rounded-xl py-3 px-4 bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-black transition-all"><?= $data['laptop']['spesifikasi']; ?></textarea>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-6 mt-8 border-t border-gray-100">
                    <a href="<?= BASEURL; ?>/laptop" class="px-6 py-3 rounded-xl text-gray-600 hover:bg-gray-100 font-semibold text-sm transition">Cancel</a>
                    <button type="submit" class="bg-black hover:bg-gray-800 text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all text-sm flex items-center gap-2">
                        <i class="fa-solid fa-floppy-disk"></i> Update Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
    </body>
</html>