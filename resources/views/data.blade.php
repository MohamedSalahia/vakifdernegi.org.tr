<label for="permissions">@lang('site.doctors_services') <span class="text-danger">*</span></label>

<div class="checkbox-inline">
    @foreach($doctor_services as $d_service)
        <label class="checkbox">
            <input value="{{$d_service->id}}" type="checkbox" name="doctor_services[]">
            <span></span>{{$d_service->name}}</label>
    @endforeach

</div>