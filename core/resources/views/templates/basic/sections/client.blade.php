@php
    $clientElements = getContent('client.element', false);

@endphp

<div class="client pt-120 pb-60">
    <div class="container">
        <div class="client-logos client-slider">
            @foreach ($clientElements as $item)
            <img src="{{ frontendImage('client', @$item->data_values->image) }}" alt="image">
            @endforeach
        </div>
    </div>
</div>