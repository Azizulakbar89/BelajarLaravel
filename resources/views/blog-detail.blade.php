<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="mt-5">
            <div class="table-responsive">


                <tr>
                    <td>{{ $blog->title }}</td>
                    <td>{{ $blog->description }}</td>

                </tr>


            </div>
        </div>
        {{-- 1-M --}}
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

            @if (Session::has('message'))
                <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif
            <form action="{{ url('comment/' . $blog->id) }}" method="POST">
                @csrf
                <textarea class="form-control" name="comment_text" id=""></textarea>
                <button class="btn btn-primary" type="submit">Submit

                </button>
            </form>
        </div>


        <br>
        <div class="mt-5">
            @foreach ($blog->comments as $data)
                <li>{{ $data->comment_text }}</li>
            @endforeach
        </div>
        {{-- 1-M --}}
    </div>
</body>

</html>
