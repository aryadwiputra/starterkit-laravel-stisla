@extends('layouts.app')

@section('content')
<header class="page__header">
  <div class="flex items-center gap-3">
    <a href="{{ route('products.index') }}" class="button button--ghost button--neutral button--icon-only">
      <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
        <path fill="none" stroke="currentColor" stroke-width="1.5" d="m15 19l-7-7 7-7"/>
      </svg>
    </a>
    <div>
      <h1 class="page__title">New Product</h1>
      <p class="text-muted-foreground mt-1">Create a new product in your inventory.</p>
    </div>
  </div>
</header>

<div class="page__body">
  <form class="grid grid-cols-12 gap-4">
    <div class="col-span-12 xl:col-span-8">
      <div class="card">
        <div class="card__header">
          <h3 class="card__title">Product Information</h3>
        </div>
        <div class="card__body flex flex-col gap-4">
          <div class="field">
            <label for="name" class="field__label">Product Name</label>
            <input type="text" class="input" id="name" name="name" placeholder="Enter product name" required/>
          </div>
          <div class="field">
            <label for="description" class="field__label">Description</label>
            <textarea class="input" id="description" name="description" rows="4" placeholder="Enter product description"></textarea>
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div class="field">
              <label for="price" class="field__label">Price</label>
              <div class="input-group">
                <span class="input-group__text">$</span>
                <input type="number" class="input" id="price" name="price" placeholder="0.00" step="0.01" required/>
              </div>
            </div>
            <div class="field">
              <label for="stock" class="field__label">Stock</label>
              <input type="number" class="input" id="stock" name="stock" placeholder="0" required/>
            </div>
          </div>
          <div class="field">
            <label for="category" class="field__label">Category</label>
            <select class="input" id="category" name="category" required>
              <option value="">Select category</option>
              <option value="electronics">Electronics</option>
              <option value="furniture">Furniture</option>
              <option value="clothing">Clothing</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <div class="col-span-12 xl:col-span-4">
      <div class="card">
        <div class="card__header">
          <h3 class="card__title">Product Image</h3>
        </div>
        <div class="card__body">
          <div class="dropzone">
            <input type="file" class="dropzone__input" id="image" name="image" accept="image/*"/>
            <div class="dropzone__placeholder">
              <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12"/>
              </svg>
              <p>Click to upload or drag and drop</p>
              <p class="text-xs text-muted-foreground">PNG, JPG up to 2MB</p>
            </div>
          </div>
        </div>
      </div>

      <div class="card mt-4">
        <div class="card__header">
          <h3 class="card__title">Status</h3>
        </div>
        <div class="card__body">
          <div class="field">
            <select class="input" name="status">
              <option value="active">Active</option>
              <option value="draft">Draft</option>
              <option value="archived">Archived</option>
            </select>
          </div>
        </div>
      </div>

      <div class="flex gap-2 mt-4">
        <button type="submit" class="button button--primary button--block">Save Product</button>
        <a href="{{ route('products.index') }}" class="button button--outline button--neutral">Cancel</a>
      </div>
    </div>
  </form>
</div>
@endsection
