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

<!-- Test if data is coming through -->

			<div class="col-md-8">
				<div class="col-md-10">
					<h3> Menu </h3>
				</div>
				<div class="col-md-10">
					<h3> Carousel </h3>
				</div>
				<div class="col-md-10">
					<h3> Modules </h3>
					{{ $layoutmodules }}
				</div>
				<div class="col-md-10">
					<h3> introduction </h3>
					{{ $intro }}
				</div>

				<div class="col-md-10">
					<h3> News </h3>
					{{ $news }}
				</div>
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
@endsection