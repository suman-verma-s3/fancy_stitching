@extends('layouts.admin')

@section('title', 'Fancy Products - FancyStitch Admin')

@section('page-title', 'Fancy Products')

@section('page-subtitle', 'Manage your fancy product collection')

@section('content')

<style>
    .product-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 20px;
    }

    .search-box {
        flex: 1;
        max-width: 400px;
    }

    .search-box input {
        width: 100%;
        height: 45px;
        border: 1px solid #e5dfe1;
        border-radius: 10px;
        padding: 0 15px;
        outline: none;
        font-size: 14px;
    }

    .search-box input:focus {
        border-color: #b86c81;
    }

    .add-product-btn {
        border: none;
        background: #b86c81;
        color: #fff;
        padding: 12px 18px;
        border-radius: 10px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
    }

    .add-product-btn:hover {
        background: #9f586d;
    }

    .product-panel {
        background: #fff;
        border: 1px solid #eee;
        border-radius: 17px;
        box-shadow: 0 7px 25px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }

    .product-panel-header {
        padding: 20px 22px;
        border-bottom: 1px solid #eee;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .product-panel-header h3 {
        font-size: 18px;
    }

    .product-count {
        color: #999;
        font-size: 13px;
    }

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .product-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1100px;
    }

    .product-table th {
        background: #fcf7f8;
        color: #777;
        font-size: 12px;
        font-weight: 600;
        text-align: left;
        padding: 14px 18px;
        white-space: nowrap;
    }

    .product-table td {
        padding: 15px 18px;
        border-top: 1px solid #f0ebed;
        font-size: 14px;
        vertical-align: middle;
    }

    .product-image,
    .product-placeholder {
        width: 52px;
        height: 52px;
        border-radius: 10px;
    }

    .product-image {
        object-fit: cover;
        border: 1px solid #eee;
    }

    .product-placeholder {
        background: #fcf0f3;
        color: #b86c81;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .product-name {
        font-weight: 600;
    }

    .product-slug {
        margin-top: 4px;
        color: #999;
        font-size: 11px;
    }

    .sku {
        color: #777;
        font-size: 12px;
        font-weight: 600;
    }

    .category-badge {
        display: inline-block;
        background: #f8eef1;
        color: #9f586d;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .price-box {
        white-space: nowrap;
    }

    .cost-price {
        color: #888;
        font-size: 12px;
    }

    .selling-price {
        margin-top: 3px;
        font-weight: 700;
        color: #292126;
    }

    .profit {
        font-weight: 700;
        color: #4c8b62;
        white-space: nowrap;
    }

    .profit-loss {
        color: #b04d4d;
    }

    .stock {
        font-weight: 600;
    }

    .stock.low {
        color: #c77b38;
    }

    .stock.out {
        color: #b04d4d;
    }

    .stock.good {
        color: #4c8b62;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .status-badge.active {
        background: #edf8f1;
        color: #318152;
    }

    .status-badge.inactive {
        background: #f8eeee;
        color: #a45757;
    }

    .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .action-buttons {
        display: flex;
        gap: 7px;
    }

    .action-btn {
        width: 34px;
        height: 34px;
        border: 1px solid #eee;
        background: #fff;
        border-radius: 8px;
        cursor: pointer;
    }

    .edit-btn {
        color: #b86c81;
    }

    .edit-btn:hover {
        background: #fbf0f3;
    }

    .delete-btn {
        color: #b04d4d;
    }

    .delete-btn:hover {
        background: #fff1f1;
    }

    .empty-state {
        text-align: center;
        padding: 55px 20px;
        color: #999;
    }

    .empty-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 15px;
        border-radius: 50%;
        background: #fcf0f3;
        color: #b86c81;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
    }

    .empty-state h4 {
        color: #555;
        margin-bottom: 6px;
    }

    .alert-success {
        background: #edf8f1;
        color: #318152;
        border: 1px solid #d7eedf;
        padding: 12px 15px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 13px;
    }

    .alert-error {
        background: #fff1f1;
        color: #a45757;
        border: 1px solid #f0d1d1;
        padding: 12px 15px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 13px;
    }

    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(38, 27, 32, 0.55);
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
        z-index: 2000;
    }

    .modal-overlay.show {
        display: flex;
    }

    .product-modal {
        width: 100%;
        max-width: 620px;
        max-height: 92vh;
        overflow-y: auto;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.18);
    }

    .modal-header {
        padding: 20px 22px;
        border-bottom: 1px solid #eee;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .modal-header h3 {
        font-size: 18px;
    }

    .modal-close {
        width: 34px;
        height: 34px;
        border: none;
        border-radius: 8px;
        background: #f7f2f3;
        color: #555;
        font-size: 20px;
        cursor: pointer;
    }

    .modal-body {
        padding: 22px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 7px;
        color: #443a3e;
    }

    .form-control {
        width: 100%;
        border: 1px solid #e3dcdf;
        border-radius: 9px;
        padding: 11px 12px;
        outline: none;
        font-size: 14px;
        background: #fff;
    }

    .form-control:focus {
        border-color: #b86c81;
    }

    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    .image-preview,
    .current-image {
        width: 90px;
        height: 90px;
        border-radius: 12px;
        object-fit: cover;
        margin-top: 10px;
        border: 1px solid #eee;
    }

    .image-preview {
        display: none;
    }

    .current-image {
        display: none;
    }

    .modal-footer {
        padding: 16px 22px;
        border-top: 1px solid #eee;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .cancel-btn {
        border: 1px solid #ddd;
        background: #fff;
        color: #555;
        padding: 10px 17px;
        border-radius: 9px;
        cursor: pointer;
    }

    .save-btn {
        border: none;
        background: #b86c81;
        color: #fff;
        padding: 10px 18px;
        border-radius: 9px;
        cursor: pointer;
        font-weight: 600;
    }

    .save-btn:hover {
        background: #9f586d;
    }

    .price-help {
        margin-top: 5px;
        color: #999;
        font-size: 11px;
    }

    @media (max-width: 768px) {
        .product-toolbar {
            flex-direction: column;
            align-items: stretch;
        }

        .search-box {
            max-width: none;
        }

        .add-product-btn {
            width: 100%;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }
    }

    @media (max-width: 480px) {
        .modal-overlay {
            padding: 10px;
        }

        .modal-header,
        .modal-body,
        .modal-footer {
            padding-left: 17px;
            padding-right: 17px;
        }
    }
