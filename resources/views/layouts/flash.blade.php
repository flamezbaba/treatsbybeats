@if(isset($_SESSION['notification']))
    {!! $_SESSION['notification'] !!}
    @php unset($_SESSION['notification']) @endphp
@endif

@if ($message = Session::get('success'))
<div class="alert alert-success"> 
    {!! $message !!} 
 </div>
@endif
  
@if ($message = Session::get('error'))
<div class="alert alert-danger"> <i class="fa fa-warning"></i> 
    {!! $message !!} 
 </div>
@endif
   
@if ($message = Session::get('warning'))
<div class="alert alert-danger"> <i class="fa fa-warning"></i> 
    {!! $message !!} 
 </div>
@endif
   
@if ($message = Session::get('info'))
<div class="alert alert-primary"> 
    {!! $message !!} 
 </div>
@endif
  

<div class="form-group">
   @if ($errors->any())

      @foreach ($errors->all() as $error)
       <div class="alert alert-danger"> <i class="fa fa-warning"></i> 
         Error: {!! $error !!}
       </div>

      @endforeach

  @endif
</div>

