@extends('layouts.app')
@section('page-specific-css')
<style>
 .prefer  {
     border: 1px solid grey;
     padding:10px 0px;
 }
</style>
@endsection
@section('content')
<div class="container-fluid">
   <div class="row">
       <div class="col-md-12">
            @if (session('status'))
            <div class="alert alert-info alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong><h4>{{ session('status') }}</h4></strong>
            </div>
            @endif
       </div>
       <div class="col-md-12 mb-md-4 prefer">
           <h5 class="text-center">Choose Peference</h5>
       
           <form action="{{route('findpartner.store')}}" method="POST"  enctype="multipart/form-data">
            @csrf
            <div class="row">
        <div class="col-md-1 "></div>
            <div class="col-md-2 ">
                <label for="vol" id="showvalue">:</label><span> In Lakh</span><br>
                <input type="range" id="salarycount" name="salary" min="0" min="1" max="15" value="1"  onchange="getranger(this.value);" required="required">
            </div>
            <div class="col-md-2">
                <select class="form-control" name="jobtype[]"  required="required" multiple>
                    <option value=''>Select Job Type</option>
                    <option value="pvt">Private job</option>
                    <option value="govt">Government Job</option>
                    <option value="business">Business</option> 
                <select>
            </div>

            <div class="col-md-2">
                <select class="form-control" name="familytype[]"  required="required" multiple>
                    <option value=''>Select Family Type</option>
                    <option value="nuclear">Nuclear Family</option>
                    <option value="joint">Joint Family</option> 
                <select>
            </div>
            <div class="col-md-2">
                <select class="form-control" name="manglik" required="required">
                    <option value=''>Are You Manglik ?</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                    <option value="both">both</option>
                <select>
            </div>

            <div class="col-md-2">
               <button class="btn btn-dark">Submit</button>
            </div>
        
        </form>
    </div>
       </div>
    @foreach ( $findpartner as $data)
    <div class="col-md-3">
        <div>
            <img src="{{ asset($data->image) }}" alt="user iamge" height="250" width="100%">
        </div>
        <h1>{{$data->fname}} {{$data->lname}}</h1>
        <ul>
            <div class="li"><b>Job Type </b>:: {{$data->occupation}}</div>
            <div class="li"><b>Gender </b>:: {{$data->gender}}</div>
            <div class="li"><b>Date of Birth </b>:: {{$data->dob}}</div>
            <div class="li"><b>Annual Salary</b>:: {{$data->salary}}Lakh</div>
            <div class="li"><b>Family Type </b>:: {{$data->family_type}}</div>
            <div class="li"><b>Manglik </b>:: {{$data->manglik}}</div>
        </ul>
    </div>
    @endforeach
   </div>
</div>
@section('page-specific-js')
    <script>
        function getranger(val) {
          document.getElementById('showvalue').innerHTML=val; 
        }

    </script>
@endsection
@endsection
