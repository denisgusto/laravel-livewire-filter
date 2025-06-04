<?php

namespace App\Livewire\Products;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    public array $filters = [
        'product' => null,
        'category' => null,
        'brand' => null,
    ];

    public function mount()
    {
        $this->products();
        $this->getSessionFilter();
    }

    public function updatedFilters()
    {
        $this->products();
        $this->setSessionFilter();
    }

    public function resetFilters()
    {
        $this->filters = [
            'product' => null,
            'category' => null,
            'brand' => null,
        ];

        session()->forget('filters');
    }

    public function getSessionFilter()
    {
        $this->filters['product'] = session('filters.product', null);
        $this->filters['category'] = session('filters.category', null);
        $this->filters['brand'] = session('filters.brand', null);
    }

    public function setSessionFilter()
    {
        session([
            'filters.product' => $this->filters['product'],
            'filters.category' => $this->filters['category'],
            'filters.brand' => $this->filters['brand'],
        ]);
    }

    #[Computed()]
    public function categories()
    {
        return Category::all();
    }

    #[Computed()]
    public function brands()
    {
        return Brand::all();
    }

    #[Computed()]
    public function products()
    {
        return Product::query()
            ->when($this->filters['product'], fn ($q) => $q->where('name', 'like', "%{$this->filters['product']}%"))
            ->when($this->filters['category'], fn ($q) => $q->where('category_id', $this->filters['category']))
            ->when($this->filters['brand'], fn ($q) => $q->where('brand_id', $this->filters['brand']))
            ->with(['category', 'brand'])
            ->get();
    }

    public function render()
    {
        return view('livewire.products.index');
    }
}
