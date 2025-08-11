   @if (Session::has('message'))
       <div class="bg-green-200 border-green-200 px-2 py-4 mb-3 rounded-sm shadow-sm">
           {{ Session::get('message') }}
       </div>
   @endif

   @if (Session::has('delete'))
       <div class="bg-green-500 border-green-200 px-2 py-4 mb-3 rounded-sm shadow-sm">
           {{ Session::get('delete') }}
       </div>
   @endif