</style>


<div class="page-header">

    <h1>
        Fancy Products
    </h1>

    <p>
        Manage your fancy product collection.
    </p>

    <div class="breadcrumb">
        <span>Dashboard</span>
        <span>/</span>
        <span>Fancy Products</span>
    </div>

</div>


@if(session('success'))

    <div class="alert-success">
        {{ session('success') }}
    </div>

@endif


@if($errors->any())

    <div class="alert-error">

        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach

    </div>

@endif


<div class="product-toolbar">

    <div class="search-box">

        <input
            type="text"
            id="productSearch"
            placeholder="Search product, SKU or category..."
        >

    </div>


    <button
        type="button"
        class="add-product-btn"
        onclick="openAddProductModal()"
    >
        + Add Product
    </button>

</div>


<div class="product-panel">

    <div class="product-panel-header">

        <h3>
            All Products
        </h3>

        <span class="product-count">
            {{ $products->count() }} products
        </span>

    </div>


    <div class="table-wrapper">

        <table class="product-table">

            <thead>

                <tr>

                    <th>#</th>

                    <th>Product</th>

                    <th>SKU</th>

                    <th>Category</th>

                    <th>Cost / Selling</th>

                    <th>Profit</th>

                    <th>Stock</th>

                    <th>Status</th>

                    <th>Actions</th>

                </tr>

            </thead>


            <tbody>

                @forelse($products as $index => $product)

                    @php
                        $profit = $product->selling_price - $product->cost_price;
                    @endphp

                    <tr class="product-row">

                        <td>
                            {{ $index + 1 }}
                        </td>


                        <td>

                            <div style="display:flex;align-items:center;gap:12px;">

                                @if($product->image)

                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        class="product-image"
                                        alt="{{ $product->name }}"
                                    >

                                @else

                                    <div class="product-placeholder">
                                        +
                                    </div>

                                @endif


                                <div>

                                    <div class="product-name">
                                        {{ $product->name }}
                                    </div>

                                    <div class="product-slug">
                                        {{ $product->slug }}
                                    </div>

                                </div>

                            </div>

                        </td>


                        <td>

                            <span class="sku">
                                {{ $product->sku }}
                            </span>

                        </td>


                        <td>

                            <span class="category-badge">
                                {{ $product->category->name ?? 'No Category' }}
                            </span>

                        </td>


                        <td>

                            <div class="price-box">

                                <div class="cost-price">
                                    Cost: ₹{{ number_format($product->cost_price, 2) }}
                                </div>

                                <div class="selling-price">
                                    Sell: ₹{{ number_format($product->selling_price, 2) }}
                                </div>

                            </div>

                        </td>


                        <td>

                            @if($profit >= 0)

                                <span class="profit">
                                    +₹{{ number_format($profit, 2) }}
                                </span>

                            @else

                                <span class="profit profit-loss">
                                    -₹{{ number_format(abs($profit), 2) }}
                                </span>

                            @endif

                        </td>


                        <td>

                            @if($product->stock == 0)

                                <span class="stock out">
                                    Out
                                </span>

                            @elseif($product->stock <= $product->low_stock_limit)

                                <span class="stock low">
                                    {{ $product->stock }} Low
                                </span>

                            @else

                                <span class="stock good">
                                    {{ $product->stock }}
                                </span>

                            @endif

                        </td>


                        <td>

                            @if($product->status === 'active')

                                <span class="status-badge active">

                                    <span class="status-dot"></span>

                                    Active

                                </span>

                            @else

                                <span class="status-badge inactive">

                                    <span class="status-dot"></span>

                                    Inactive

                                </span>

                            @endif

                        </td>


                        <td>

                            <div class="action-buttons">

                                <button
                                    type="button"
                                    class="action-btn edit-btn"
                                    title="Edit"
                                    onclick='openEditProductModal(
                                        @json($product->id),
                                        @json($product->category_id),
                                        @json($product->name),
                                        @json($product->sku),
                                        @json($product->cost_price),
                                        @json($product->selling_price),
                                        @json($product->stock),
                                        @json($product->low_stock_limit),
                                        @json($product->description),
                                        @json($product->status),
                                        @json($product->image)
                                    )'
                                >
                                    ✎
                                </button>


                                <form
                                    action="{{ route('admin.products.destroy', $product->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this product?')"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="action-btn delete-btn"
                                        title="Delete"
                                    >
                                        🗑
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="9">

                            <div class="empty-state">

                                <div class="empty-icon">
                                    +
                                </div>

                                <h4>
                                    No Products Yet
                                </h4>

                                <p>
                                    Add your first fancy product to get started.
                                </p>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


