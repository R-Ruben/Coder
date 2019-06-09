@foreach($post->programming_languages as $p_language)
@if($p_language->name != 'Other')
<div class="p-language-tag">{{$p_language->name}}</div>
@endif
@endforeach