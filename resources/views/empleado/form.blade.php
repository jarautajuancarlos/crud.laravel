<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>{{$modo}} Empleado</h1>
    <label for="Foto"></label>
      @if(isset($empleado->Foto))
        <img src="{{asset('storage') . '/' . $empleado->Foto}}" alt="Foto" width="40">
      @else
        <!-- <img src="/public/uploads/nofotook.jpeg" alt="Foto" width="40"> -->
      @endif
    <br>

    <label for="Nombre">Nombre: </label>
    <input type="text" name="Nombre"
    value="{{isset($empleado->Nombre) ? $empleado->Nombre : '' }}" id="Nombre">
    <br>

    <label for="Apellido">Apellido: </label>
    <input type="text" name="Apellido"
    value="{{isset($empleado->Apellido) ? $empleado->Apellido : ''}}" id="Apellido">
    <br>

    <label for="Correo">Correo: </label>
    <input type="text" name="Correo"
    value="{{isset($empleado->Correo) ? $empleado->Correo : ''}}" id="Correo">
    <br>
    <br>

    <input type="file" name="Foto" value="" id="Foto">
    <br>

    <input type="submit" value="{{$modo}} datos">
    <br>
    <a href="{{url('empleado/')}}">Regresar</a>
  </body>
</html>
