<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pagination in Laravel 10</title>
    {{-- add bootstrap css & js & jquery --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    {{-- lets create a view of a table with list of cars --}}
    <div class="container">
        <div class="card">
            <div class="card-header">Pagination in Laravel 10 <button class="btn btn-success btn-sm float-end" data-bs-toggle="modal" data-bs-target="#addModal">add new</button></div>
            <div class="card-body">
                <table class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Car Name</th>
                            <th>Manufacture Year</th>
                            <th>Engine Capacity</th>
                            <th>Fuel Type</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- pass data from database here --}}
                        @if (count($all_cars) > 0)
                            @foreach ($all_cars as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->manufacture_year}}</td>
                                    <td>{{$item->engine_capacity}}</td>
                                    <td>{{$item->fuel_type}}</td>
                                    <td><button class="btn btn-primary btn-sm editBtn" data-id="{{$item->id}}" data-name="{{$item->name}}" data-year="{{$item->manufacture_year}}" data-capacity="{{$item->engine_capacity}}" data-fuel="{{$item->fuel_type}}" data-bs-toggle="modal" data-bs-target="#editModal">edit</button></td>
                                    <td><button class="btn btn-danger btn-sm deleteBtn" data-id="{{$item->id}}" data-bs-toggle="modal" data-bs-target="#deleteModal">delete</button></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">No Data Found!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{-- here add the links --}}
                {{$all_cars->links()}}
            </div>
        </div>
    </div>