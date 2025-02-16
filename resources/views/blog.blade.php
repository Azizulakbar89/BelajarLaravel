<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    {{-- Pencarian --}}
    <form method="GET">
        <div class="input-group mb-3 mt-5">
            <input type="text" name='title' class="form-control" placeholder="Search" aria-label="Search"
                aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
        </div>
    </form>



    {{-- menampilkan data --}}
    <a href="{{ url('/blog/add') }}" class="btn btn-primary mb-3">Tambah Data</a>

    {{-- message --}}
    @if (Session::has('message'))
        <p class="alert alert-success">{{ Session::get('message') }}</p>
    @endif
    <div class="container">
        <div class="mt-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>No</th>
                        <th>Title</th>
                        <th>Actions</th>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($blogs as $data)
                            <tr>
                                <td>{{ ($blogs->currentpage() - 1) * $blogs->perpage() + $loop->index + 1 }}</td>
                                <td>{{ $data->title }}</td>
                                <td> <a href="{{ url('blog/' . $data->id . '/detail') }}">View</a> |
                                    <a href="{{ url('blog/' . $data->id . '/edit') }}">Edit</a> |
                                    <a href="{{ url('blog/' . $data->id . '/delete') }}">Delete</a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $blogs->links() }}
            </div>
        </div>

    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>
