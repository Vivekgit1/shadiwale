@extends('layouts.app')
@section('page-specific-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center h1 text-danger">{{ __('Register To Shadiwale') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" id="form-id" enctype="multipart/form-data" onsubmit="validateFunction(event)">
                        @csrf
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <div class="form-group row">
                            <div class="col-md-6 mb-4">
                                <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" required autocomplete="fname" autofocus placeholder="Enter First Name">
                                @error('fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <input id="lname" type="text" placeholder="Enter Last Name" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}" required autocomplete="lname" autofocus>
                                @error('lname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4 pl-md-4">
                                  <div class="form-check-inline">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input gender"  value="male" name="gender">Male
                                    </label>
                                  </div>
                                  <div class="form-check-inline">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input gender" value="female" name="gender">Female
                                    </label>
                                  </div>
                                  @error('gender')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <input id="email" type="email" placeholder ="Enter Your Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <input id="password" placeholder="Create Password" maxlength="15" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <input id="password-confirm" placeholder="Confirm Password" maxlength="15" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <div class="col-md-6 mb-4">
                                <input type="text" id="dob" placeholder="Select Birthdate" name="dob" required="required" data-toggle="tooltip" title="Date should be ahead of current date" placeholder="Select Date" class="form-control" data-date-end-date="0d" data-date-format="yyyy-mm-dd">
                                <div class="input-group-addon">
                                    <span><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                @error('dob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <select class="selectoption form-control" id="occupation" name="occupation" selected required="required"> 
                                    <option value=''>Select Job Type</option>
                                    <option value="pvt">Private job</option>
                                    <option value="govt">Government Job</option>
                                    <option value="business">Business</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-4">
                                <select class="selectoption form-control" id="family-type" name="family_type" selected required="required"> 
                                    <option value=''>Select Family Type</option>
                                    <option value="nuclear">Nuclear Family</option>
                                    <option value="joint">Joint Family</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-4">
                                <select class="selectoption form-control" id="manglik" name="manglik" selected required="required"> 
                                    <option value=''>Are You Manglik ?</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-4">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" pattern="[1-9]+" placeholder="Enter Your Annual Salary" id="salary"  title="Decimal and Character's are not allowed,Zero is not allowed.EX:: Type 1 as 1 lakh" required="required" name="salary">
                                    <div class="input-group-append">
                                    <span class="input-group-text">Salary in lakh</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="image">Image</label><br>
                                    <input type="file" id="image" name="image" onchange="readURL(this);" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <img id="preview-user-image" scr="">
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <div class="form-check">
                                    <input type="checkbox" id="terms" name="terms" class="form-check-input" required="required" value="1">&nbsp;<span class="text-danger">*</span> {{_('I agree to the')}} <span class="text-danger">{{_('Terms and Conditions')}} </span>and <span class="text-danger">{{_('Privacy Policy')}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-3">
                                <button type="submit" class="btn btn-primary form-control">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@section('page-specific-js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
<script>
$("#dob").datepicker();
$('.selectoption').select2({
});
function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview-user-image')
                        .attr('src', e.target.result)
                        .width(160)
                        .height(80);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

function validateFunction(e) {
    e.preventDefault();
 
    let password        = $("#password").val();
    let confirmpassword = $("#password-confirm").val();
    let gender          = $(".gender").val();
    let dob             = $("#dob").val();
    let occupation      = $("#occupation").val();
    let manglik         = $("#manglik").val();
    let terms           = $("#terms").val();
    let image           = $("#image").val();
    let family_type     = $("#family-type").val();
    let salary          = $("#salary").val();

    if (password == '' || confirmpassword == '' || gender == '' || dob == ''|| occupation == ''|| manglik == ''|| terms == ''|| image == ''|| family_type == ''|| salary == '') {
        alert('Please Fill All Fileds');
        return false;
    }else if(password != confirmpassword){
        alert('Password does not macth try again');
        return false;
    }else if(dob){
        let birthYear = new Date(dob);
        let todayYear = new Date();
        let countYear = todayYear.getFullYear(); - birthYear.getFullYear();;
        if(countYear < 18){
            alert('Person Age Should be more than 18 year.')
            return false;
        }
        document.getElementById("form-id").submit();
    }
    };
</script>
@endsection  
@endsection
