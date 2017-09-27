@section('bottom')

    <script src="/help_utilities/ckeditor/ckeditor.js"></script>

    <script src="/js/admin/plugins/bootstrapValidator/bootstrapValidator.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="/stylesheets/admin/bootstrapValidator/bootstrapValidator.min.css" />

    <script type="text/javascript">
        $(document).ready(function(){

            //iCheck
            $(".check-success").iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });

            CKEDITOR.replace('text', {

            });

            $('#form-std').bootstrapValidator({
                message: 'Это значение недействительно',
                fields: {
                    title: {
                        message: 'Введите название страницы',
                        validators: {
                            notEmpty: {
                                message: 'Введите название страницы'
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection

<!-- Main row -->
<div class="row">

  <div class="col-md-8">
      @include ('admin.'.$params['route'].'.edit._main')
  </div>

  <div class="col-md-4">
      @include ('admin.'.$params['route'].'.edit._sidebar')
  </div>

</div>
