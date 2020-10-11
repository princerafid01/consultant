<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
{{-- @if (trim($slot) === 'Laravel') --}}
<img src="{{ config('app.url') }}/public/frontend/img/interface/logo.png" alt="Geek logo" class="logo">
{{-- @else --}}
{{-- {{ $slot }}
@endif --}}
</a>
</td>
</tr>
