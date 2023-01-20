<div>
  <ul>
     @foreach($products as $product) {
       <li>{{ $product->name }} | <a href="{{ route('products.edit', ['product' => $product->id]) }}">Edit</a></li>
     @endforeach
  </ul>
</div>