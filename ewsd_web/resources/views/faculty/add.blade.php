<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <style>
    /* Forms */
    [type=text],
    [type=email],
    [type=url],
    select,
    textarea {
    display: block;
    padding: .5rem;
    background: transparent;
    vertical-align: middle;
    width: 100%;
    max-width: 100%;
    border: 1px solid #cdcdcd;
    border-radius: 4px;
    font-size: .95rem;
    }

    [type=text]:focus,
    [type=email]:focus,
    [type=url]:focus,
    select:focus,
    textarea:focus {
    outline: none;
    border: 1px solid #1E6BD6;
    } 

    select {
    -webkit-appearance: none;
    -moz-appearance: none;
    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAAJCAYAAAA/33wPAAAAvklEQVQoFY2QMQqEMBBFv7ERa/EMXkGw11K8QbDXzuN4BHv7QO6ifUgj7v4UAdlVM8Uwf+b9YZJISnlqrfEUZVlinucnBGKaJgghbiHOyLyFKIoCbdvecpyReYvo/Ma2bajrGtbaC58kCdZ1RZ7nl/4/4d5EsO/7nzl7IUtodBexMMagaRrs+06JLMvcNWmaOv2W/C/TMAyD58dxROgSmvxFFMdxoOs6lliWBXEcuzokXRbRoJRyvqqqQvye+QDMDz1D6yuj9wAAAABJRU5ErkJggg==) 100% no-repeat;
    line-height: 1
    }

    label {
    font-weight: 600;
    font-size: .9rem;
    display: block;
    margin: .5rem 0;
    }

    /* Other */

    * { box-sizing: border-box; }

    html {
    -webkit-font-smoothing: antialiased;
    padding: 1rem;
    }

    .container {
    max-width: 600px;
    margin: 0 auto;
    padding: 0 1rem;
    }


    /* Button */

    [type=submit] {
    display: inline-block;
    vertical-align: middle;
    white-space: nowrap;
    cursor: pointer;
    margin: .25rem 0;
    padding: .5rem 1rem;
    border: 1px solid #1E6BD6;
    border-radius: 18px;
    background: #1E6BD6;
    color: white;
    font-weight: 600;
    text-decoration: none;
    font-family: sans-serif;
    font-size: .95rem;
    }
    </style>
    <body>
        <div style="margin:0 auto; text-align:center; color:#fff; background:red;">
            @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
            @endif
        </div>
     
        <div class="container">
            <form action="{{route('faculty.save')}}" method="POST">
            @csrf
                <label for="name">Faculty Name</label>
                <input type="text" id="name" name="name" placeholder="Name">
                <label for="message">About Faculty</label>
                <textarea id="message" name="desc" cols="30" rows="10" placeholder="Message"></textarea>
                <input type="submit" value="Add New Faculty">
            </form>
            <a href="{{route('faculty')}}"><button>Back</button></a>
        </div>
    </body>
</html>
