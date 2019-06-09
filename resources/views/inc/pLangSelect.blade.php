@foreach($pLanguages as $pLanguage)
            <div>
                <input type="checkbox" class="toggle_{{$pLanguage->cName}}"
                    onchange="togglePLanguage('{{$pLanguage->cName}}')" checked>
                <label>{{$pLanguage->name}}</label>
            </div>
            @endforeach