@if($counter > 0 && $counter <= 99)
<span class="numberNoti">{{ $counter }}</span>
@elseif($counter > 99)
<span class="numberNoti">+99</span>
@else
<span class="numberNoti d-none">{{ $counter }}</span>
@endif

