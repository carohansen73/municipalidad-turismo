<p class="text-muted">NOTA: Los campos con * son obligatorios.</p>
<div class="row">
    <!-- Title Field -->
    <div class="form-group col-sm-6">
        {!! Field::text('title', null, ['label' => 'Título *', 'autofocus', 'data-validation' => 'required length', 'data-validation-length' => '1-60']) !!}
    </div>

    <!-- Important Image Field -->
    <div class="form-group col-sm-6">
        @if(Request::is('posts/crear'))
            {!! Field::file('important_image', ['label' => 'Imagen destacada *', 'data-validation' => 'required mime', 'data-validation-allowing' => 'jpg, jpeg, png, bmp, svg']) !!}
        @else
            {!! Field::file('important_image', ['label' => 'Imagen destacada *', 'data-validation' => 'mime', 'data-validation-allowing' => 'jpg, jpeg, png, bmp, svg']) !!}
        @endif
    </div>
</div>

<div class="row">
    <!-- Summary Field -->
    <div class="form-group col-sm-6">
        {!! Field::text('summary', null, ['label' => 'Resumen *', 'data-validation' => 'required length', 'data-validation-length' => '1-160']) !!}
    </div>

    <!-- Publication Date Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('publication_date', 'Fecha de Publicación *') !!}
        {!! Form::text('publication_date', null, ['class' => 'form-control','id'=>'publication_date', 'data-validation' => 'required length', 'data-validation-length' => '1-19']) !!}
    </div>
</div>



<div class="row">
    <!-- Content Field -->
    <div class="form-group col-sm-12 col-lg-12">
        <script>
            tinymce.init({
              selector: 'textarea',
              plugins: [
                // Core editing features
                'anchor'//, 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount'
                // Your account includes a free trial of TinyMCE premium features
                // Try the most popular premium features until Oct 4, 2024:
               // 'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
              ],
              toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
              tinycomments_mode: 'embedded',
              tinycomments_author: 'Author name',
              mergetags_list: [
                { value: 'First.Name', title: 'First Name' },
                { value: 'Email', title: 'Email' },
              ],
              ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
            });
          </script>

        {!! Form::label('Contenido *') !!}
        {!! Form::textarea('content', null, ['class' => 'form-control my-editor','id'=>'mytextarea', 'data-validation' => 'required']) !!}
    </div>
</div>

<div class="row">
    <!-- Post Category Id Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('Categoría *') !!}
        {!! Form::select('post_category_id', $post_categories, null, ['label' => 'Categoría *', 'placeholder' => '- Selecciona una categoría -', 'data-validation' => 'required']) !!}
    </div>

    <div class="form-group col-sm-6">
        {!! Field::select('post_tag_id[]', $post_tags, $my_tags, ['label' => 'Tags', 'multiple']) !!}
    </div>
</div>

<div class="row">
    <!-- Important Image Field -->
    <div class="form-group col-sm-12">
        {!! Field::file('galery[]', ['label' => 'Agregar galería de imágenes', 'multiple' => 'multiple', 'data-validation' => 'mime', 'data-validation-allowing' => 'jpg, jpeg, png, bmp, svg']) !!}
    </div>
</div>

<div class="row">
    <!-- 'bootstrap / Toggle Switch Publish Field' -->
    <div class="d-flex align-items-center form-group col-sm-6">
        {!! Form::label('publish', 'Publicar') !!}
        <label class="switch switch-label switch-pill switch-primary  ml-2">
            {!! Form::hidden('publish', 0) !!}
            {!! Form::checkbox('publish', 1, null,  ['class' => 'switch-input']) !!}
            <span class="switch-slider" data-checked="Si" data-unchecked="No"></span>
        </label>
    </div>

    <!-- 'bootstrap / Toggle Switch Publish Field' -->
    <div class="d-flex align-items-center form-group col-sm-6">
        {!! Form::label('signature_author', 'Firmar') !!}
        <label class="switch switch-label switch-pill switch-primary  ml-2">
            {!! Form::hidden('signature_author', 0) !!}
            {!! Form::checkbox('signature_author', 1, null,  ['class' => 'switch-input']) !!}
            <span class="switch-slider" data-checked="Si" data-unchecked="No"></span>
        </label>
    </div>
</div>

<div class="row">
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('posts.index') !!}" class="btn btn-secondary">Cancelar</a>
    </div>
</div>





    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->

    {{-- <textarea>
      Welcome to TinyMCE!
    </textarea> --}}


@section('scripts')
    @include('panel.partials.scripts.tinymce-full')
    @include('panel.partials.scripts.form-validator')
    @include('panel.partials.scripts.datetimepicker')
@endsection
