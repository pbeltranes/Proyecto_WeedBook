@extends('app')
@section('title')
{{ $user->name }}
@endsection
@section('content')
<div>
  <ul class="list-group">
    <li class="list-group-item">
      Joined on {{$user->created_at->format('M d,Y \a\t h:i a') }}
    </li>
    <li class="list-group-item panel-body">
      <table class="table-padding">
        <style>
          .table-padding td{
            padding: 3px 8px;
          }
        </style>
        <tr>
          <td>Review Rep</td>
          <td> {{$prom_rev_rep}}</td>
          
        </tr>
      </table>
    </li>
    <li class="list-group-item">
      Comment Rep {{$prom_comments_rep}}
    </li>
  </ul>
</div>
@endsection