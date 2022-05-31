<h2>Category</h2>
@foreach (App\Models\ProductCategory::all() as $category)
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
    <label class="form-check-label" for="flexCheckDefault">
        {{ $category->name }}
    </label>
  </div>
@endforeach
