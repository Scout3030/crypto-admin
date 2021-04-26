@if($counter > 0 && $counter <= 99)
<span id="notification-counter" class="numberNoti">{{ $counter }}</span>
@elseif($counter > 99)
<span id="notification-counter" class="numberNoti">+99</span>
@else
<span id="notification-counter" class="numberNoti d-none">{{ $counter }}</span>
@endif

