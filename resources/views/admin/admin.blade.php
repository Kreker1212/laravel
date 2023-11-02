<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <title>Admin</title>
    <style>
        table {
            font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
            font-size: 14px;
            border-radius: 10px;
            border-spacing: 0;
            text-align: center;
        }

        th {
            background: #009d11;
            color: white;
            text-shadow: 0 1px 1px #2D2020;
            padding: 10px 20px;
        }

        th, td {
            border-style: solid;
            border-width: 0 1px 1px 0;
            border-color: white;
        }

        th:first-child, td:first-child {
            text-align: left;
        }

        th:first-child {
            border-top-left-radius: 10px;
        }

        th:last-child {
            border-top-right-radius: 10px;
            border-right: none;
        }

        td {
            padding: 10px 20px;
            background: #939393;
        }

        tr:last-child td:first-child {
            border-radius: 0 0 0 10px;
        }

        tr:last-child td:last-child {
            border-radius: 0 0 10px 0;
        }

        tr td:last-child {
            border-right: none;
        }

        .text {
            text-align: center;
        }

    </style>
</head>
<body class="min-h-screen bg-gray-50 bg-[url('/wave.svg')] bg-fixed bg-bottom bg-no-repeat">
<header class="flex items-center justify-between p-6">
    <a href="{{route('welcome')}}" class="flex items-center gap-2">
        <svg class="h-10 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path fill-rule="evenodd"
                  d="M12.516 2.17a.75.75 0 00-1.032 0 11.209 11.209 0 01-7.877 3.08.75.75 0 00-.722.515A12.74 12.74 0 002.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 00.374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 00-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08zm3.094 8.016a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                  clip-rule="evenodd"/>
        </svg>
        <span class="text-xl font-black">Doctor</span>
    </a>
    <div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();"
               class="rounded-md bg-gray-200 py-2 px-4 font-semibold text-gray-900 shadow-lg transition duration-150 ease-in-out hover:bg-gray-300 hover:shadow-xl focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2">Log
                0ut</a>
        </form>
    </div>
</header>
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
</html>
