
<span class="switch switch-icon">
		<label>
			<input type="checkbox"
                   {{$instance->is_active?'checked':''}}
                   data-url="{{ route('panel.courses.lectures.operation' , ['id'=>$instance->course_id , 'l_id' => $instance->id ]) }}"
                   class="operation">
			<span></span>
		</label>
</span>



