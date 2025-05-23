@extends('panel.layout.master' , ['title' => __('panel.lectures')])
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        @php
            $item = isset($item) ? $item: null;
        @endphp

        <div class="container">
            <form method="POST" action="{{ url()->current() }}" to="{{ url()->current() }}" class="form-horizontal"
                  id="form">
                @csrf
                @if(isset($item))
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="col-md-8">
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b ">

                            <!--begin::Form-->
                            <div class="card-body">



                                @foreach(locales() as $key => $lang)
                                    <div class="form-group">
                                        <label>{{ __('constants.title') }} ({{ $lang }})
                                            <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="title_{{$key}}"
                                               value="{{isset($item)?@$item->translate($key)->title:''}}"
                                               required/>
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('constants.description') }}({{ $lang }})</label>
                                        <textarea class="form-control" name="description_{{$key}}" rows="5"
                                                  >{{isset($item)?@$item->translate($key)->description:''}}</textarea>
                                    </div>


                                @endforeach


                                    <div class="form-group">
                                        <label>{{ __('panel.youtube') }}
                                            <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="video_link"
                                               value="{{isset($item)?@$item->video_link:''}}"
                                               required/>
                                    </div>



                            </div>
                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="card card-custom gutter-b">
                            <div class="card-footer">
                                <button type="submit" id="m_login_signin_submit"
                                        class="btn btn-primary mr-2 w-100">@lang('constants.save')
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>

        </div>

    </div>
@endsection


@push('panel_js')
    <script src="{{ asset('panelAssets/js/post.js') }}"></script>
@endpush
