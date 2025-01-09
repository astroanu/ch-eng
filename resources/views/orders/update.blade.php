<x-layout>
    <x-slot:title>
        Update Stock
        </x-slot>

        <h3>Update Stock ({{ $merchantProductNumber }})</h3>

        <div class="col-md-6">
            <form method="POST" action="/update-stock/{{ $merchantProductNumber }}">
                @csrf
                <div class="form-group">
                    <label>Stock Location Id</label>
                    <input require maxlength="10" type="number" value="2" name="stockLocationId" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Stock amount</label>
                    <input require maxlength="3" type="number" value="25" name="stockAmount" class="form-control" />
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="/" class="btn btn-link">Cancel</a>

            </form>
        </div>

</x-layout>