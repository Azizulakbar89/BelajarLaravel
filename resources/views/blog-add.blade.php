<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Add</title>
</head>

<body>
    <div class="container">
        <div class="mt-5">
            {{-- view Validasi --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('/blog/create') }}" method="POST">
                @csrf
                <div class="col-md-6">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title"
                        value="{{ old('title') }}">
                </div>
                <div class="col-md-6">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="description" id="desc-textarea"></textarea>
                </div>
                {{-- tags --}}
                <div class="col-md-6">
                    <label for="name" class="form-label">Tag:</label>
                    @foreach ($tags as $key => $tag)
                        <input type="checkbox" name="tags[]" id="tag{{ $key }}" value="{{ $tag->id }}">
                        <label class="form-check-label" for="tag{{ $key }}">
                            {{ $tag->name }}
                        </label>
                    @endforeach
                    </input>
                </div>
                <div class="col-md-6 mt-3">
                    <button class="btn btn-success">Save</button>
                </div>
            </form>

        </div>
    </div>
</body>

</html>
