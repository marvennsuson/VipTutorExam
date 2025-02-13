@extends('layouts.app')
@section('style')

@endsection
@section('content')
@include('layouts.notification')
    <div class="container">
        <div class="col-lg-12">
            <form id="create_product" action="{{ route('user.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
    
                <div class="row justify-content-start">
    
                    <div class="col-sm-8 shadow ">
                        <div class=" p-3">
                            <h5>Upload Product</h5>
                            <!-- Upload image input-->
                            <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                <input id="upload" type="file" accept="image/*" name="header_banner"
                                    onchange="readURL(this);" class="form-control border-0">
                                <label id="upload-label" for="upload" class="font-weight-light text-muted"></label>
                                <div class="input-group-append">
                                    <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i
                                            class="fa fa-cloud-upload mr-2 text-muted"></i><small
                                            class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                                </div>
                            </div>
    
                            <!-- Uploaded image area-->
                            <div class="image-area mt-4"><img id="imageResult" src="#" alt=""
                                    class="img-fluid rounded shadow-sm mx-auto d-block"></div>
    
                            <h5 class="mt-5">Product Content</h5>
    
                            <div class="form-group w-50 mb-3">
                                <label for="pkg">Product Title</label>
                                <input type="text" class="form-control " name="title" placeholder="Title here" id="src">
                            </div>
                            <div class="input-group shadow-sm rounded py-2">
                              
                                <textarea id="editor" class="form-control b-none" name="description" style="height: 100px;"
                                    placeholder="Type Content Here"></textarea>
                            </div>
    
                            <div class="mt-4">
                            <h6>Price</h6>
                            <input type="text" class="form-control b-none" name="price" id="currency-field" pattern="^\₱\d{1,3}(,\d{3})*(\.\d+)?₱" value="" data-type="currency" placeholder="₱ 00.00">
                        </div>
                            <div class="mt-4">
                                <h6>Stock</h6>
                                <input type="text" class="form-control b-none" name="stock" id="stock" />
                            </div>
                        </div>
                        <div class="d-flex justify-content-start  p-3">
                            <button type="submit" class="btn btn-success form-control w-25 mr-3">Add Product</button>
                            &nbsp;
                            <a href="{{ route('user.product.index') }}" class="btn btn-danger form-control w-25">cancel</a>
                        </div>
                    </div>
    
                </div>
            </form>
        </div>
     
    </div>
@endsection
@section('script')
<script>
    $(function() {
        var input_file = document.getElementById('upload_files');
        var deleted_file_ids = [];
        var dynm_id = 0;
        $("#upload_files").change(function(event) {
            var len = input_file.files.length;
            $('#preview_file_div ul.row').html("");

            for (var j = 0; j < len; j++) {
                var src = "";
                var name = event.target.files[j].name;
                var mime_type = event.target.files[j].type.split("/");
                if (mime_type[0] == "image") {
                    src = URL.createObjectURL(event.target.files[j]);
                } else if (mime_type[0] == "video") {
                    src = 'icons/video.png';
                } else {
                    src = 'icons/file.png';
                }
                $('#preview_file_div ul').append("<li class='col-sm-6 p-3' id='" + dynm_id +
                    "'><div class='ic-sing-file'><img id='" + dynm_id + "' src='" + src +
                    "' title='" + name + "'><p class='close' id='" + dynm_id + "'>X</p></div></li>");
                dynm_id++;
            }
        });
        $(document).on('click', 'p.close', function() {
            var id = $(this).attr('id');
            deleted_file_ids.push(id);
            $('li#' + id).remove();
            if (("li").length == 0) document.getElementById('upload_files').value = "";
        });
    });
</script>
       <script type="text/javascript">
        /*  ==========================================
                    SHOW UPLOADED IMAGE
                * ========================================== */
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imageResult')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function() {
            $('#upload').on('change', function() {
                readURL(input);
            });
        });

        /*  ==========================================
            SHOW UPLOADED IMAGE NAME
        * ========================================== */
        var input = document.getElementById('upload');
        var infoArea = document.getElementById('upload-label');

        input.addEventListener('change', showFileName);

        function showFileName(event) {
            var input = event.srcElement;
            var fileName = input.files[0].name;
            infoArea.textContent = 'File name: ' + fileName;
        }
    </script>

    <script>
        // Currency

        $("input[data-type='currency']").on({
            keyup: function() {
                formatCurrency($(this));
            },
            blur: function() {
                formatCurrency($(this), "blur");
            }
        });


        function formatNumber(n) {
            // format number 1000000 to 1,234,567
            return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }


        function formatCurrency(input, blur) {
            // appends $ to value, validates decimal side
            // and puts cursor back in right position.

            // get input value
            var input_val = input.val();

            // don't validate empty input
            if (input_val === "") {
                return;
            }

            // original length
            var original_len = input_val.length;

            // initial caret position
            var caret_pos = input.prop("selectionStart");

            // check for decimal
            if (input_val.indexOf(".") >= 0) {

                // get position of first decimal
                // this prevents multiple decimals from
                // being entered
                var decimal_pos = input_val.indexOf(".");

                // split number by decimal point
                var left_side = input_val.substring(0, decimal_pos);
                var right_side = input_val.substring(decimal_pos);

                // add commas to left side of number
                left_side = formatNumber(left_side);

                // validate right side
                right_side = formatNumber(right_side);

                // On blur make sure 2 numbers after decimal
                if (blur === "blur") {
                    right_side += "00";
                }

                // Limit decimal to only 2 digits
                right_side = right_side.substring(0, 2);

                // join number by .
                input_val = "₱ " + left_side + "." + right_side;

            } else {
                // no decimal entered
                // add commas to number
                // remove all non-digits
                input_val = formatNumber(input_val);
                input_val = "₱ " + input_val;

                // final formatting
                if (blur === "blur") {
                    input_val += ".00";
                }
            }

            // send updated string to input
            input.val(input_val);

            // put caret back in the right position
            var updated_len = input_val.length;
            caret_pos = updated_len - original_len + caret_pos;
            input[0].setSelectionRange(caret_pos, caret_pos);
        }
     
    </script>
@endsection

