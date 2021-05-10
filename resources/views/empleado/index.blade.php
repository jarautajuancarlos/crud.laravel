<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
  </head>
  <body>


    @if(Session::has('mensaje'))
      {{Session::get('mensaje')}}
    @endif

    <h1>EMPLEADOS/LIST</h1>



    <a href="{{url('empleado/create')}}">Registrar nuevo empleado</a>
    <table class="table table-light">
      <thead class="thead-light">
      <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Correo</th>
        <th>Foto</th>
        <th>Acciones</th>
      </tr>
      </thead>

      <tbody>
        @foreach($empleados as $empleado)
        <tr>
          <td>{{$empleado->id}}</td>
          <td>{{$empleado->Nombre}}</td>
          <td>{{$empleado->Apellido}}</td>
          <td>{{$empleado->Correo}}</td>
          <td>
            <img src="{{asset('storage') . '/' . $empleado->Foto}}" alt="Foto" width="40">
          </td>
          <td>
            <a href="{{url('/empleado/' . $empleado->id . '/edit')}}">Editar</a>
            |
            <form class="" action="{{url('/empleado/' . $empleado->id)}}" method="post">
              @csrf
              {{method_field('DELETE')}}
              <input type="submit" onclick="return confirm('Quieres Borrar')"
              value="Borrar">

            </form>
          </td>
        </tr>
        @endforeach
      </tbody>

    </table>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
  </body>
</html>
