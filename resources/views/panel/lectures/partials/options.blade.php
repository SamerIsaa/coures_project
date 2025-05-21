<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="{{route('panel.courses.lectures.edit',[$instance->course_id,$instance->id])}}"
   title="@lang('constants.edit')"><i class="flaticon2-edit"></i> </a>
<a class="btn btn-sm btn-clean btn-icon btn-icon-md delete" href=""
   data-url="{{route('panel.courses.lectures.destroy',[$instance->course_id,$instance->id])}}" title="@lang('constants.delete')"><i
        class="flaticon2-delete"></i> </a>
