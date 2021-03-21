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
        <label for="vendor" class="form-label">Vendor</label>
        <select class="form-select" name="vendor" id="vendor" aria-label="Select vendor" required>
            <option selected>Open this select menu</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>
    </div>

    <div class="mb-3">
        <button class="btn btn-primary" type="submit">Submit form</button>
    </div>
</form>
</div>
