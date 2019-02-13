@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="/assets/croppie/croppie.css" />
<script src="/assets/croppie/croppie.min.js"></script>

<script>
    
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
                    console.log('jQuery bind complete');
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
                    url: "/user/save-crop-image",
                    type: "POST",
                    data: {"image":resp},
                    success: function (data) {
                        //html = '<img src="' + resp + '" />';
                        //$("#upload-demo-i").html(html);
                        //window.location.href = "{{URL::to('update?sectionid=profileimage')}}";
                        //
                        $('#imagesavemessage').show();
                        $('#savebtn').hide();
                        window.setTimeout(function(){window.location.reload() ;},1000)

                    }
                });
            });
        });



        $("#remove").on("click", function(event){
            event.preventDefault();
            var r = confirm("Are you sure you want to delete!");
            if (r == true) {
                $.ajax({
                    type:"POST",
                    dataType : "JSON",
                    url:"/user/remove-image",
                    success: function(response){
                        if(response.error == 0){
                            //window.location.href = "{{URL::to('update?sectionid=profileimage')}}";
                            $("#profile").attr("src","/uploads/images/user/user-img-white.jpg");
                            window.location.reload() ;
                        }
                    }
                });
                
            }
        });


    });
    </script>



<section class="title-bar">
        <div class="container">
            <div class="row mb0">
                <div class="col s12 pr">
                    <h1>Add profile image</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="section wrappit">
      <div class="container">
        <div class="center-wrapper" id="heightSet" >
          <div class="center-container">
            <div class="center-box" id="loginDiv"  >
                <div class="profile-image-wrapper">
                    <div class="profile-iamge-container">
                        <div class="avatar-profile-img">
                            @if($profileImage == "")
                                <img alt="" id="profile" src="/uploads/images/user/user-img-white.jpg">
                            @else
                                <img alt="" id="profile" src="/uploads/images/user/{{$profileImage}}">
                            @endif
                        </div>

                        <div id="upload-demo">
                        </div>

                        <input id="upload" type="file" name="profile_photo" placeholder="Photo" required="" accept="image/*" style="display: none">
                        <a class="btn-floating btn-large halfway-fab waves-effect waves-light red custom-image-upload-btn"><i class="material-icons">add</i></a>
                    </div>
                    <!-- <div style="color: green; font-weight: bold; text-align: center; display: none;" id="imagesavemessage">
                        Image Saved!
                    </div> -->

                    <div class="link-container mb10 p0" id="savebtn"  >
                        <a href="javascript:void(0)" class="waves-effect waves-light btn-blue display-block upload-result">Save</a>
                    </div>

                    @if($profileImage == "")

                        <div class="col s6 pr0" id="cancel">
                            <a href="/home?sectionid=profileimage" class="waves-effect waves-light btn-black display-block">Cancel</a>
                        </div>
                    @else

                        <div class="col s6 pr0 mb10" >
                            <a href="/user/profile-image" class="waves-effect waves-light btn-red display-block" id="remove">Remove</a>
                        </div>

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