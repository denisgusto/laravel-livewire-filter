    <div class="min-h-screen flex justify-center bg-gray-100 px-4">
        <div class="w-full max-w-4xl pt-5">

            <div class="flex justify-between">
                <h1 class="text-3xl mb-4 tracking-wider">Produtos</h1>

                {{-- Limpar filtros --}}
                <div class="flex items-center gap-2">
                    <button wire:click="resetFilters" class="px-4 py-2 text-sm text-white bg-red-500 rounded hover:bg-red-600">
                        Limpar Filtros
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-3">
                {{-- Filtros de nome do produto --}}
                <div>
                    <label class="block text-xs font-medium text-gray-700">Nome do produto:</label>
                    <input type="text" wire:model.live="filters.product" placeholder="Ex: Notebook" class="text-sm mt-1 p-2 block w-full rounded border-gray-300 bg-white shadow-sm">
                </div>

                {{-- Filtros de categorias --}}
                <div>
                    <label class="block text-xs font-medium text-gray-700">Categorias:</label>
                    <select wire:model.live="filters.category" class="mt-1 block w-full rounded border-gray-300 shadow-sm bg-white p-2">
                        @if(empty($filters['category']))
                        <option hidden>Selecione uma categoria</option>
                        @endif


                        @foreach($this->categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $filters['category'] ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Filtros de marcas --}}
                <div>
                    <label class="block text-xs font-medium text-gray-700">Marcas:</label>
                    <select wire:model.live="filters.brand" class="mt-1 block w-full rounded border-gray-300 shadow-sm bg-white p-2">
                        @if(empty($filters['brand']))
                        <option hidden>Selecione uma marca</option>
                        @endif

                        @foreach($this->brands as $brand)
                        <option value="{{ $brand->id }}" {{ $brand->id == $filters['brand'] ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Tabela de produtos --}}
            <div class="mt-5 overflow-hidden shadow ring-1 ring-gray-300 ring-opacity-5 sm:rounded-2xl bg-white">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Nome</th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Preço</th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Categoria</th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Marca</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($this->products as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $product->name }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $product->category->name }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $product->brand->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
