<h2>Latest Products</h2>

<ul>
    @foreach ($products as $product)
        <li>
            <strong>{{ $product->name }}</strong><br>
            {{ $product->description }}<br>
            Price: {{ $product->price }}<br>
            Added: {{ $product->created_at->format('Y-m-d H:i') }}
        </li>
    @endforeach
</ul>
