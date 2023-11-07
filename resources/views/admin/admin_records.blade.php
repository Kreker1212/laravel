@extends('layouts.site_admin')

@section('title')
    Admin
@endsection

@section('content')
<main>
    <div class="m-6 mb-12 rounded-xl p-6 shadow-xl sm:p-10">
        <h1 class="text-3xl font-semibold">Admin</h1>
        <div class="text">
            <svg class="mx-auto h-12 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>

            <p>
            <h1 class="text-3xl font-semibold">Records</h1> </p>
        </div>
    </div>
    <div class="text">
        <table>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
            <pre>
                @foreach($records as $record)
                    <tr>
                <td>{{$record['id']}}</td>
                <td>{{$record['date']}}</td>
                <td>{{$record['time']}}</td>
                <td><a>Update</a></td>
                <td><form method="POST" action="{{route('record.delete', ['id' => $record['id']])}}">
                        @csrf
                        {{ method_field('DELETE') }}
                        <div class="form-group">
                            <input type="submit" class="btn btn-danger delete-record" value="delete">
                        </div>
                </form></td>
                @endforeach
            </tr>
        </pre>
        </table>
        <h1>Add new Record</h1>
        <form action="{{route('record.create', ['id' => $id])}}" method="post">
            @csrf
            <p>Date</p>
            <input type="date" name="date">
            <p>Time</p>
            <input type="time" name="time"><br>
            <button type="submit">add</button>
        </form>
    </div>
</main>
@endsection
