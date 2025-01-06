@if(!empty($time))
	@foreach($time as $timevalue)
		<div class="portlet-body">
			<div class="overview">
				<div class="over-date">
					<span>{{$timevalue[0]->date}}</span>
				</div>
				@foreach($timevalue as $data)               
					<div class="overview-item edited">
						<div class="overview-data">
							<div class="work-type"></div>
								<span class="view-person">
									<img src="{{$data->image}}"/>
								</span>
								<span class="view-action"></span>
								@if($data->chrRecordDelete == 'Y')
									<span>                          
										{!!$data->notification!!}
									</span>
								@else
									<a class="task-link" href="{{$data->alias}}">
										{!!$data->notification!!}
									</a>
								@endif
							</div>
							<div class="task-edit-date">
								<span>{{$data->time_elapsed}}</span>
							</div>
						</div>  
					@endforeach                                   
				</div>
			</div>
	@endforeach
@else
	<div class="portlet-body">
		<div class="overview-item edited">
			<div class="overview-data">
				<center>
					<span>
					{{ trans('template.notificationisnotavailable')}}
					</span>
				</center>
			</div>
		</div>  
	</div>
@endif