@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ my_asset('croppie/croppie.css') }}" />
<script src="{{ my_asset('croppie/croppie.min.js') }}"></script>
<script src="{{my_asset('js/bootbox.min.js')}}"></script>
<script>
 $(document).ready(function(){
    $('.modal').modal();
  });
    $(function() {

        $('#upload-demo').hide();
        $('.custom-image-upload-btn').on('click', function(){
            $("#upload").trigger('click');

        });

        $uploadCrop = $('#upload-demo').croppie({
            enableExif: true,
            viewport: {
                width: 280,
                height: 280,
                //type: 'circle'
            },
            boundary: {
                width: 280,
                height: 280,
                //type: 'circle'
            }
        });


        $('#upload').on('change', function () {
            $(".avatar-profile-img").hide();
            $('#upload-demo').show();
            var reader = new FileReader();
            reader.onload = function (e) {
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                }).then(function(){
                    $('#savebtn').show();
                    $('#savebtn').removeClass('hide');
                });
            }
            reader.readAsDataURL(this.files[0]);
        });


        $('.upload-result').on('click', function (ev) {
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (resp) {
                  $.ajax({
                    url: "save-crop-image",
                    type: "POST",
                    beforeSend:function() {$("#loading").show();},
                    data: {"image":resp, "_token": "{{ csrf_token()}}"},
                    success: function (data) {
                        //html = '<img src="' + resp + '" />';
                        //$("#upload-demo-i").html(html);
                        //window.location.href = "{{URL::to('update?sectionid=profileimage')}}";
                        //
                        $('#imagesavemessage').show();
                        $('#savebtn').hide();
                        $("#loading").hide();
                        window.setTimeout(function(){window.location.reload() ;},1000)

                    },
                    error: function(){$("#loading").hide();}
                });
            });
        });

        $("#removeImg").on("click", function(event){
            $.ajax({
                    type:"POST",
                    data: {"_token": "{{ csrf_token()}}"},
                    dataType : "JSON",
                    url:"{{URL::to('user/remove-image')}}",
                    success: function(response){
                        if(response.error == 0){
                            //$("#profile").attr("src","{{ url('uploads/images/user/user-img-white.jpg') }}");
                            window.location.reload() ;
                        }
                    }
                });
        });


    });

    </script>



<section class="title-bar">
        <div class="container">
            <div class="row mb0">
                <div class="col s12 pr">
                    <h1>Add / Update profile image</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="section wrappit">
      <div class="container">
        <div class="center-wrapper" id="heightSet" >
          <div class="center-container">
            <div class="center-box" id="loginDiv">

                <div class="profile-image-wrapper">
                    <div class="profile-iamge-container">
                        <div class="avatar-profile-img">
                             <img alt="" id="profile" src="{{$profileImage}}">
                        </div>

                        <div id="upload-demo">
                        </div>

                        <input id="upload" type="file" name="profile_photo" placeholder="Photo" required="" accept="image/*" style="display: none">
                        <a class="btn-floating btn-large halfway-fab waves-effect waves-light red custom-image-upload-btn"><i class="material-icons">add</i></a>
                    </div>
                    <div class="p0"> &nbsp;</div>

                    <div class="link-container hide mb10 p0" id="savebtn"  >
                        <a href="javascript:void(0)" class="waves-effect waves-light btn-blue display-block upload-result">Save</a>
                    </div>

                    @if($profileImage == "")

                        <div class="col s6 pr0" id="cancel">
                            <a href="/home?sectionid=profileimage" class="waves-effect waves-light btn-black display-block">Cancel</a>
                        </div>
                    @else
                    @if(Auth::user()->avatar != "")
                        <div class="col s6 pr0 mb10" >
                            <a href="#modal1" class="waves-effect waves-light btn-red display-block modal-trigger"  id="remove">Remove</a>
                        </div>
                        <div id="modal1" class="modal">
                            <div class="modal-content">
                            <h4>Delete profile image?</h4>
                            <p>Do you want to delete profile image? It can not be undone.</p>
                            </div>
                            <div class="modal-footer">
                            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
                            <a href="#!" id="removeImg" class="modal-close waves-effect waves-red btn-flat">Delete</a>

                            </div>
                        </div>

                    @endif

                        <div class="col s6 pr0" id="cancel">
                            <a href="/home?sectionid=profileimage" class="waves-effect waves-light btn-black display-block">Cancel</a>
                        </div>
                    @endif
                </div>
            </div>
          </div>
        </div>
      </div>

    </div>

@endsection
