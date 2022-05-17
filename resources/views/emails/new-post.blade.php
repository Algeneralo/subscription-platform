@component('mail::message')
# New Post has been published!

New Post "{{$post->title}}"
@component('mail::button', ['url' => '#'])
Read More
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
