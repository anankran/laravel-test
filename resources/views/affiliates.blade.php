<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Affiliates list</title>
  </head>
  <body class="antialiased">
    <div class="container-md">
      <h1 class="display-6" style="margin-top: 0.8em;">Affiliates confraternization</h1>
      <p>List of affiliates the lives closer than 100km.</p>
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          @foreach ($affiliates as $affiliate)
          <tr>
            <td>{{ $affiliate->id }}</td>
            <td>{{ $affiliate->name }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </body>
</html>