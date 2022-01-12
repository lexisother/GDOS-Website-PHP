<div class="issue-data-item">
    <div class="issue-data-item-header">{{ $header }}</div>
    <div class="issue-data-item-content">
        @isset ($image)
            <img src="{{ $image }}" alt="{{ $imageAlt }}" class="issue-data-item-image">
        @endif
        {{ $content }}
    </div>
</div>
