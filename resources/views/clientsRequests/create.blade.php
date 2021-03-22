<link rel="stylesheet" href="{{ asset('css/app.css')  }}">
<div class="container" style="width:50%">

<h1 class="bd-title">Create request</h1>
@if (\Session::has('type'))
    <div class="alert alert-{!! \Session::get('type') !!}">
        <ul>
            <li>{!! \Session::get('msg') !!}</li>
        </ul>
    </div>
@endif
<hr>
<form action="/store" method="POST">
    @csrf
    <div class="mb-3">
        <label for="description" class="form-label">Service description</label>
        <input type="text" class="form-control" name="description" id="description" placeholder="" required>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="text" class="form-control" name="price" id="price" placeholder="" value="500.00" readonly>
    </div>

    <div class="mb-3">
        <label for="vendor" class="form-label">Client</label>
        <select class="form-select" name="client" id="client" aria-label="Select client" required>
            <option selected>Select</option>
            @foreach ($clients as $client)
                <option value="{{ $client->id }}">{{ $client->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="vendor" class="form-label">Vendor</label>
        <select class="form-select" name="vendor" id="vendor" aria-label="Select vendor" required>
            <option selected>Select</option>
            @foreach ($vendors as $vendor)
                <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <button class="btn btn-primary" type="submit">Submit form</button>
    </div>
</form>
</div>
