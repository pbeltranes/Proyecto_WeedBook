<!-- resources/views/editreview.blade.php -->
@extends('app')
@section('title')
{{$user->name}}
@endsection
@section('content')
<form method="POST" action="/review/edit/save">
    {!! csrf_field() !!}

    <div>
        Titulo de tu cultivo
        <input type="title" name="title" value="{{ old('title') }}">
    </div>

    <div>
        Tipo de Cultivo
          <select name="state">
            <option value="hidroponico">Hidroponico</option>
            <option value="interior">interior</option>
            <option value="exterior" selected>Exterior</option>
            <option value="otro">Otro</option>
        </select>
    </div>

      <div>
          Cepas
            <div>
              Nombre
              <input type="strain_name" name="strain_name" value="Nombre de cepa">
            </div>
            <div>
                Tipo de semilla
                <select name="Variedad">
                  <option value="feminizada">Feminizada</option>
                  <option value="automatica">Automatica</option>
                  <option value="regular" selected>Regular</option>
                </select>
              </div>
              <div>
                tecnica de poda
                <select name="technique">
                  <option value="Apical">Feminizada</option>
                  <option value="fim">F.I.M.</option>
                  <option value="lollypop" selected>Lollypop</option>
                  <option value="lst" selected>Lst</option>
                  <option value="otra" selected>Otra</option>
                  <option value="ninguna">Ninguna</option>
                </select>
              </div>
              <div>
                <input type="date" name="germ_date">
              </div>
              <div>
                <input type="date" name="veg_start">
              </div>
              <div>
                <input type="date" name="flow_start">
              </div>
              <div>
                <input type="date" name="harvest_date">
              </div>
          </div>



    <div>
        <button type="submit">Login</button>
    </div>
</form>
@endsection
