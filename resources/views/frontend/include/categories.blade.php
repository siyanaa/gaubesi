<style>
    .buttonborder {
        border-bottom: 2px solid forestgreen;
        padding: 1rem 0;
    }
    .subcato, .subcato1 {
        border: 1px solid var(--border-color);
        cursor: pointer;
    }
    .subcatoactive, .subcatoactive1 {
        background: var(--pure-black);
        color: var(--pure-white);
    }
</style>

<section class="container-fluid py-4 categoriessection">
    <div class="container">
        <div class="title">
            <h1 class="lg-texts">Details View <span class="greenhighlight">Category</span></h1>
            <p class="xs-text-md greenhighlight">Shop online for new arrivals and get healthy shipping!</p>
        </div>
        
        @foreach($categories as $category)
        <div class="col-12 py-4">
            <div class="row buttonborder">
                <p class="md-text col-md-3 yellowhighlight p-0 m-0">{{ $category->title }}</p>
                <div class="col-md-8 row p-0 m-0 rounded gap-3">
                    <div class="d-flex col-md-12 gap-md-1 gap-2 flex-wrap p-0 m-0">
                        @foreach($category->subcategories as $index => $subcategory)
                        <p class="xs-text col-md-2 col-5 subcato {{ $index == 0 ? 'subcatoactive' : '' }} rounded text-center"
                           data-id="subcategory_{{ $subcategory->id }}"
                           onclick="showSubCategory(this)">
                            {{ $subcategory->title }}
                        </p>
                        @endforeach
                    </div>
                    @foreach($category->subcategories as $index => $subcategory)
                    <div class="py-2 col-md-12 {{ $index == 0 ? '' : 'd-none' }}" id="subcategory_{{ $subcategory->id }}">
                        <div class="row d-flex flex-wrap">
                            @foreach($subcategory->products as $product)
                            <div class="col-md-3 col-6 d-flex align-items-center mb-3">
                                <a href="{{ route('singleproducts', ['id' => $product->id]) }}" 
                                   style="text-decoration: none; color: inherit;">
                                    <img src="{{ asset('' . $product->mainImagePath) }}" 
                                         alt="{{ $product->title }}" 
                                         class="smimage">
                                    <div class="mx-2">
                                        <p class="xs-text-md p-0 m-0">{{ $product->title }}</p>
                                        <p class="xs-text-md p-0 m-0 yellowhighlight">Rs <span>{{ $product->selling_price }}</span></p>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<script>
    function showSubCategory(element) {
    
    const parentCategory = element.closest('.row');

    // Remove active class from all subcategory buttons in the current category
    parentCategory.querySelectorAll('.subcato').forEach(item => item.classList.remove('subcatoactive'));

    // Hide all subcategory sections in the current category
    parentCategory.querySelectorAll('[id^="subcategory_"]').forEach(section => section.classList.add('d-none'));

    // Add active class to the clicked subcategory button
    element.classList.add('subcatoactive');

    // Show the product section for the clicked subcategory
    const subcategoryId = element.getAttribute('data-id');
    const subcategorySection = parentCategory.querySelector(`#${subcategoryId}`);
    subcategorySection.classList.remove('d-none');
}

</script>