<!-- ADD PRODUCT MODAL -->

<div
    class="modal-overlay"
    id="addProductModal"
>

    <div class="product-modal">

        <div class="modal-header">

            <h3>
                Add Product
            </h3>

            <button
                type="button"
                class="modal-close"
                onclick="closeAddProductModal()"
            >
                &times;
            </button>

        </div>


        <form
            action="{{ route('admin.products.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            <div class="modal-body">

                <div class="form-group">

                    <label class="form-label">
                        Product Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        placeholder="Example: Designer Saree"
                        required
                    >

                </div>


                <div class="form-row">

                    <div class="form-group">

                        <label class="form-label">
                            SKU
                        </label>

                        <input
                            type="text"
                            name="sku"
                            class="form-control"
                            placeholder="Example: SAR-001"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label class="form-label">
                            Category
                        </label>

                        <select
                            name="category_id"
                            class="form-control"
                            required
                        >

                            <option value="">
                                Select Category
                            </option>

                            @foreach($categories as $category)

                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>


                <div class="form-row">

                    <div class="form-group">

                        <label class="form-label">
                            Cost Price
                        </label>

                        <input
                            type="number"
                            name="cost_price"
                            class="form-control"
                            placeholder="1800"
                            min="0"
                            step="0.01"
                            required
                        >

                        <div class="price-help">
                            Your purchase/cost price
                        </div>

                    </div>


                    <div class="form-group">

                        <label class="form-label">
                            Selling Price
                        </label>

                        <input
                            type="number"
                            name="selling_price"
                            class="form-control"
                            placeholder="2500"
                            min="0"
                            step="0.01"
                            required
                        >

                        <div class="price-help">
                            Customer selling price
                        </div>

                    </div>

                </div>


                <div class="form-row">

                    <div class="form-group">

                        <label class="form-label">
                            Stock
                        </label>

                        <input
                            type="number"
                            name="stock"
                            class="form-control"
                            placeholder="10"
                            min="0"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label class="form-label">
                            Low Stock Limit
                        </label>

                        <input
                            type="number"
                            name="low_stock_limit"
                            class="form-control"
                            value="5"
                            min="0"
                            required
                        >

                    </div>

                </div>


                <div class="form-group">

                    <label class="form-label">
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-control"
                        required
                    >

                        <option value="active">
                            Active
                        </option>

                        <option value="inactive">
                            Inactive
                        </option>

                    </select>

                </div>


                <div class="form-group">

                    <label class="form-label">
                        Product Image
                    </label>

                    <input
                        type="file"
                        name="image"
                        id="addProductImage"
                        class="form-control"
                        accept="image/*"
                    >

                    <img
                        id="addImagePreview"
                        class="image-preview"
                        alt="Preview"
                    >

                </div>


                <div class="form-group">

                    <label class="form-label">
                        Description
                    </label>

                    <textarea
                        name="description"
                        class="form-control"
                        placeholder="Write product description..."
                    ></textarea>

                </div>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="cancel-btn"
                    onclick="closeAddProductModal()"
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    class="save-btn"
                >
                    Save Product
                </button>

            </div>

        </form>

    </div>

