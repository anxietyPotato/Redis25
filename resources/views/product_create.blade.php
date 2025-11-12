@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<form action="/products/create" method="POST">
    @csrf

    <div>
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" maxlength="64" required>
    </div>

    <div>
        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required></textarea>
    </div>

    <div>
        <label for="price">Price (in cents):</label>
        <input type="number" id="price" name="price" min="0" required>
    </div>

    <button type="submit">Create Product</button>
</form>
