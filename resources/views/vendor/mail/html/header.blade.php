@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'MedLegalSafeKeep')
<img src="{{asset('app-assets/medlegalsafekeeplogo.png')}}" class="logo" alt="MedLegalSafeKeep Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