</div>


<!-- EDIT PRODUCT MODAL -->

<div
    class="modal-overlay"
    id="editProductModal"
>

    <div class="product-modal">

        <div class="modal-header">

            <h3>
                Edit Product
            </h3>

            <button
                type="button"
                class="modal-close"
                onclick="closeEditProductModal()"
            >
                &times;
            </button>

        </div>


        <form
            id="editProductForm"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            @method('PUT')


            <div class="modal-body">

                <div class="form-group">

                    <label class="form-label">
                        Product Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        id="editProductName"
                        class="form-control"
                        required
                    >

                </div>


                <div class="form-row">

                    <div class="form-group">

                        <label class="form-label">
                            SKU
                        </label>

                        <input
                            type="text"
                            name="sku"
                            id="editProductSku"
                            class="form-control"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label class="form-label">
                            Category
                        </label>

                        <select
                            name="category_id"
                            id="editProductCategory"
                            class="form-control"
                            required
                        >

                            @foreach($categories as $category)

                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>


                <div class="form-row">

                    <div class="form-group">

                        <label class="form-label">
                            Cost Price
                        </label>

                        <input
                            type="number"
                            name="cost_price"
                            id="editProductCostPrice"
                            class="form-control"
                            min="0"
                            step="0.01"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label class="form-label">
                            Selling Price
                        </label>

                        <input
                            type="number"
                            name="selling_price"
                            id="editProductSellingPrice"
                            class="form-control"
                            min="0"
                            step="0.01"
                            required
                        >

                    </div>

                </div>


                <div class="form-row">

                    <div class="form-group">

                        <label class="form-label">
                            Stock
                        </label>

                        <input
                            type="number"
                            name="stock"
                            id="editProductStock"
                            class="form-control"
                            min="0"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label class="form-label">
                            Low Stock Limit
                        </label>

                        <input
                            type="number"
                            name="low_stock_limit"
                            id="editProductLowStock"
                            class="form-control"
                            min="0"
                            required
                        >

                    </div>

                </div>


                <div class="form-group">

                    <label class="form-label">
                        Status
                    </label>

                    <select
                        name="status"
                        id="editProductStatus"
                        class="form-control"
                        required
                    >

                        <option value="active">
                            Active
                        </option>

                        <option value="inactive">
                            Inactive
                        </option>

                    </select>

                </div>


                <div class="form-group">

                    <label class="form-label">
                        Product Image
                    </label>

                    <input
                        type="file"
                        name="image"
                        id="editProductImage"
                        class="form-control"
                        accept="image/*"
                    >

                    <img
                        id="editImagePreview"
                        class="image-preview"
                        alt="Preview"
                    >

                    <img
                        id="currentProductImage"
                        class="current-image"
                        alt="Current product image"
                    >

                </div>


                <div class="form-group">

                    <label class="form-label">
                        Description
                    </label>

                    <textarea
                        name="description"
                        id="editProductDescription"
                        class="form-control"
                    ></textarea>

                </div>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="cancel-btn"
                    onclick="closeEditProductModal()"
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    class="save-btn"
                >
                    Update Product
                </button>

            </div>

        </form>

    </div>

