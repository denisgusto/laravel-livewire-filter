<?php

use App\Livewire\Products\Index;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Livewire;
use function Pest\Laravel\{actingAs, get};

beforeEach(function () {
    $this->category = Category::factory()->create();
    $this->brand = Brand::factory()->create();

    $this->productA = Product::factory()->create([
        'name' => 'Produto A',
        'category_id' => $this->category->id,
        'brand_id' => $this->brand->id,
    ]);

    $this->productB = Product::factory()->create([
        'name' => 'Produto B',
        'category_id' => $this->category->id,
        'brand_id' => $this->brand->id,
    ]);
});

it('renders the component successfully', function () {
    Livewire::test(Index::class)
        ->assertOk();
});

it('should be shows all products without filters', function () {
    Livewire::test(Index::class)
        ->assertCount('products', 2);
});

it('should be filters by product name', function () {
    Livewire::test(Index::class)
        ->set('filters.product', 'Produto A')
        ->assertCount('products', 1)
        ->assertSee('Produto A')
        ->assertDontSee('Produto B');
});

it('should be filters by category', function () {
    $otherCategory = Category::factory()->create();
    $productInOtherCategory = Product::factory()->create(['category_id' => $otherCategory->id]);

    Livewire::test(Index::class)
        ->set('filters.category', $this->category->id)
        ->assertCount('products', 2)
        ->assertDontSee($productInOtherCategory->name);
});

it('should be filters by brand', function () {
    $otherBrand = Brand::factory()->create();
    $productInOtherBrand = Product::factory()->create(['brand_id' => $otherBrand->id]);

    Livewire::test(Index::class)
        ->set('filters.brand', $this->brand->id)
        ->assertCount('products', 2)
        ->assertDontSee($productInOtherBrand->name);
});

it('should be resets all filters and forgets session', function () {
    session([
        'filters.product' => 'Produto A',
        'filters.category' => $this->category->id,
        'filters.brand' => $this->brand->id,
    ]);

    Livewire::test(Index::class)
        ->call('resetFilters')
        ->assertSet('filters.product', null)
        ->assertSet('filters.category', null)
        ->assertSet('filters.brand', null);

    expect(session('filters.product'))->toBeNull();
});

it('should be saves filters to session when updated', function () {
    Livewire::test(Index::class)
        ->set('filters.product', 'Produto A')
        ->set('filters.category', $this->category->id)
        ->set('filters.brand', $this->brand->id);

    expect(session('filters.product'))->toBe('Produto A');
    expect(session('filters.category'))->toBe($this->category->id);
    expect(session('filters.brand'))->toBe($this->brand->id);
});

it('should be loads filters from session on mount', function () {
    session([
        'filters.product' => 'Produto A',
        'filters.category' => $this->category->id,
        'filters.brand' => $this->brand->id,
    ]);

    Livewire::test(Index::class)
        ->assertSet('filters.product', 'Produto A')
        ->assertSet('filters.category', $this->category->id)
        ->assertSet('filters.brand', $this->brand->id);
});