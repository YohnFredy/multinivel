<div>
    <div class=" w-full text-palette-200 dark:text-palette-30" x-data="{ openCategoryId: null, openSubcategoryId: null }" x-cloak>
        <p class="text-palette-400 dark:text-white ">Categorías</p>
        <ul class="divide-y-2 mt-2">
            @foreach ($categories as $category)
                <div wire:key="{{ $category->id }}">
                    <li class="ml-3">
                        @if (count($category->children) > 0)
                            <div>
                                <button
                                    class="w-full hover:bg-palette-20 focus:bg-palette-10 dark:hover:bg-palette-50  dark:focus:bg-palette-60 px-2"
                                    type="button"
                                    x-on:click="openCategoryId = (openCategoryId === {{ $category->id }} ? null : {{ $category->id }})">
                                    <span x-show="openCategoryId !== {{ $category->id }}"
                                        class="flex items-center justify-between">
                                        <span>{{ $category->name }}</span>
                                        <i
                                            class="text-palette-500 dark:text-palette-30 text-xs fas fa-chevron-right"></i>
                                    </span>
                                    <span x-show="openCategoryId === {{ $category->id }}"
                                        class="font-bold text-palette-200 dark:text-white flex items-center justify-between">
                                        {{ $category->name }}
                                        <i class="text-palette-400 dark:text-white text-xs fas fa-chevron-down"></i>
                                    </span>
                                </button>

                                <div x-show="openCategoryId === {{ $category->id }}" x-collapse>
                                    <ul class="divide-y-2 text-palette-300 dark:text-palette-30">
                                        @foreach ($category->children as $subcategory)
                                            <div wire:key="{{ $subcategory->id }}">
                                                <li class="ml-3">
                                                    @if (count($subcategory->children) > 0)
                                                        <div>
                                                            <button
                                                                class="w-full hover:bg-palette-20 focus:bg-palette-10 dark:hover:bg-palette-50 dark:focus:bg-palette-60 px-2"
                                                                type="button"
                                                                x-on:click="openSubcategoryId = (openSubcategoryId === {{ $subcategory->id }} ? null : {{ $subcategory->id }})">
                                                                <span
                                                                    x-show="openSubcategoryId !== {{ $subcategory->id }}"
                                                                    class="flex items-center justify-between">
                                                                    <span>{{ $subcategory->name }}</span>
                                                                    <i
                                                                        class="text-palette-500 dark:text-palette-30 text-xs fas fa-chevron-right"></i>
                                                                </span>
                                                                <span
                                                                    x-show="openSubcategoryId === {{ $subcategory->id }}"
                                                                    class="font-bold text-palette-300 dark:text-white flex items-center justify-between">
                                                                    {{ $subcategory->name }}
                                                                    <i
                                                                        class="text-palette-400 dark:text-white text-xs fas fa-chevron-down"></i>
                                                                </span>
                                                            </button>

                                                            <div x-show="openSubcategoryId === {{ $subcategory->id }}"
                                                                x-collapse>
                                                                <ul
                                                                    class="divide-y-2  text-palette-200 dark:text-white">
                                                                    @foreach ($subcategory->children as $subsubcategory)
                                                                        <div wire:key="{{ $subsubcategory->id }}">
                                                                            <li class="ml-3">
                                                                                <button
                                                                                    wire:click="category({{ $subsubcategory->id }})"
                                                                                    class="w-full text-left hover:bg-palette-20 focus:bg-palette-10 dark:hover:bg-palette-50  dark:focus:bg-palette-60 px-2"
                                                                                    type="button">
                                                                                    {{ $subsubcategory->name }}
                                                                                </button>
                                                                            </li>
                                                                        </div>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <button wire:click="category({{ $subcategory->id }})"
                                                            class="w-full text-left font-medium hover:bg-palette-20 focus:bg-palette-10 dark:hover:bg-palette-50  dark:focus:bg-palette-60 px-2"
                                                            type="button">
                                                            {{ $subcategory->name }}
                                                        </button>
                                                    @endif
                                                </li>
                                            </div>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @else
                            <button wire:click="category({{ $category->id }})"
                                class=" w-full text-left hover:bg-palette-20 focus:bg-palette-10 dark:hover:bg-palette-50 dark:focus:bg-palette-60 px-2"
                                type="button">
                                {{ $category->name }}
                            </button>
                        @endif
                    </li>
                </div>
            @endforeach
        </ul>

        <p class="text-palette-400 dark:text-white mt-6 ">Marcas</p>
        <ul class="divide-y-2 mt-2">
            @foreach ($brands as $brand)
                <li class="ml-3">
                    <button
                        class=" w-full text-left hover:bg-palette-20 focus:bg-palette-10 dark:hover:bg-palette-50 dark:focus:bg-palette-60 px-2"
                        type="button">
                        {{ $brand->name }}
                    </button>
                </li>
            @endforeach

        </ul>
    </div>

</div>