</div>


<script>

    const addProductModal =
        document.getElementById('addProductModal');

    const editProductModal =
        document.getElementById('editProductModal');

    const editProductForm =
        document.getElementById('editProductForm');


    function openAddProductModal() {

        addProductModal.classList.add('show');

        document.body.style.overflow = 'hidden';

    }


    function closeAddProductModal() {

        addProductModal.classList.remove('show');

        document.body.style.overflow = '';

    }


    function openEditProductModal(
        id,
        categoryId,
        name,
        sku,
        costPrice,
        sellingPrice,
        stock,
        lowStockLimit,
        description,
        status,
        image
    ) {

        editProductForm.action =
            "{{ url('/admin/products') }}/" + id;


        document.getElementById(
            'editProductName'
        ).value = name;


        document.getElementById(
            'editProductSku'
        ).value = sku;


        document.getElementById(
            'editProductCategory'
        ).value = categoryId;


        document.getElementById(
            'editProductCostPrice'
        ).value = costPrice;


        document.getElementById(
            'editProductSellingPrice'
        ).value = sellingPrice;


        document.getElementById(
            'editProductStock'
        ).value = stock;


        document.getElementById(
            'editProductLowStock'
        ).value = lowStockLimit;


        document.getElementById(
            'editProductDescription'
        ).value = description || '';


        document.getElementById(
            'editProductStatus'
        ).value = status;


        const currentImage =
            document.getElementById(
                'currentProductImage'
            );


        if (image) {

            currentImage.src =
                "{{ asset('storage') }}/" + image;

            currentImage.style.display = 'block';

        } else {

            currentImage.style.display = 'none';

        }


        document.getElementById(
            'editImagePreview'
        ).style.display = 'none';


        editProductModal.classList.add('show');

        document.body.style.overflow = 'hidden';

    }


    function closeEditProductModal() {

        editProductModal.classList.remove('show');

        document.body.style.overflow = '';

    }


    addProductModal.addEventListener(
        'click',
        function(event) {

            if (event.target === addProductModal) {

                closeAddProductModal();

            }

        }
    );


    editProductModal.addEventListener(
        'click',
        function(event) {

            if (event.target === editProductModal) {

                closeEditProductModal();

            }

        }
    );


    document.getElementById(
        'addProductImage'
    ).addEventListener(
        'change',
        function(event) {

            const file = event.target.files[0];

            const preview =
                document.getElementById(
                    'addImagePreview'
                );


            if (file) {

                preview.src =
                    URL.createObjectURL(file);

                preview.style.display = 'block';

            } else {

                preview.style.display = 'none';

            }

        }
    );


    document.getElementById(
        'editProductImage'
    ).addEventListener(
        'change',
        function(event) {

            const file = event.target.files[0];

            const preview =
                document.getElementById(
                    'editImagePreview'
                );


            if (file) {

                preview.src =
                    URL.createObjectURL(file);

                preview.style.display = 'block';

            } else {

                preview.style.display = 'none';

            }

        }
    );


    document.getElementById(
        'productSearch'
    ).addEventListener(
        'input',
        function() {

            const searchValue =
                this.value.toLowerCase().trim();


            const rows =
                document.querySelectorAll(
                    '.product-row'
                );


            rows.forEach(function(row) {

                const text =
                    row.textContent.toLowerCase();


                row.style.display =
                    text.includes(searchValue)
                        ? ''
                        : 'none';

            });

        }
    );


    document.addEventListener(
        'keydown',
        function(event) {

            if (event.key === 'Escape') {

                closeAddProductModal();

                closeEditProductModal();

            }

        }
    );

</script>

@endsection