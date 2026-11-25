@php
$background_images = array(
    "f44336",
    "E91E63",
    "9C27B0",
    "673AB7",
    "3F51B5",
    "2196F3",
    "03A9F4",
    "00BCD4",
    "009688",
    "4CAF50",
    "8BC34A",
    "CDDC39",
    "FFC107",
    "FF9800",
    "FF5722",
);
$random_keys=array_rand($background_images);
@endphp


@if($image == null)
<img src="https://ui-avatars.com/api/?name={{$name}}&color=000&background={{$background_images[$random_keys]}}" alt="">
@else
<img src="{{url('/thumbnail/70/70/80/storage/user_images/'.$image)}}" alt="">
@endif
