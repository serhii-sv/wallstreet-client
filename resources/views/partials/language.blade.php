<div class="language">
    <p class="language__name"><span>{{ !empty(session('language')) ? session('language') : 'ru' }}</span></p>
    <ul class="language__list">
        @foreach($languages as $lang)
        <li class="language__item">
            <a href="{{ route('set.lang', ['locale' => $lang->code]) }}"><button class="language__button">{{ $lang->name }}</button></a>
        </li>
        @endforeach
    </ul>
</div>
