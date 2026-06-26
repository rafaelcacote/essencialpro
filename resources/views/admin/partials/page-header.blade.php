<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">{{ $title }}</h1>
        @isset($subtitle)
            <p class="admin-page-subtitle">{{ $subtitle }}</p>
        @endisset
        @isset($meta)
            <div class="admin-page-meta">{!! $meta !!}</div>
        @endisset
    </div>
    @if (!empty($actions))
        <div class="admin-page-actions">
            {!! $actions !!}
        </div>
    @endif
</div>
