<x-layout>
    <x-slot:title>
        Update Stock
        </x-slot>

        <h3>Update Stock ({{ $merchantProductNumber }})</h3>

        <div class="col-md-6">
            <form method="POST" action="/update-stock/{{ $merchantProductNumber }}">
                @csrf
                <div class="form-group">
                    <label>New stock amount</label>
                    <input class="form-control" />
                </div>
                <button type="submit" class="btn btn-primary">Update</button>

            </form>
        </div>

</x-layout>