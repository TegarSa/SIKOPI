@extends('backend.layouts.index')

@section('content')
<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="align-middle h3 d-inline">Tambah Purchase Order</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-xl-12">
            <div class="card">

                <div class="card-header text-end">
                    <a href="{{ route('po.index') }}" class="btn btn-warning">Kembali</a>
                </div>

                <div class="card-body">
                    <form action="{{ route('po.store') }}" method="POST">
                        @csrf

                        {{-- SUPPLIER --}}
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label text-sm-end">Supplier</label>
                            <div class="col-sm-10">
                                <select name="supplier_id" class="form-select" required>
                                    <option value="">-- Pilih Supplier --</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- PO DATE --}}
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label text-sm-end">Tanggal PO</label>
                            <div class="col-sm-10">
                                <input type="date" name="po_date" class="form-control" required>
                            </div>
                        </div>

                        {{-- STATUS --}}
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label text-sm-end">Status</label>
                            <div class="col-sm-10">
                                <select name="status" class="form-select" required>
                                    <option value="draft">Draft</option>
                                    <option value="approved">Approved</option>
                                    <option value="shipped">Shipped</option>
                                    <option value="completed">Completed</option>
                                    <option value="canceled">Canceled</option>
                                </select>
                            </div>
                        </div>

                        <hr>

                        {{-- PRODUCT --}}
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label text-sm-end">Produk</label>
                            <div class="col-sm-10">
                                <select name="product_id[]" class="form-select product-select" required>
                                    <option value="">-- Pilih Produk --</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- QUANTITY --}}
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label text-sm-end">Jumlah</label>
                            <div class="col-sm-10">
                                <input type="number" name="quantity[]" class="form-control quantity-input" min="1" required>
                            </div>
                        </div>

                        {{-- PRICE --}}
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label text-sm-end">Harga</label>
                            <div class="col-sm-10">
                                <input type="number" name="price[]" class="form-control price-input" readonly>
                            </div>
                        </div>

                        {{-- BUTTON --}}
                        <div class="mb-3 row">
                            <div class="col-sm-10 ms-sm-auto">
                                <button type="submit" class="btn btn-primary">
                                    Simpan PO
                                </button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection

@push('js')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const productSelects = document.querySelectorAll('.product-select');
    const quantityInputs = document.querySelectorAll('.quantity-input');
    const priceInputs = document.querySelectorAll('.price-input');

    productSelects.forEach((select, index) => {
        const quantityInput = quantityInputs[index];
        const priceInput = priceInputs[index];

        function updatePrice() {
            const selectedOption = select.options[select.selectedIndex];
            const productPrice = Number(selectedOption.dataset.price || 0);
            const qty = Number(quantityInput.value || 0);
            priceInput.value = productPrice * qty;
        }

        select.addEventListener('change', updatePrice);
        quantityInput.addEventListener('input', updatePrice);
    });
});
</script>
@endpush
