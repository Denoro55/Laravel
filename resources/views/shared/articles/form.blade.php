@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form__block">
    {{Form::text('name', 'Title')}}
</div>
<div class="form__block">
    {{Form::textarea('body', 'Body')}}
</div>