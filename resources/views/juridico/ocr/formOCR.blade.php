@extends('juridico.juridico')
                
@section('content')
<br>
@if (Session::has('success'))
	<div class="alert alert-success">
		{{Session::get('success')}}
	</div><br>
@endif 
@if (Session::has('error'))
	<div class="alert alert-danger">
		{{Session::get('error')}}
	</div><br>
@endif 

<div class="row">
	<div class="col-xs-12">
		
		<div class="panel panel-success text-muted">
			<div class="panel-heading">
				<h4><i class="fas fa-wrench"></i> Reconocimineto de texto - OCR</h4>				
			</div>
			<div class="panel-body">
				<form method="POST" action="{{ route('ocr.write') }}" class="form-horizontal" enctype="multipart/form-data">
					@csrf
					<input type="file" name="archivo" required>
			</div>
			<div class="panel-footer">
					<button type="submit" class="btn btn-success btn-block"><i class="fas fa-check"></i> Confirmar</button>
				</form>
			</div>
		</div>
		
		@if (Session::has('resultado'))
			<div>
				<textarea id="summernote" class="form-control" rows="10" name="texto">
					{{Session::get('resultado')}}
				</textarea>
			</div><br>
		@endif 
	</div>
		
</div>

<script>
      $('#summernote').summernote({
        placeholder: 'Texto del contenido',
        tabsize: 2,
        height: 100,
		toolbar: [
			// [groupName, [list of button]]
			['style', ['bold', 'italic', 'underline', 'clear']],
			['font', ['strikethrough', 'superscript', 'subscript']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']]
		  ]
      });
    </script>
@endsection