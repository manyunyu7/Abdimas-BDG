@if(session() -> has('success'))
<div class="alert alert-primary alert-dismissible fade show mx-2 my-2" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    <strong>{{Session::get( 'success' )}}</strong>
</div>

@elseif(session() -> has('error'))

<div class="alert alert-danger alert-dismissible fade show mx-2 my-2" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    <strong>{{Session::get( 'error' )}}</strong>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>

    {!! implode('', $errors->all('<div>:message</div>')) !!}
</div>
@endif