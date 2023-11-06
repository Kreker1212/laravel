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
            <h1 class="text-3xl font-semibold">{{auth()->user()->name}}</h1> </p>
        </div>
    </div>
    <div class="text">
        <table id="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>surname</th>
                    <th>experience</th>
                </tr>
            </thead>
            <tbody>
                @foreach($doctors as $doctor)
                    <tr id="{{$doctor['id']}}">
                        <td>{{$doctor['id']}}</td>
                        <td id="name" class="dd">{{$doctor['name']}}</td>
                        <td id="surname" class="dd">{{$doctor['surname']}}</td>
                        <td id="experience" class="dd">{{$doctor['experience']}}</td>
                        <th>
                            <form id="update-{{$doctor['id']}}">
                                <input type="hidden" name="id" id="id" value="{{$doctor['id']}}">
                                <button type="submit">Save</button>
                            </form>
                        </th>
                        <th>
                            <form id="delete-{{$doctor['id']}}">
                                <input type="hidden" name="id" id="id" value="{{$doctor['id']}}">
                                <button type="submit">Delete</button>
                            </form>
                        </th>
                        <th>
                            <a href="{{route('view.records', ['id' => $doctor['id']])}}">Date</a>
                        </th>
                    </tr>
                    <script>
                        $('#delete-{{$doctor['id']}}').on('submit', function (event) {
                            event.preventDefault();

                            $.ajax({
                                url: '/admin/doctors/{{$doctor['id']}}',
                                type: "DELETE",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                },
                                success: function (response) {
                                    console.log(response.status);
                                    if (response.status == 'ok') {
                                        $('#{{$doctor['id']}}').remove()
                                    }
                                },
                            });
                        });
                    </script>
                @endforeach
            </tbody>
        </table>
        <h1>Add new Doctor</h1>
        <form id="createForm">
            @csrf
            <p>name</p>
            <input type="text" name="name"><br>
            @error('name')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
            <p>surname</p>
            <input type="text" name="surname"><br>
            @error('surname')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
            <p>experience</p>
            <input type="text" name="experience"> <br>
            @error('experience')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
            <button type="submit">add</button>
        </form>

        <script>

            $('#createForm').on('submit', function (event) {
                event.preventDefault();

                let name = $("input[name*='name']").val();
                let surname = $("input[name*='surname']").val();
                let experience = $("input[name*='experience']").val();

                $.ajax({
                    url: "/admin/admin",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        name: name,
                        surname: surname,
                        experience: experience,
                    },
                    success: function (response) {
                        console.log(response);
                        let tbodyRef = document.getElementById('table').getElementsByTagName('tbody')[0];


                        // Insert a row at the end of table
                        let newRow = tbodyRef.insertRow();

                        // Insert a cell at the end of the row
                        let id = newRow.insertCell();
                        let name = newRow.insertCell();
                        let surname = newRow.insertCell();
                        let experience = newRow.insertCell();

                        // Append a text node to the cell
                        let idText = document.createTextNode(response.id);
                        let nameText = document.createTextNode(response.name);
                        let surnameText = document.createTextNode(response.surname);
                        let experienceText = document.createTextNode(response.experience);


                        id.appendChild(idText);
                        name.appendChild(nameText);
                        surname.appendChild(surnameText);
                        experience.appendChild(experienceText);
                    },
                });
            });
        </script>
    </div>
</main>

<script>

    let tds = document.querySelectorAll('.dd');

    for (let i = 0; i < tds.length; i++) {
        tds[i].addEventListener('click', function func() {
            let input = document.createElement('input');
            input.value = this.innerHTML;
            this.innerHTML = '';
            this.appendChild(input);

            let td = this;
            input.addEventListener('blur', function() {
                td.innerHTML = this.value;

                let fieldName = td.id
                let doctorId = td.parentNode.id

                console.log(fieldName, doctorId, {[fieldName] : this.value,});

                $.ajax({
                    url: '/admin/doctors/' + doctorId,
                    type: "PUT",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        [fieldName] : this.value,
                    },
                    success: function (response){
                        console.log('ок')

                    }
                });
                td.addEventListener('click', func);
            });

            this.removeEventListener('click', func);
        });
    }
</script>

</body>
@endsection
