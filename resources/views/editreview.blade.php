<!-- resources/views/editreview.blade.php -->
@extends('app')
@section('title')
{{$user->name}}
@endsection
@section('content')
<form method="POST" action="/new-review">
    {!! csrf_field() !!}

    <div>
        Titulo de tu cultivo
        <input type="text" name="title" value="{{ old('title') }}">
    </div>

    <div>
      Banco
      <input type="text" name="bank" value="{{ ('bank') }}">
    </div>

    <div>
        Tipo de Cultivo
          <select name="state">
            <option value="{{ ('state') }}">Hidroponico</option>
            <option value="{{ ('state') }}">interior</option>
            <option value="{{ ('state') }}">Exterior</option>
            <option value="{{ ('state') }}">Otro</option>
        </select>
    </div>

      <div>
          Cepas
            <div>
              Nombre
              <input type="text" name="strain_name" value="{{ ('strain_name') }}">
            </div>
            <div>
                Tipo de semilla
                <select name="type">
                  <option value="{{ ('type') }}">Feminizada</option>
                  <option value="{{ ('type') }}">Automatica</option>
                  <option value="{{ ('type') }}">Regular</option>
                </select>
              </div>
              <div>
                tecnica de poda
                <select name="technique">
                  <option value="{{ ('technique') }}">Apical</option>
                  <option value="{{ ('technique') }}">F.I.M.</option>
                  <option value="{{ ('technique') }}">Lollypop</option>
                  <option value="{{ ('technique') }}">Lst</option>
                  <option value="{{ ('technique') }}">Otra</option>
                  <option value="{{ ('technique') }}">Ninguna</option>
                </select>
              </div>
              <div>
                <input type="date" name="germ_date" value="{{ ('germ_date') }}">
              </div>
              <div>
                <input type="date" name="veg_start" value="{{ ('veg_start') }}">
              </div>
              <div>
                <input type="date" name="flow_start" value="{{ ('flow_start') }}">
              </div>
              <div>
                <input type="date" name="harvest_date" value="{{ ('harvest_date') }}">
              </div>
          </div>



    <div>
        <button type="submit">Create</button>
    </div>
</form>
@endsection
