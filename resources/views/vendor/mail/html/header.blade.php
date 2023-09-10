@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
{{-- <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo"> --}}
<img src="{{asset('frontend/assets/images/demos/demo13/logo.png')}}" alt="Laravel Logo" width="145" />
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
