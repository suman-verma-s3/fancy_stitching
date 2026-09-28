@extends('layouts.admin')

@section('title', 'Categories - FancyStitch Admin')

@section('page-title', 'Categories')

@section('page-subtitle', 'Manage your product categories')

@section('content')

<style>
    .category-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 20px;
    }

    .search-box {
        position: relative;
        flex: 1;
        max-width: 380px;
    }

    .search-box input {
        width: 100%;
        height: 45px;
        border: 1px solid #e5dfe1;
        border-radius: 10px;
        padding: 0 15px;
        outline: none;
        font-size: 14px;
        background: #fff;
    }

    .search-box input:focus {
        border-color: #b86c81;
    }

    .add-category-btn {
        border: none;
        background: #b86c81;
        color: #fff;
        padding: 12px 18px;
        border-radius: 10px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        transition: 0.2s;
    }

    .add-category-btn:hover {
        background: #9f586d;
    }

    .category-panel {
        background: #fff;
        border: 1px solid #eee;
        border-radius: 17px;
        box-shadow: 0 7px 25px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }

    .category-panel-header {
        padding: 20px 22px;
        border-bottom: 1px solid #eee;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .category-panel-header h3 {
        font-size: 18px;
    }

    .category-count {
        color: #999;
        font-size: 13px;
    }

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .category-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 700px;
    }

    .category-table th {
        background: #fcf7f8;
        color: #777;
        font-size: 12px;
        font-weight: 600;
        text-align: left;
        padding: 14px 20px;
        white-space: nowrap;
    }

    .category-table td {
        padding: 16px 20px;
        border-top: 1px solid #f0ebed;
        font-size: 14px;
        vertical-align: middle;
    }

    .category-name {
        font-weight: 600;
        color: #292126;
    }

    .category-slug {
        color: #999;
        font-size: 12px;
    }

    .category-description {
        color: #777;
        max-width: 280px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
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
        align-items: center;
        gap: 7px;
    }

    .action-btn {
        border: 1px solid #eee;
        background: #fff;
        width: 34px;
        height: 34px;
        border-radius: 8px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.2s;
    }

    .edit-btn {
        color: #b86c81;
    }

    .edit-btn:hover {
        background: #fbf0f3;
        border-color: #e8c4cd;
    }

    .delete-btn {
        color: #b04d4d;
    }

    .delete-btn:hover {
        background: #fff1f1;
        border-color: #efcccc;
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

    .empty-state p {
        font-size: 13px;
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

    .validation-error {
        color: #c05050;
        font-size: 12px;
        margin-top: 5px;
        display: block;
    }

    /* Modal */

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

    .category-modal {
        width: 100%;
        max-width: 520px;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.18);
        overflow: hidden;
        animation: modalShow 0.2s ease;
    }

    @keyframes modalShow {
        from {
            opacity: 0;
            transform: translateY(15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
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

    .modal-close:hover {
        background: #f1e5e8;
    }

    .modal-body {
        padding: 22px;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-group:last-child {
        margin-bottom: 0;
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

    @media (max-width: 768px) {
        .category-toolbar {
            flex-direction: column;
            align-items: stretch;
        }

        .search-box {
            max-width: none;
        }

        .add-category-btn {
            width: 100%;
        }

        .category-panel-header {
            padding: 17px;
        }
    }

    @media (max-width: 480px) {
        .modal-overlay {
            padding: 12px;
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
        Categories
    </h1>

    <p>
        Create and manage categories for your fancy products.
    </p>

    <div class="breadcrumb">

        <span class="home">
            Dashboard
        </span>

        <span class="separator">
            /
        </span>

        <span class="current">
            Categories
        </span>

    </div>

</div>


@if(session('success'))

    <div class="alert-success">
        {{ session('success') }}
    </div>

@endif


<div class="category-toolbar">

    <div class="search-box">

        <input
            type="text"
            id="categorySearch"
            placeholder="Search categories..."
        >

    </div>


    <button
        type="button"
        class="add-category-btn"
        onclick="openAddModal()"
    >

        + Add Category

    </button>

</div>


<div class="category-panel">


    <div class="category-panel-header">

        <h3>
            All Categories
        </h3>

        <span class="category-count">
            {{ $categories->count() }} categories
        </span>

    </div>


    <div class="table-wrapper">

        <table class="category-table">

            <thead>

                <tr>

                    <th>
                        #
                    </th>

                    <th>
                        Category
                    </th>

                    <th>
                        Description
                    </th>

                    <th>
                        Status
                    </th>

                    <th>
                        Actions
                    </th>

                </tr>

            </thead>


            <tbody id="categoryTableBody">

                @forelse($categories as $index => $category)

                    <tr class="category-row">

                        <td>
                            {{ $index + 1 }}
                        </td>


                        <td>

                            <div class="category-name">
                                {{ $category->name }}
                            </div>

                            <div class="category-slug">
                                {{ $category->slug }}
                            </div>

                        </td>


                        <td>

                            <div class="category-description">

                                {{ $category->description ?: 'No description' }}

                            </div>

                        </td>


                        <td>

                            @if($category->status === 'active')

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
                                    onclick='openEditModal(
                                        @json($category->id),
                                        @json($category->name),
                                        @json($category->description),
                                        @json($category->status)
                                    )'
                                >

                                    ✎

                                </button>


                                <form
                                    action="{{ route('admin.categories.destroy', $category->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this category?')"
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

                        <td colspan="5">

                            <div class="empty-state">

                                <div class="empty-icon">
                                    +
                                </div>

                                <h4>
                                    No Categories Yet
                                </h4>

                                <p>
                                    Add your first category to get started.
                                </p>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>



<!-- =========================================
     ADD CATEGORY MODAL
========================================= -->

<div
    class="modal-overlay"
    id="addCategoryModal"
>

    <div class="category-modal">


        <div class="modal-header">

            <h3>
                Add Category
            </h3>

            <button
                type="button"
                class="modal-close"
                onclick="closeAddModal()"
            >

                &times;

            </button>

        </div>


        <form
            action="{{ route('admin.categories.store') }}"
            method="POST"
        >

            @csrf


            <div class="modal-body">


                <div class="form-group">

                    <label class="form-label">
                        Category Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        placeholder="Example: Sarees"
                        value="{{ old('name') }}"
                        required
                    >

                    @error('name')

                        <span class="validation-error">
                            {{ $message }}
                        </span>

                    @enderror

                </div>


                <div class="form-group">

                    <label class="form-label">
                        Description
                    </label>

                    <textarea
                        name="description"
                        class="form-control"
                        placeholder="Write a short category description..."
                    >{{ old('description') }}</textarea>

                    @error('description')

                        <span class="validation-error">
                            {{ $message }}
                        </span>

                    @enderror

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


            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="cancel-btn"
                    onclick="closeAddModal()"
                >

                    Cancel

                </button>


                <button
                    type="submit"
                    class="save-btn"
                >

                    Save Category

                </button>

            </div>


        </form>

    </div>

</div>



<!-- =========================================
     EDIT CATEGORY MODAL
========================================= -->

<div
    class="modal-overlay"
    id="editCategoryModal"
>

    <div class="category-modal">


        <div class="modal-header">

            <h3>
                Edit Category
            </h3>

            <button
                type="button"
                class="modal-close"
                onclick="closeEditModal()"
            >

                &times;

            </button>

        </div>


        <form
            id="editCategoryForm"
            method="POST"
        >

            @csrf

            @method('PUT')


            <div class="modal-body">


                <div class="form-group">

                    <label class="form-label">
                        Category Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        id="editCategoryName"
                        class="form-control"
                        required
                    >

                </div>


                <div class="form-group">

                    <label class="form-label">
                        Description
                    </label>

                    <textarea
                        name="description"
                        id="editCategoryDescription"
                        class="form-control"
                        placeholder="Write a short category description..."
                    ></textarea>

                </div>


                <div class="form-group">

                    <label class="form-label">
                        Status
                    </label>

                    <select
                        name="status"
                        id="editCategoryStatus"
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


            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="cancel-btn"
                    onclick="closeEditModal()"
                >

                    Cancel

                </button>


                <button
                    type="submit"
                    class="save-btn"
                >

                    Update Category

                </button>

            </div>


        </form>

    </div>

</div>



<script>

    const addCategoryModal =
        document.getElementById('addCategoryModal');

    const editCategoryModal =
        document.getElementById('editCategoryModal');

    const editCategoryForm =
        document.getElementById('editCategoryForm');


    function openAddModal() {

        addCategoryModal.classList.add('show');

        document.body.style.overflow = 'hidden';

    }


    function closeAddModal() {

        addCategoryModal.classList.remove('show');

        document.body.style.overflow = '';

    }


    function openEditModal(
        id,
        name,
        description,
        status
    ) {

        editCategoryForm.action =
            "{{ url('/admin/categories') }}/" + id;

        document.getElementById(
            'editCategoryName'
        ).value = name;

        document.getElementById(
            'editCategoryDescription'
        ).value = description || '';

        document.getElementById(
            'editCategoryStatus'
        ).value = status;

        editCategoryModal.classList.add('show');

        document.body.style.overflow = 'hidden';

    }


    function closeEditModal() {

        editCategoryModal.classList.remove('show');

        document.body.style.overflow = '';

    }


    addCategoryModal.addEventListener(
        'click',
        function (event) {

            if (event.target === addCategoryModal) {

                closeAddModal();

            }

        }
    );


    editCategoryModal.addEventListener(
        'click',
        function (event) {

            if (event.target === editCategoryModal) {

                closeEditModal();

            }

        }
    );


    /* Search */

    const searchInput =
        document.getElementById('categorySearch');

    searchInput.addEventListener(
        'input',
        function () {

            const searchValue =
                this.value.toLowerCase().trim();

            const rows =
                document.querySelectorAll('.category-row');

            rows.forEach(function (row) {

                const text =
                    row.textContent.toLowerCase();

                if (text.includes(searchValue)) {

                    row.style.display = '';

                } else {

                    row.style.display = 'none';

                }

            });

        }
    );


    /* Escape key */

    document.addEventListener(
        'keydown',
        function (event) {

            if (event.key === 'Escape') {

                closeAddModal();

                closeEditModal();

            }

        }
    );

</script>

@endsection