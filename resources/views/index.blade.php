<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">PKL UNAIR</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Application Request</a>
                </li>
                <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Request Reply
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @if ($applications)
                                @foreach ($applications as $application)
                                <li><a class="dropdown-item" href="/application/reply/{{ $application->id }}">{{ $application->application_no }}</a></li>    
                                @endforeach
                            @endif
                            
                        </ul>
                </li>
            </ul>

            </div>
        </div>
    </nav>
    <div class="container mt-3 mb-4">
        <h3>Application for Certification</h3>
        <div class="row">
            <div class="col-lg-10">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="/application/store" method="post">
                @csrf
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <span style="display: block">Business Unit: </span>
                            <select class="form-select" id="BusinessUnit" name="business_unit_id">
                                <option value="" selected>Select Business Unit</option>
                                @foreach ($businessUnits as $businessUnit)
                                    @if ($businessUnit->id == old('business_unit_id'))
                                        <option value="{{ $businessUnit->id }}" selected>{{ $businessUnit->name }}</option>
                                    @else
                                        <option value="{{ $businessUnit->id }}">{{ $businessUnit->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('business_unit_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col">
                            <span class="d-block">Name of Requestor</span>
                            <input type="text" name="requestor_name" class="form-control" value="{{ old('requestor_name') }}">
                            @error('requestor_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <span>Application Type</span>
                    <select class="form-select" id="ApplicationType" name="application_type_id">
                        <option value="" selected>Select Application Type</option>
                        @foreach ($applicationTypes as $applicationType)
                            @if ($applicationType->id == old('application_type_id'))
                            <option value="{{ $applicationType->id }}" selected>{{ $applicationType->name }}</option>
                            @else
                            <option value="{{ $applicationType->id }}">{{ $applicationType->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('application_type_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <span class="d-block">Date of Request</span>
                    <input type="date" name="application_date_created" class="form-control" id="date">
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <span class="d-block">Product Type: </span>
                            <select class="form-select" id="productType" name="product_type_id">
                                <option value="" selected>Select Product Type</option>
                                @foreach ($productTypes as $productType)
                                    <option value="{{ $productType->id }}">{{ $productType->name }}</option>
                                @endforeach
                            </select>
                            @error('product_type_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col">
                            <span class="d-block">Type: </span>
                            <select class="form-select" id="productTypeCategory" name="product_type_category_id">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-3 input-container">
                    <span>Product Description </span>
                    <div class="row mt-3 input-description">
                        <div class="col-lg-2">
                            <small class="product">Product 1</small>
                        </div>
                        <div class="col-lg-10 d-flex justify-content-between">
                            <input type="text" class="form-control" name="product_no[]" style="width: 92%" required>
                        </div>
                        @error('product_no')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>
                </div>
                <div class="d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-warning btn-add-description">Add Description</button>
                    </div>
                <button type="submit" class="btn btn-primary" id="submit">Submit</button>
            </form>
            </div>
        </div>
    </div>

</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){

            $('#date').on('click',function(){
                console.log($(this).val());
            });
            // ADD INPUT 
            $('.btn-add-description').on('click',function(){
                $('.input-container').append(
                    `   
                    <div class="row mt-3 input-description">
                        <div class="col-lg-2">
                            <small class="product">Product 1</small>
                        </div>
                        <div class="col-lg-10 d-flex justify-content-between align-items-center">
                            <input type="text" class="form-control" name="product_no[]" style="width: 92%" required>
                            <a href="" class="remove-input badge bg-danger d-flex justify-content-center align-items-center text-decoration-none" style="min-width: 30px; height:20px" onclick='confirm("Are you sure to delete this product?")'>X</a>
                        </div>
                        @error('product_no')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>`
                )
                // Update Index Input
                Array.from(document.querySelectorAll('.input-container small.product')).forEach(function(el,index){
                    el.innerHTML = "Product " + (index +1);
                });
            })
            // END Add Input

            // Delete Input
            $('.input-container').on('click','.remove-input',function(e){
                e.preventDefault();
                $(this).parent('div').parent('div').remove();
                Array.from(document.querySelectorAll('.input-container small.product')).forEach(function(el,index){
                    el.innerHTML = "Product " + (index +1);
                });
            })
            // End Delete Input

            // Default Date
            function pad2(n) {
            return (n < 10 ? '0' : '') + n;
            }

            let date = new Date();
            var month = pad2(date.getMonth()+1);
            var day = pad2(date.getDate());
            var year = date.getFullYear();
            $('#date').val(`${year}-${month}-${day}`);
            // End Default Date 

            //  Product Type
            $('#productType').on('change', function(){
                let productType = $(this).val(); 
                // user dont select 
                if(productType == ""){
                    $('#productTypeCategory').prop('disabled', true);
                    $('#productTypeCategory').html('')
                }else{
                    fetch('/application/getProductTypeCategory?productType=' + productType)
                    .then(response => response.json())
                    .then(result => {
                        $('#productTypeCategory').html('');
                        if(result.data.length > 0){
                            $('#productTypeCategory').prop('disabled', false);
                            result.data.forEach(element => {
                            $('#productTypeCategory').append(`
                            <option value="${element.id}">${element.name}</option>`)
                            });
                        }else{
                            $('#productTypeCategory').prop('disabled', true);
                        }
                    });
                }

            })
            // Product Type End
            
            // Product Check
            $('.input-container').on('change','input',function(){
                fetch('/application/checkProductNo?productNo=' + $(this).val())
                    .then(response => response.json())
                    .then(result => {
                        if(result.isExist){
                            $(this).parent('div').parent('div').append(`
                                <small class='error text-danger'>product already exist</small>
                            `)
                        }else{
                            $(this).parent('div').parent('div').children('small').remove();
                        }
                        let error = document.querySelector('.error');
                        if(error){
                            $("#submit"). attr("disabled", true);
                        }else{
                            $("#submit"). attr("disabled", false);
                        }
                    })
            })
            // Product Check End
        })
    </script>
</html>