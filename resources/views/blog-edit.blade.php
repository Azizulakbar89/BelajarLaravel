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
    <div class="container">
        <div class="mt-5">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ url('/blog/' . $blog->id . '/up') }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="col-md-6">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title"
                        value="{{ $blog->title }}">
                </div>
                <div class="col-md-6">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="description" id="desc-textarea">{{ $blog->description }}"</textarea>
                </div>
                <div class="col-md-6 mt-3">
                    <button class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
