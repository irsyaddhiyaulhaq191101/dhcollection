<div>
    <input type="text" wire:model="message">
    <p>{{ $message }}</p>
    {{-- <div class="mb-3">
        <label for="barang_id" class="form-label">Pilih Barang</label>
        <div class="input-group">
            <span class="input-group-text">Category</span>
            <select wire:model="category" class="form-select form-select-sm fs-6 py-0" name="category">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @if (count($barangs) > 0)
        <div class='row align-items-center mb-3' id='baris"+ input +"'>
            <div class='col-md-10'>
                <div class='input-group'> <span class='input-group-text'>Nama Barang</span>
                    <select name='barang_id[]' id='barang' wire:model="barang">
                        @foreach ($barangs as $barang)
                            <option value='{{ $barang->id }}'>{{ $barang->nama }}</option>
                        @endforeach
                    </select>
                    <span class='input-group-text'>Jml</span>
                    <input type='text' class='form-control' name='jml[]' onkeyup='format()' id='jml'
                        value='{{ old('jml') }}' required> <span class='input-group-text'>Harga</span>
                    <input type='text' class='form-control' name='harga[]' onkeyup='format()' id='harga'
                        value='{{ old('harga') }}' required>
                </div>
            </div>
            <div class='col-md-2 text-center'> <a class='btn btn-danger py-0 fs-5'
                    onclick='hapusBaris(\"#baris"+input+"\")'>-</a> <a class='btn btn-primary py-0 fs-5'
                    onclick='tambahBaris()'>+</a> </div>
        </div>
    @endif --}}
</div>
