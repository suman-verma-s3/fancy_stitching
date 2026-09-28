<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Add Stitching Service
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Create a new stitching service with multiple images.
                </p>
            </div>

            <a
                href="{{ route('admin.stitching-services.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold text-sm hover:bg-gray-200 transition"
            >
                ← Back
            </a>
        </div>
    </x-slot>


    <div class="py-8">

        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if($errors->any())

                <div class="mb-6 rounded-xl bg-red-50 border border-red-200 p-5">

                    <h3 class="font-semibold text-red-700 mb-2">
                        Please fix the following errors:
                    </h3>

                    <ul class="list-disc list-inside text-sm text-red-600 space-y-1">

                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif


            <form
                method="POST"
                action="{{ route('admin.stitching-services.store') }}"
                enctype="multipart/form-data"
                x-data="imageUploader()"
            >

                @csrf


                <!-- Main Information -->
                <div class="bg-white shadow-sm rounded-2xl p-6 mb-6">

                    <div class="mb-6">

                        <h3 class="text-lg font-semibold text-gray-800">
                            Service Information
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Add the basic details of your stitching service.
                        </p>

                    </div>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Service Name -->
                        <div class="md:col-span-2">

                            <label
                                for="name"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                Service Name
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Example: Designer Blouse Stitching"
                                required
                                class="w-full rounded-xl border-gray-300 focus:border-pink-500 focus:ring-pink-500"
                            >

                            @error('name')
                                <p class="text-sm text-red-600 mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        <!-- Price -->
                        <div>

                            <label
                                for="price"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                Price
                            </label>

                            <div class="relative">

                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
                                    ₹
                                </span>

                                <input
                                    type="number"
                                    id="price"
                                    name="price"
                                    value="{{ old('price') }}"
                                    placeholder="999"
                                    min="0"
                                    step="0.01"
                                    required
                                    class="w-full rounded-xl border-gray-300 pl-9 focus:border-pink-500 focus:ring-pink-500"
                                >

                            </div>

                            @error('price')
                                <p class="text-sm text-red-600 mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        <!-- Discount Price -->
                        <div>

                            <label
                                for="discount_price"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                Discount Price
                            </label>

                            <div class="relative">

                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
                                    ₹
                                </span>

                                <input
                                    type="number"
                                    id="discount_price"
                                    name="discount_price"
                                    value="{{ old('discount_price') }}"
                                    placeholder="799"
                                    min="0"
                                    step="0.01"
                                    class="w-full rounded-xl border-gray-300 pl-9 focus:border-pink-500 focus:ring-pink-500"
                                >

                            </div>

                            <p class="text-xs text-gray-500 mt-1">
                                Leave empty if there is no discount.
                            </p>

                            @error('discount_price')
                                <p class="text-sm text-red-600 mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        <!-- Short Description -->
                        <div class="md:col-span-2">

                            <label
                                for="short_description"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                Short Description
                            </label>

                            <textarea
                                id="short_description"
                                name="short_description"
                                rows="3"
                                placeholder="Short description for service cards..."
                                class="w-full rounded-xl border-gray-300 focus:border-pink-500 focus:ring-pink-500"
                            >{{ old('short_description') }}</textarea>

                            @error('short_description')
                                <p class="text-sm text-red-600 mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        <!-- Full Description -->
                        <div class="md:col-span-2">

                            <label
                                for="description"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                Full Description
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                rows="6"
                                placeholder="Describe the stitching service in detail..."
                                class="w-full rounded-xl border-gray-300 focus:border-pink-500 focus:ring-pink-500"
                            >{{ old('description') }}</textarea>

                            @error('description')
                                <p class="text-sm text-red-600 mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        <!-- Status -->
                        <div>

                            <label
                                for="status"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                Status
                            </label>

                            <select
                                id="status"
                                name="status"
                                required
                                class="w-full rounded-xl border-gray-300 focus:border-pink-500 focus:ring-pink-500"
                            >

                                <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>
                                    Inactive
                                </option>

                            </select>

                        </div>

                    </div>

                </div>


                <!-- Multiple Images -->
                <div class="bg-white shadow-sm rounded-2xl p-6 mb-6">

                    <div class="mb-6">

                        <h3 class="text-lg font-semibold text-gray-800">
                            Service Images
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Upload multiple images. The first image will be used as the primary image.
                        </p>

                    </div>


                    <!-- Upload Area -->
                    <label
                        for="images"
                        class="block border-2 border-dashed border-pink-200 rounded-2xl p-8 text-center cursor-pointer hover:border-pink-400 hover:bg-pink-50/30 transition"
                    >

                        <div class="flex flex-col items-center">

                            <div class="w-14 h-14 rounded-full bg-pink-50 flex items-center justify-center mb-4">

                                <svg
                                    class="w-7 h-7 text-pink-500"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 16V4m0 0L8 8m4-4l4 4M5 20h14"
                                    />

                                </svg>

                            </div>


                            <h4 class="font-semibold text-gray-800">
                                Click to upload images
                            </h4>

                            <p class="text-sm text-gray-500 mt-1">
                                Select multiple JPG, PNG or WEBP images
                            </p>

                            <p class="text-xs text-gray-400 mt-2">
                                Maximum 5 MB per image
                            </p>

                        </div>

                        <input
                            id="images"
                            type="file"
                            name="images[]"
                            multiple
                            accept="image/jpeg,image/png,image/jpg,image/webp"
                            class="hidden"
                            @change="previewImages($event)"
                            required
                        >

                    </label>


                    @error('images')
                        <p class="text-sm text-red-600 mt-2">
                            {{ $message }}
                        </p>
                    @enderror


                    @error('images.*')
                        <p class="text-sm text-red-600 mt-2">
                            {{ $message }}
                        </p>
                    @enderror


                    <!-- Preview -->
                    <div
                        x-show="images.length > 0"
                        x-cloak
                        class="mt-6"
                    >

                        <div class="flex items-center justify-between mb-4">

                            <div>

                                <h4 class="font-semibold text-gray-800">
                                    Image Preview
                                </h4>

                                <p class="text-xs text-gray-500">
                                    First image will be the primary image.
                                </p>

                            </div>

                            <span
                                class="text-sm font-medium text-pink-600"
                                x-text="images.length + ' image(s) selected'"
                            ></span>

                        </div>


                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">

                            <template x-for="(image, index) in images" :key="index">

                                <div class="relative group">

                                    <div class="aspect-square rounded-xl overflow-hidden bg-gray-100 border border-gray-200">

                                        <img
                                            :src="image.url"
                                            :alt="image.name"
                                            class="w-full h-full object-cover"
                                        >

                                    </div>


                                    <!-- Primary Badge -->
                                    <div
                                        x-show="index === 0"
                                        class="absolute top-2 left-2 px-2 py-1 rounded-full bg-pink-600 text-white text-xs font-semibold"
                                    >
                                        Primary
                                    </div>


                                    <!-- Remove Button -->
                                    <button
                                        type="button"
                                        @click="removeImage(index)"
                                        class="absolute top-2 right-2 w-8 h-8 rounded-full bg-white/90 text-red-500 shadow hover:bg-red-500 hover:text-white transition"
                                    >
                                        ×
                                    </button>


                                    <div class="mt-2">

                                        <p
                                            class="text-xs text-gray-600 truncate"
                                            x-text="image.name"
                                        ></p>

                                    </div>

                                </div>

                            </template>

                        </div>

                    </div>

                </div>


                <!-- Actions -->
                <div class="flex flex-col sm:flex-row items-center justify-end gap-3">

                    <a
                        href="{{ route('admin.stitching-services.index') }}"
                        class="w-full sm:w-auto inline-flex justify-center items-center px-5 py-2.5 rounded-xl bg-gray-100 text-gray-700 font-semibold text-sm hover:bg-gray-200 transition"
                    >
                        Cancel
                    </a>


                    <button
                        type="submit"
                        class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-2.5 rounded-xl bg-pink-600 text-white font-semibold text-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 transition"
                    >
                        Save Stitching Service
                    </button>

                </div>

            </form>

        </div>

    </div>


    <!-- Image Preview Script -->
    <script>

        function imageUploader() {

            return {

                images: [],

                previewImages(event) {

                    const files = Array.from(event.target.files);

                    this.images = [];

                    files.forEach((file) => {

                        if (!file.type.startsWith('image/')) {
                            return;
                        }

                        if (file.size > 5 * 1024 * 1024) {
                            alert(file.name + ' is larger than 5 MB.');
                            return;
                        }

                        this.images.push({
                            file: file,
                            name: file.name,
                            url: URL.createObjectURL(file)
                        });

                    });

                    this.updateInput();

                },


                removeImage(index) {

                    this.images.splice(index, 1);

                    this.updateInput();

                },


                updateInput() {

                    const input = document.getElementById('images');

                    const dataTransfer = new DataTransfer();

                    this.images.forEach((image) => {
                        dataTransfer.items.add(image.file);
                    });

                    input.files = dataTransfer.files;

                }

            }

        }

    </script>

</x-app-layout>