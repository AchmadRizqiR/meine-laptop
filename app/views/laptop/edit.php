<div class="container mx-auto px-4 py-10 max-w-4xl">
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
                           class="w-full border border-gray-200 rounded-xl py-3 px-4 bg-gray-50 focus:bg-white focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Brand</label>
                    <input type="text" name="brand" value="<?= $data['laptop']['brand']; ?>" required
                           class="w-full border border-gray-200 rounded-xl py-3 px-4 bg-gray-50 focus:bg-white focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Model</label>
                    <input type="text" name="model" value="<?= $data['laptop']['model']; ?>" required 
                           class="w-full border border-gray-200 rounded-xl py-3 px-4 bg-gray-50 focus:bg-white focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Harga Sewa</label>
                    <input type="number" name="harga_sewa" value="<?= $data['laptop']['harga_sewa']; ?>" required 
                           class="w-full border border-gray-200 rounded-xl py-3 px-4 bg-gray-50 focus:bg-white focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full border border-gray-200 rounded-xl py-3 px-4 bg-gray-50 focus:bg-white focus:outline-none">
                        <option value="available" <?= ($data['laptop']['status'] == 'available') ? 'selected' : ''; ?>>Available</option>
                        <option value="disewa" <?= ($data['laptop']['status'] == 'disewa') ? 'selected' : ''; ?>>Disewa</option>
                        <option value="tidak disewakan" <?= ($data['laptop']['status'] == 'tidak disewakan') ? 'selected' : ''; ?>>Maintenance</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Spesifikasi</label>
                    <textarea name="spesifikasi" rows="4" required class="w-full border border-gray-200 rounded-xl py-3 px-4 bg-gray-50 focus:bg-white focus:outline-none"><?= $data['laptop']['spesifikasi']; ?></textarea>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-6 mt-8 border-t border-gray-100">
                <a href="<?= BASEURL; ?>/laptop" class="px-6 py-3 rounded-xl text-gray-600 hover:bg-gray-100 font-semibold text-sm">Cancel</a>
                <button type="submit" class="bg-black hover:bg-gray-800 text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all text-sm">
                    <i class="fa-solid fa-floppy-disk"></i> Update Changes
                </button>
            </div>
        </form>
    </div>
</div>