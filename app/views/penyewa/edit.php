<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Penyewa - Meine Laptop</title>
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
                <a href="<?= BASEURL; ?>/penyewa" class="text-black border-b-2 border-black pb-1">Penyewa</a>
                <a href="<?= BASEURL; ?>/transaksi" class="hover:text-black transition">Transaksi</a>
            </div>
            <div>
                <a href="<?= BASEURL; ?>/login/logout" class="bg-gray-100 text-gray-900 px-5 py-2.5 rounded-full font-bold text-xs hover:bg-red-50 hover:text-red-600 transition">Log Out</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-10 max-w-3xl mt-20">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-black tracking-tight">Edit Penyewa</h1>
                <p class="text-gray-500 mt-1 text-sm">Update informasi pelanggan.</p>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
            <form action="<?= BASEURL; ?>/penyewa/update/<?= $data['penyewa']['id_penyewa']; ?>" method="POST">
                <div class="grid grid-cols-1 gap-6">
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="nama" value="<?= $data['penyewa']['nama']; ?>" required 
                               class="w-full border border-gray-200 rounded-xl py-3 px-4 focus:ring-2 focus:ring-black focus:outline-none bg-gray-50 focus:bg-white transition-all">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Telepon</label>
                            <input type="number" name="telp" value="<?= $data['penyewa']['telp']; ?>" required 
                                   class="w-full border border-gray-200 rounded-xl py-3 px-4 bg-gray-50 focus:bg-white focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" value="<?= $data['penyewa']['email']; ?>" required 
                                   class="w-full border border-gray-200 rounded-xl py-3 px-4 bg-gray-50 focus:bg-white focus:outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Domisili</label>
                        <textarea name="alamat" rows="3" required 
                                  class="w-full border border-gray-200 rounded-xl py-3 px-4 bg-gray-50 focus:bg-white focus:outline-none"><?= $data['penyewa']['alamat']; ?></textarea>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100 mt-8">
                        <a href="<?= BASEURL; ?>/penyewa" class="px-6 py-3 rounded-xl text-gray-600 hover:bg-gray-100 font-semibold text-sm">Cancel</a>
                        <button type="submit" class="bg-black hover:bg-gray-800 text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all text-sm">
                            <i class="fa-solid fa-floppy-disk"></i> Save Changes
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</body>
</html>