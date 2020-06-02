<!DOCTYPE html>
<html>
<head>
	<title>Upload Image</title>
	{{-- Bootstrap UI CDN --}}
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	{{-- Sweet Alert CDN --}}
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>
<body>
	@include('sweetalert::alert')
	<div class="row">
		<div class="container">
			<h2 class="text-center my-5">Test Upload Gambar Laravel</h2>
			
			<div class="col-lg-8 mx-auto my-5">	

				@if(count($errors) > 0)
				<div class="alert alert-danger">
					@foreach ($errors->all() as $error)
					{{ $error }} <br/>
					@endforeach
				</div>
				@endif

				<form action="/upload/proses" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}

					<div class="form-group">
						<b>File Gambar</b><br/>
						<input type="file" name="file">
					</div>

					<div class="form-group">
						<b>Description</b>
						<textarea class="form-control" name="keterangan"></textarea>
					</div>

					<input type="submit" value="Upload" class="btn btn-primary">
                </form>
                
                <h4 class="my-5">Data</h4>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="1%">File</th>
                            <th>Description</th>
                            <th width="1%">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($images as $img)
                            <tr>
                                <td>
                                    <img width="150px" src="{{ url('/data_file/'.$img->file) }}" alt="">
                                </td>
                                <td>
                                    {{ $img->keterangan }}
                                </td>
                                <td>
									<button type="button" class="btn btn-danger" data-imgid={{ $img->id }} data-toggle="modal" data-target="#confirmModal" >Delete</button>
								</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
			</div>

			<!-- Modal -->
			<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLable" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="confirmModalLabel">Delete Confirmation</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
				  </div>
					<form action="{{ route('upload.delete', 'test') }}" method="POST">
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
					  <div class="modal-body text-center">
						  Are you sure, delete this images ?
						  <input type="hidden" name="images_id" id="img_id" value="">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
							<button type="submit" class="btn btn-danger">
								Yes, Delete it!
							</button>
							{{-- <a type="button" class="btn btn-danger" href="/upload/delete/{{ $img->id }}"class="btn btn-primary">Delete</a> --}}
						</div>
					</form>
			    </div>
			  </div>
			</div>
		</div>
	</div>
{{-- https://www.youtube.com/watch?v=DAitIOhxOOA&t=301s --}}
<script>
	$('#confirmModal').on('show.bs.modal', function (event){
		var button = $(event.relatedTarget)
		var img_id = button.data('imgid')
		var modal = $(this)
		modal.find('.modal-body #img_id').val(img_id);
	})
</script>
</body>
</html>