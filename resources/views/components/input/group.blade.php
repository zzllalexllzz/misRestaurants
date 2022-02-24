 @props([
 'label' => false,
 'for' =>false,
 'error' => false
 ])

 <div {{ $attributes }} class="form-group">
     <label for="{{ $for }}">{{ $label }}</label>
     {{ $slot }}

     @if ($error)
         <div class="alert alert-danger p-0">{{ $error }}</div>
     @endif
 </div>
