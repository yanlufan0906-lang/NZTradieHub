@props([
    'industries',
    'service' => '',
    'location' => '',
    'selectedIndustry' => null,
    'selectedCategory' => null,
    'businessCount' => null,
])

<section class="business-directory-search">
    <div class="page-heading">
        <span>Business Directory</span>
        <h1>Search businesses</h1>
        <p>
            Showing results for
            <strong>{{ $service ?: ($selectedCategory ?: ($selectedIndustry ?: 'all services')) }}</strong>
            @if($location)
                in <strong>{{ $location }}</strong>
            @endif
        </p>
    </div>

    <form action="{{ route('businesses.index') }}" method="GET" class="filter-box">
        <input
            type="text"
            name="service"
            placeholder="Service, keyword, or business name"
            value="{{ $service }}"
        >

        <input
            type="text"
            name="location"
            placeholder="Location or suburb"
            value="{{ $location }}"
        >

        <select name="industry">
            <option value="">All Industries</option>

            @foreach($industries as $industryName => $categories)
                <option value="{{ $industryName }}" {{ $selectedIndustry == $industryName ? 'selected' : '' }}>
                    {{ $industryName }}
                </option>
            @endforeach
        </select>

        <select name="category">
            <option value="">All Categories</option>

            @foreach($industries as $categories)
                @foreach($categories as $category)
                    <option value="{{ $category }}" {{ $selectedCategory == $category ? 'selected' : '' }}>
                        {{ $category }}
                    </option>
                @endforeach
            @endforeach
        </select>

        <button type="submit">Apply Filters</button>
    </form>

    <div class="quick-filter-row">
        <a href="{{ route('businesses.index', ['category' => 'Plumbing', 'location' => 'Auckland']) }}">Plumbers in Auckland</a>
        <a href="{{ route('businesses.index', ['category' => 'Electrical']) }}">Electricians</a>
        <a href="{{ route('businesses.index', ['category' => 'Renovations']) }}">Builders / Renovations</a>
        <a href="{{ route('businesses.index', ['category' => 'Home Cleaning']) }}">Cleaners</a>
        <a href="{{ route('businesses.index', ['service' => 'roof']) }}">Roofing</a>
    </div>

    @if($businessCount !== null)
        <div class="result-summary">
            <span>{{ $businessCount }} business{{ $businessCount === 1 ? '' : 'es' }} found</span>
            <a href="{{ route('businesses.index') }}">Clear filters</a>
        </div>
    @endif
</section>
