<div class="d-sm-flex align-items-center justify-content-between mb-4">

    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Sheet</a>
    <!-- Topbar Search -->
    <form
        method = "GET"
        action="{{ route($searchRoute) }}"
        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="search" name = "search" class="form-control bg-light border-0 small" placeholder="Search {{ $title }} info..."
                   aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>
    <a href="{{ route($route) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-user fa-sm text-white-50"></i> Create {{ $title }}</a>
</div>
