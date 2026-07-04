@if($errors AND count($errors))
	<div class="cls" role="alert">
		<div class="alert alert-warning">
			<ul>
				@foreach($errors->all() as $err)
					<li> {{ $err }}</li>
				@endforeach
			</ul>
		</div>
	</div>
	<style type="text/css">
		.cls {
		    -moz-animation: cssAnimation 0s ease-in 5s forwards;
		    /* Firefox */
		    -webkit-animation: cssAnimation 0s ease-in 5s forwards;
		    /* Safari and Chrome */
		    -o-animation: cssAnimation 0s ease-in 5s forwards;
		    /* Opera */
		    animation: cssAnimation 0s ease-in 5s forwards;
		    -webkit-animation-fill-mode: forwards;
		    animation-fill-mode: forwards;

		}
		.alert {
		    position: relative;
		    padding: .75rem 1.25rem;
		    margin-bottom: 1rem;
		    border: 1px solid transparent;
		    border-radius: .55rem;
		}
		@keyframes cssAnimation {
		    to {
		        width:0;
		        height:0;
		        overflow:hidden;
		    }
		}
		@-webkit-keyframes cssAnimation {
		    to {
		        width:0;
		        height:0;
		        visibility:hidden;
		    }
		}
	</style>
@endif