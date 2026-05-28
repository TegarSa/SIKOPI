@extends('backend.layouts.index')

@section('content')
<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="align-middle h3 d-inline">Edit Supplier</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-xl-12">
            <div class="card">

                <div class="card-header align-items-center">
                    <div class="row">
                        <div class="col-xl-12 text-end">
                            <a href="{{ route('po.index') }}" class="btn btn-warning">
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                   <form action="{{ route('po.update', $po->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Supplier --}}
                        <div class="mb-3">
                            <label>Supplier</label>
                            <input type="text" class="form-control" value="{{ $po->supplier->name }}" readonly>
                        </div>

                        @foreach($po->items as $index => $item)
                        <div class="mb-3 row">
                            <div class="col-6">
                                <input type="text" class="form-control" value="{{ $item->product->name }}" readonly>
                            </div>
                            <div class="col-2">
                                <input type="number" name="quantity[]" class="form-control quantity-input" value="{{ $item->quantity }}" min="1">
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control price-input" value="{{ $item->product->price }}" readonly>
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control sub-total-input" value="{{ $item->sub_total }}" readonly>
                            </div>
                        </div>
                        @endforeach

                        {{-- Status --}}
                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" class="form-select">
                                @foreach(['draft','approved','shipped','completed','canceled'] as $status)
                                    <option value="{{ $status }}" {{ $po->status == $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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