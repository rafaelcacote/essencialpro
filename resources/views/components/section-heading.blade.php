@props([
    'title',
    'subtitle' => null,
    'tag' => 'h2',
    'size' => 'default',
    'align' => 'center',
    'dashes' => true,
    'accentWord' => null,
])

@php
    $words = preg_split('/\s+/u', trim((string) $title), -1, PREG_SPLIT_NO_EMPTY);
    $accent = $accentWord ?? (count($words) > 1 ? array_pop($words) : ($words[0] ?? ''));
    $main = count($words) > 1 ? implode(' ', $words) : '';
    $sizeClass = $size === 'sm' ? ' section-heading--sm' : '';
    $alignClass = $align === 'left' ? ' section-heading--left' : '';
    $noDashesClass = ! $dashes ? ' section-heading--no-dashes' : '';
@endphp

<div {{ $attributes->merge(['class' => 'section-heading' . $sizeClass . $alignClass . $noDashesClass]) }}>
    <{{ $tag }} class="section-heading__title">
        @if ($dashes)
            <span class="section-heading__dash" aria-hidden="true"></span>
        @endif
        <span class="section-heading__text">
            @if ($main !== '')
                <span class="section-heading__main">{{ $main }} </span>
            @endif
            <span class="section-heading__accent">{{ $accent }}</span>
        </span>
        @if ($dashes)
            <span class="section-heading__dash" aria-hidden="true"></span>
        @endif
    </{{ $tag }}>
    @if ($subtitle)
        <p class="section-heading__subtitle">{{ $subtitle }}</p>
    @endif
</div>
