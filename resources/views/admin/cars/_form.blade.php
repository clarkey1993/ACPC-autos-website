@csrf

<div class="row g-3">
    <div class="col-md-6">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $car->title ?? '') }}" required>
    </div>

    <div class="col-md-6">
        <label for="make" class="form-label">Make</label>
        <input type="text" name="make" id="make" class="form-control" value="{{ old('make', $car->make ?? '') }}" required>
    </div>

    <div class="col-md-6">
        <label for="model" class="form-label">Model</label>
        <input type="text" name="model" id="model" class="form-control" value="{{ old('model', $car->model ?? '') }}" required>
    </div>

    <div class="col-md-3">
        <label for="year" class="form-label">Year</label>
        <input type="number" name="year" id="year" class="form-control" value="{{ old('year', $car->year ?? '') }}" min="1900" max="{{ date('Y') + 1 }}" required>
    </div>

    <div class="col-md-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $car->price ?? '') }}" min="0" required>
    </div>

    <div class="col-md-4">
        <label for="mileage" class="form-label">Mileage</label>
        <input type="number" name="mileage" id="mileage" class="form-control" value="{{ old('mileage', $car->mileage ?? '') }}" min="0">
    </div>

    <div class="col-md-4">
        <label for="location" class="form-label">Location</label>
        <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $car->location ?? '') }}" placeholder="e.g. Málaga">
        <small class="text-muted">Shown on public listings. Leave blank to use the default showroom location.</small>
    </div>

    <div class="col-md-4">
        <label for="fuel_type" class="form-label">Fuel Type</label>
        <input type="text" name="fuel_type" id="fuel_type" class="form-control" value="{{ old('fuel_type', $car->fuel_type ?? '') }}">
    </div>

    <div class="col-md-4">
        <label for="transmission" class="form-label">Transmission</label>
        <input type="text" name="transmission" id="transmission" class="form-control" value="{{ old('transmission', $car->transmission ?? '') }}">
    </div>

    <div class="col-md-4">
        <label for="colour" class="form-label">Colour</label>
        <input type="text" name="colour" id="colour" class="form-control" value="{{ old('colour', $car->colour ?? '') }}">
    </div>

    <div class="col-md-4">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-select" required>
            @php($selectedStatus = old('status', $car->status ?? 'available'))
            <option value="available" @selected($selectedStatus === 'available')>Available</option>
            <option value="just_arrived" @selected($selectedStatus === 'just_arrived')>Just Arrived</option>
            <option value="arriving_soon" @selected($selectedStatus === 'arriving_soon')>Arriving Soon</option>
            <option value="reserved" @selected($selectedStatus === 'reserved')>Reserved</option>
            <option value="sold" @selected($selectedStatus === 'sold')>Sold</option>
        </select>
    </div>

    <div class="col-md-6">
        <label for="featured_image" class="form-label">Featured Image</label>
        <input type="file" name="featured_image" id="featured_image" class="form-control" accept="image/*">

        @if (!empty($car->featured_image ?? null))
            <img
                src="{{ \Illuminate\Support\Facades\Storage::url($car->featured_image) }}"
                alt="Current featured image"
                class="img-thumbnail mt-2"
                style="max-width: 140px;"
            >
        @endif
    </div>

    <div class="col-md-6">
        <label for="gallery_images" class="form-label">Gallery Images</label>
        <input type="file" name="gallery_images[]" id="gallery_images" class="form-control" accept="image/*" multiple>

        @if (!empty($car->images ?? null) && $car->images->isNotEmpty())
            <small class="text-muted d-block mt-2">
                {{ $car->images->count() }} gallery image(s) already uploaded.
            </small>
        @endif
    </div>

    <div class="col-md-6">
        <label for="sort_order" class="form-label">Display Order</label>
        <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order', $car->sort_order ?? '') }}" min="0" step="1">
        <small class="text-muted">Lower numbers appear first. Leave blank for automatic ordering.</small>
    </div>

    <div class="col-12">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $car->description ?? '') }}</textarea>
    </div>
</div>

<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ $submitLabel ?? 'Save Car' }}</button>
    <a href="{{ route('admin.cars.index') }}" class="btn btn-secondary">Cancel</a>
</div>
