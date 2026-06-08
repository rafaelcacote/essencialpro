@props([
    'title',
    'subtitle' => null,
    'tag' => 'h2',
    'size' => 'default',
    'align' => 'center',
    'dashes' => true,
    'accentWord' => null,
    'inverse' => false,
])

@php
    $normalizedTitle = trim((string) $title);
    $words = preg_split('/\s+/u', $normalizedTitle, -1, PREG_SPLIT_NO_EMPTY);

    if ($accentWord !== null) {
        $accent = trim((string) $accentWord);
        $main = trim(implode(' ', array_values(array_filter(
            $words,
            fn (string $word): bool => $word !== $accent
        ))));
    } elseif (count($words) > 1) {
        $accent = array_pop($words);
        $main = implode(' ', $words);
    } else {
        $accent = $words[0] ?? '';
        $main = '';
    }
    $sizeClass = $size === 'sm' ? ' section-heading--sm' : '';
    $alignClass = $align === 'left' ? ' section-heading--left' : '';
    $noDashesClass = ! $dashes ? ' section-heading--no-dashes' : '';
    $inverseClass = $inverse ? ' section-heading--inverse' : '';
@endphp

<div {{ $attributes->merge(['class' => 'section-heading' . $sizeClass . $alignClass . $noDashesClass . $inverseClass]) }}>
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
