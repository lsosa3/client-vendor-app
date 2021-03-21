<link rel="stylesheet" href="{{ asset('css/app.css')  }}">
<div class="container" style="width:50%">
    <h1 class="bd-title">List request</h1>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Client</th>
              <th scope="col">Date</th>
              <th scope="col">Description</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($clientRequests as $clientRequest)
                <tr>
                    <td> {{ $loop->index + 1 }} </td>
                    <td> {{ $clientRequest->client_id }} </td>
                    <td> {{ $clientRequest->created_at }} </td>
                    <td> {{ $clientRequest->description }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
