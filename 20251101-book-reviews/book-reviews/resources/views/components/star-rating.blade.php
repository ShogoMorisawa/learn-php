@if ($rating)
    @for ($i = 1; $i <= 5; $i++)
        <span class="text-yellow-400">{{ $i <= round($rating) ? '★' : '☆' }}</span>
    @endfor
@else
    <span class="text-gray-400">No rating yet</span>
@endif
