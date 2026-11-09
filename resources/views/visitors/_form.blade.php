@php($visitor = $visitor ?? null)

<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" id="name" name="name"
           class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $visitor?->name) }}">
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="address" class="form-label">Address</label>
    <input type="text" id="address" name="address"
           class="form-control @error('address') is-invalid @enderror"
           value="{{ old('address', $visitor?->address) }}">
    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="position" class="form-label">Position</label>
    <input type="text" id="position" name="position"
           class="form-control @error('position') is-invalid @enderror"
           value="{{ old('position', $visitor?->position) }}">
    @error('position') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>