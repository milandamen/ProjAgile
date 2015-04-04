@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Home</div>
                    <div class="panel-body">
                        You are logged in!

                 


                    </div>

	@include('modulesidebar')
<!-- Test if data is coming through -->

				<div class="col-md-10">
					<h3> Sidebar </h3>
					{{ $sidebar }}
				</div>


				<div class="col-md-10">
					<h3> Footer </h3>
					{{ $footer }}
				</div>




			</div>	
<!-- end test incoming data -->

                </div>


            </div>
        </div>
    </div>
@stop