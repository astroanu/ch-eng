<x-layout>
    <x-slot:title>
        Top Ten Products
    </x-slot>

        <h3>Top Ten Products</h3>

        <table class="table table-sm">
            <thead>
                <tr>
                    <th>GTIN</th>
                    <th>Product Name</th>
                    <th>Count</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($topProducts as $product)
                <tr>
                    <td>{{ $product['gtin'] }}</td>
                    <td>{{ $product['productName'] }}</td>
                    <td>{{ $product['count'] }}</td>
                    <td><a class="btn btn-link" href="">Update Stock</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

</x-layout>