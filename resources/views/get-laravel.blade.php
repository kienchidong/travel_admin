
<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
        'baseUrl' => url('/'),
        'router' => collect(\Route::getRoutes())->mapWithKeys(function ($route) { return [$route->getName() => $route->uri()]; }),
    ]) !!};
</script>
