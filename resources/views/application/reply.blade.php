<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
                    <a class="nav-link" aria-current="page" href="/">Application Request</a>
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
    <div class="container mt-3">
        <h3>Application For Certification</h3>
        <div class="row">
            <div class="col-lg-10">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
                <div class="row">
                    <div class="col-3">
                        <p>Number</p>
                        <p>Date Created</p>
                        <p>Name Of Requestor</p>
                        <p>Business Unit</p>
                        <p>Application Type</p>
                        <p>Product Type</p>
                        <p>Type</p>
                        <p>Detail Specification</p>
                        
                    </div>
                    <div class="col">
                        <p>{{ $app->application_no }}</p>
                        <p>{{ $app->application_date_created }}</p>
                        <p>{{ $app->requestor_name}}</p>
                        <p>{{ $app->business->name}}</p>
                        <p>{{ $app->appType->name}}</p>
                        <p>{{ $app->productType->name}}</p>
                        <p>{{ $app->productTypeCategory->name}}</p>
                        @foreach ($app->products as $product)
                            <p>{{ $product->product_no}}</p>
                        @endforeach
                    </div>
                </div>
                {{--     protected $fillable = ['product_type_id','application_type_id','product_type_category_id','requestor_name','business_unit_id','application_date_created','application_no']; --}}
                <form action="/application/update" method="post">
                    @csrf
                <input type="hidden" name="application_id" value="{{ $app->id }}">
                <div class="row">
                    <div class="col-3">
                        <p>Due Date Submit Document</p>
                    </div>
                    <div class="col">
                        <input type="date" class="form-control" name="document_due_date" value="{{ $app->document_due_date?? '' }}" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col d-flex justify-content-end">
                        <button type="submit" class="btn btn-success" style="min-width:30%">Save</button>
                    </div>
                </div>
                </form>

                <span class="d-block mt-4">Requirement Document</span>
                <form action="/email/{{ $app->id }}" method="post">
                <div class="email">
                        @csrf
                    <div class="row mt-2 mb-6">
                        <div class="col-3">
                            <span class="index">Document 1</span>
                        </div>
                        <div class="col-8">
                            <div class="row mb-2">
                            <div class="col">
                                <input type="text" class="form-control input-document" placeholder="ex:Drawing" name="document[]">
                            </div>
                            </div>
                            <div class="row mt-3">
                                <span class="d-block">Forward To:</span>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <span>Business Unit:</span>
                                    <select class="form-select businessUnitId" name="business_unit_id[]">
                                        <option value="" selected>Select Business Unit</option>
                                        @foreach ($businessUnits as $bu)
                                            <option value="{{ $bu->id }}">{{ $bu->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <span>PIC:</span>
                                    <select class="form-select userId" name="user_id[]" required>
                            
                                    </select>
                                </div>
                                <div class="col-3">
                                    <span>Due Date:</span>
                                    <input type="date" class="form-control" name="due_date_document[]" required>
                                </div>
                            </div>
                        </div>
                        <hr class="mt-3">
                    </div>    
                </div>


                <div class="row mt-3">
                    <div class="col d-flex justify-content-end">
                        <button type="button" id="btnAdd" class="btn btn-warning" name="btn-add" style="min-width: 30%">Add Requirement Document</button>
                    </div>
                </div>
                <div class="row"></div>
                <div class="row">
                </div>

                <div class="row mt-5 mb-3 d-flex justify-content-center">
                    <div class="col-6 ">
                        <button type="submit" class="btn btn-primary" style="min-width:100%">Send Email</button>
                    </div>
                </form>
                </div>
                
            </div>
        </div>
    </div>
</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
            // Init index for PIC input 
            Array.from(document.querySelectorAll('.userId')).forEach(function(el,index){
                    el.classList.add("userId-" + (index+1));
            });

            // When bu change -> get PIC
            $('.email').on('change','.businessUnitId',function(e){
                // get index userId
                let indexInputPIC = $(this).parent('div').siblings('div').children('select').attr('class');
                indexInputPIC = indexInputPIC.split(" ").pop();
                indexInputPIC = indexInputPIC.split('-').pop();
                console.log(indexInputPIC);

                let buId = $(this).val()

                fetch('/application/getUser?buId=' + buId)
                    .then(response => response.json())
                    .then(result => {
                        $('.userId-'+indexInputPIC).html('');
                        if(result.isExist){
                            $(this).parent('div').siblings('div').children('select').prop('disabled', false);
                            result.users.forEach(function(user){
                                $('.userId-'+indexInputPIC).append('<option value="'+user.id+'">'+user.email+'</option>')
                            });
                        }else{
                            $(this).parent('div').siblings('div').children('select').prop('disabled', true);
                        }
                    })
                    e.stopPropagation();
            })


            // Add Document
            $('#btnAdd').on('click',function(){
                $('.email').append(`
                    <div class="row mt-2 mb-6">
                        <div class="col-3">
                            <span class="index">Document 1</span>
                        </div>
                        <div class="col">
                            <div class="row mb-2">
                            <div class="col">
                                <input type="text" class="form-control input-document" placeholder="ex:Drawing" name="document[]">
                            </div>
                            </div>
                            <div class="row mt-3">
                                <span class="d-block">Forward To:</span>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <span>Business Unit:</span>
                                    <select class="form-select businessUnitId" name="business_unit_id[]" required>
                                        <option value="" selected>Select Business Unit</option>
                                        @foreach ($businessUnits as $bu)
                                            <option value="{{ $bu->id }}">{{ $bu->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <span>PIC:</span>
                                    <select class="form-select userId" name="user_id[]" required>
                            
                                    </select>
                                </div>
                                <div class="col-3">
                                    <span>Due Date:</span>
                                    <input type="date" class="form-control" name="due_date_document[]" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-1">
                            <a href="" id="remove"class="badge bg-danger text-decoration-none">X</a>
                        </div>
                        <hr class="mt-3">

                    </div>
                `);
                Array.from(document.querySelectorAll('span.index')).forEach(function(el,index){
                    el.innerHTML= 'Document ' + (index+1);
                });
                Array.from(document.querySelectorAll('.userId')).forEach(function(el,index){
                    el.classList.add("userId-" + (index+1));
                });
            })
            // End Document

            // Delete Document
            $('.email').on('click','#remove',function(e){
                e.preventDefault();
                $(this).parent('div').parent('div').remove();
                Array.from(document.querySelectorAll('span.index')).forEach(function(el,index){
                    el.innerHTML= 'Document ' + (index+1);
                });
                Array.from(document.querySelectorAll('.userId')).forEach(function(el,index){
                    el.classList.add("userId-" + (index+1));
                });
                
            })
            // End Document

        })
    </script>
</html>