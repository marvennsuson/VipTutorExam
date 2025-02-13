<h1>New Product Created</h1>

<p>A new product has been created:</p>

<p><strong>Name:</strong> {{ $product->name }}</p>
<p><strong>Description:</strong> {{ $product->description }}</p>
<p><strong>Price:</strong> {{ $product->price }}</p>

<p>View the product: <a href="{{ route('user.products.show', $product->id) }}">Link</a> (Adjust route as needed)</p>
