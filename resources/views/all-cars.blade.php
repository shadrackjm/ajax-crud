<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crud System - Ajax in Laravel 10</title>
    {{-- add bootstrap css & js & jquery --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
    {{-- lets create a view of a table with list of cars --}}
    <div class="container">
        <div class="card">
            <div class="card-header">Crud System - Ajax in Laravel 10 <button class="btn btn-success btn-sm float-end" data-bs-toggle="modal" data-bs-target="#addModal">add new</button></div>
            {{-- these two spans will display flash messages --}}
            <span class="alert alert-success" id="alert-success" style="display: none;"></span>
            <span class="alert alert-danger" id="alert-danger" style="display: none;"></span>
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
                                    <td><button class="btn btn-primary btn-sm editBtn" data-id="{{$item->id}}" data-name="{{$item->name}}"  data-year="{{$item->manufacture_year}}" data-capacity="{{$item->engine_capacity}}" data-fuel="{{$item->fuel_type}}" data-bs-toggle="modal" data-bs-target="#editModal">edit</button></td>
                                    <td><button class="btn btn-danger btn-sm deleteBtn" data-id="{{$item->id}}" data-name="{{$item->name}}" data-bs-toggle="modal" data-bs-target="#deleteModal">delete</button></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">No Data Found!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- add car Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Car </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          {{-- create a form here.. --}}
          <form id="addCarForm">
            <div class="form-group">
                <label for="">Car Name</label>
                <input type="text" name="name" class="form-control" id="">
                <span id="name_error" class="text-danger"></span>
            </div>
            <div class="form-group">
                <label for="">Manufacture Year</label>
                <input type="number" name="manufacture_year" class="form-control" id="">
                <span id="manufacture_year_error" class="text-danger"></span>
            </div>
            <div class="form-group">
                <label for="">Engine Capacity</label>
                <input type="text" name="engine_capacity" class="form-control" id="">
                <span id="engine_capacity_error" class="text-danger"></span>
            </div>
            <div class="form-group">
                <label for="">Fuel Type</label>
                <input type="text" name="fuel_type" class="form-control" id="">
                <span id="fuel_type_error" class="text-danger"></span>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary addBtn">Save changes</button>
        </div>
        {{-- this is to make sure the save changes button is within form --}}
    </form>
      </div>
    </div>
  </div>
    <!-- edit car Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">edit Car </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              {{-- create a form here.. --}}
              <form id="editCarForm">
                @csrf
                <input type="hidden" id="car_id" name="car_id">
                <div class="form-group">
                    <label for="">Car Name</label>
                    <input type="text" name="name" class="form-control" id="name">
                    <span id="name_error" class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="">Manufacture Year</label>
                    <input type="number" name="manufacture_year" class="form-control" id="manufacture_year">
                    <span id="manufacture_year_error" class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="">Engine Capacity</label>
                    <input type="text" name="engine_capacity" class="form-control" id="engine_capacity">
                    <span id="engine_capacity_error" class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="">Fuel Type</label>
                    <input type="text" name="fuel_type" class="form-control" id="fuel_type">
                    <span id="fuel_type_error" class="text-danger"></span>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary editButton">Save changes</button>
            </div>
            {{-- this is to make sure the save changes button is within form --}}
        </form>
          </div>
        </div>
      </div>
    
  <!-- delete car Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Car </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            Do you really want To delete <p class="car_name"> </p> ?
            {{-- you can customize the way you want to display the message.. --}}
            {{-- the above class of car_name will pass the name of selected car.. --}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger deleteButton">Delete</button>
        </div>
      </div>
    </div>
  </div>
  <script>
        $(document).ready(function(){
            $('#addCarForm').submit(function(e){
                e.preventDefault();
                let formData = $(this).serialize();
                $.ajax({
                    url: '{{ route("addCar")}}',
                    data: formData,
                    contentType: false,
                    processData:false,
                    beforeSend:function(){
                        $('.addBtn').prop('disabled', true);
                    },
                    complete: function(){
                        $('.addBtn').prop('disabled', false);
                    },
                    success: function(data){
                        if(data.success == true){
                            // this is the correct way to close modal
                            $('#addModal').modal('hide');
                            printSuccessMsg(data.msg);
                            var reloadInterval = 5000; //page reload delay duration
                        // Function to reload the whole page
                        function reloadPage() {
                            location.reload(true); // Pass true to force a reload from the server and not from the browser cache
                        }
                        // Set an interval to reload the page after the specified time
                        var intervalId = setInterval(reloadPage, reloadInterval);
                        }else if(data.success == false){
                            printErrorMsg(data.msg);
                        }else{
                            printValidationErrorMsg(data.msg);
                        }
                    }
                });
                return false;
                
            });

            // perform delete functionality here
            $('.deleteBtn').on('click',function(){
                var car_id = $(this).attr('data-id');
                var car_name = $(this).attr('data-name');
                // delete any car name
                $('.car_name').html('');
                // then add the new one..
                $('.car_name').html(car_name);

            });
            $('.deleteButton').on('click',function(){
                var url = "{{ route('deleteCar','car_id')}}";
                url = url.replace('car_id',car_id);

                $.ajax({
                    url: url,
                    type: 'GET',
                    contentType: false,
                    processData:false,
                    beforeSend:function(){
                        $('.deleteButton').prop('disabled', true);
                    },
                    complete: function(){
                        $('.deleteButton').prop('disabled', false);
                    },
                    success: function(data){
                        // leave it as it is..
                        if(data.success == true){
                            // this is the correct way to close modal
                            $('#deleteModal').modal('hide');
                            printSuccessMsg(data.msg);
                            var reloadInterval = 5000; //page reload delay duration
                        // Function to reload the whole page
                        function reloadPage() {
                            location.reload(true); // Pass true to force a reload from the server and not from the browser cache
                        }
                        // Set an interval to reload the page after the specified time
                        var intervalId = setInterval(reloadPage, reloadInterval);
                        }else{
                            printErrorMsg(data.msg);
                        }
                        // this is because in delete functionality we don't have validations..
                    }
                });

            });
            // edit car functionality..
            $('.editBtn').on('click',function(){
                // get all car data that we passed on the edit button
                var car_id = $(this).attr('data-id');
                var car_name = $(this).attr('data-name');
                var year = $(this).attr('data-year');
                var capacity = $(this).attr('data-capacity');
                var fuel = $(this).attr('data-fuel');

                // then display them in a edit form
                $('#name').val(car_name);
                $('#manufacture_year').val(year);
                $('#engine_capacity').val(capacity);
                $('#fuel_type').val(fuel);
                // the car id will be hidden on the edit form so assign it as hidden input
                $('#car_id').val(car_id);
               
            });

             // then submit the form
             $('#editCarForm').submit(function(e){
                    e.preventDefault();
                    let formData = $(this).serialize();
                    $.ajax({
                        url: '{{ route("editCar")}}',
                        data: formData,
                        contentType: false,
                        processData:false,
                        beforeSend:function(){
                            $('.editButton').prop('disabled', true);
                        },
                        complete: function(){
                            $('.editButton').prop('disabled', false);
                        },
                        success: function(data){
                            if(data.success == true){
                                // this is the correct way to close modal
                                $('#editModal').modal('hide');
                                printSuccessMsg(data.msg);
                                var reloadInterval = 5000; //page reload delay duration
                            // Function to reload the whole page
                            function reloadPage() {
                                location.reload(true); // Pass true to force a reload from the server and not from the browser cache
                            }
                            // Set an interval to reload the page after the specified time
                            var intervalId = setInterval(reloadPage, reloadInterval);
                            }else if(data.success == false){
                                printErrorMsg(data.msg);
                            }else{
                                printValidationErrorMsg(data.msg);
                            }
                    }
                    });
                });
            // the three functions for flash messages
            function printValidationErrorMsg(msg){
                $.each(msg, function(field_name, error){
                    // console.log(field_name,error);
                    // this will find a input id for error lets create this
                    $(document).find('#'+field_name+'_error').text(error);
                });
                }
                function printErrorMsg(msg){
                $('#alert-danger').html('');
                $('#alert-danger').css('display','block');
                $('#alert-danger').append(''+msg+'');
                }
                function printSuccessMsg(msg){
                $('#alert-success').html('');
                $('#alert-success').css('display','block');
                $('#alert-success').append(''+msg+'');
                // if form successfully submitted reset form
                document.getElementById('addCarForm').reset();
                }
        });
  </script>



</body>
</html>