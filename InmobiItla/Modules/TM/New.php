<!DOCTYPE html>
<? 

include $_SERVER['DOCUMENT_ROOT'] . "/inc/Controllers/ClientsController.php";
if (!isset($_SESSION['User'])) {
  header("Location: /");
  die();
}
$Interface = GetInterface('ADD_MUSIC');
$Tab = GetTab($Interface["tab_id"]);
$Company = GetCompany($UserData["company_id"]);
?>
<? include $PageHeader ?>
<style type="text/css">
#FacturePage {
  width: 8.5in;
  height: 11in;
  background-color: #fff;
  zoom: 1;
  box-shadow: 0px 6px 3px rgba(0,0,0,0.2);
}
#AlbumArt {
    height: 200px;
    width: 200px;
    line-height: 200px;
    text-align: center;
    font-size: 52px;
    background-color: #ccc;
    margin: 0 auto;
    margin-top: 20px;
    color: #FFF;
    background-size: cover;
    overflow: hidden;
}

.Disappear {
  display: none;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <? echo $Interface['InterfaceDisplay'] ?>
        <small><? echo $Interface['InterfaceDesc'] ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> <? echo $Tab["TabDisplay"] ?></a></li>
        <li class="active"><? echo $Interface['InterfaceDisplay'] ?></li>
      </ol>
    </section>

    <section class="content">
<form action="/inc/Functions/CreateClient.php" id="clientform">
     <div class="row">
        <!-- left column -->
        <div class="col-md-4">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Album</h3>

            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div id="AlbumArt"></div>
            <input type='file' id='getval' name="AlbumImg" style="display: none" />
              <div class="box-body">

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <div class="form-group">
                <input type="hidden" name="client_id">
                  <label for="ClientName">Nombre</label>
                  <input type="text" class="form-control" data-autocompletable="false" name="AlbumName" id="AlbumName" placeholder="Nombre del Album" required="true">
                </div>
              </div>
          </div>

        </div>
        <div class="col-md-8">
         <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Songs</h3>
              <input style="display: none"  type="file" id="Songs"/>
<audio id="audio" class="Disappear"></audio>
                            <div class="box-tools pull-right">
                <button type="button" id="AddMusic" class="btn btn-box-tool"><i class="fa fa-plus"></i> Add Song
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body" id="songlist">
              </div>
              <!-- /.box-body -->

              <div class="box-footer">

              </div>
          </div>
          </div>
        </div>
        <!--/.col (left) -->
        <!-- right column -->
 
        <!--/.col (right) -->
      </div>
    
  </div>
  <div class="modal fade" id="EditSong" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Informacion de Cancion</h4>
      </div>
      <div class="modal-body">
                    <div class="form-group">
                  <label for="ClientName">Titulo de Cancion</label>
                  <input type="text" class="form-control" data-autocompletable="false" name="title" id="AlbumName" placeholder="Nombre del Album" required="true">
                </div>
                                <div class="form-group">
                  <label for="ClientName">Artista</label>
                  <input type="text" class="form-control" data-autocompletable="false" name="artist" id="AlbumName" placeholder="Nombre del Album" required="true">
                </div>
                                <div class="form-group">
                  <label for="ClientName">Album</label>
                  <input type="text" class="form-control" data-autocompletable="false" name="album" id="AlbumName" placeholder="Nombre del Album" required="true">
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="saveSongData">Guardar</button>
      </div>
    </div>
  </div>
  </div>
  </section>
<? include $PageFooter ?>
<script type="text/javascript">
var IMGSet = false;
var Playing;
var Arr = {
    "Num" : {
      "title" : "#"
    },
    "title" : {
      "title" : "Nombre"
    },
    "artist" : {
      "title" : "Artista"
    },
    "album" : {
      "title" : "Album",
    },
    "duration" : {
      "title" : "Duracion",
    },
    "Play" : {
      "title" : "",
      "Format" : "<div id='BUTT_{i}' onclick='Play(this, {i})'><i class='fa fa-play'></i></div>"
    },
    "remove" : {
      "title" : "",
      "Format" : "<div onclick='Remove(this, {i})'><i class='fa fa-remove'></i></div>"
    },
    "edit" : {
      "title" : "",
      "Format" : "<div onclick='Edit(this, {i})'><i class='fa fa-edit'></i></div>"
    }
  };

var Canciones = {};
var Album = {};
var SCount = 0;
var Files = {};
function Edit(Obj, Song) {
  $('#EditSong').modal();
  $.each(Canciones[Song],function(index) {
    $('[name="'+index+'"]').val(Canciones[Song][index]);
    $('#saveSongData').attr('onclick', 'SaveData('+Song+')')
  })
}

function SaveData(Song) {
  $('#EditSong').modal('hide')
  $.each($('input'), function (){ 
    var Name = $(this).prop('name');
    var Value = $(this).val();
    if (Canciones[Song][Name]) {
      Canciones[Song][Name] = Value;
    }
  })
      ARRAYTable("#songlist",Canciones, Arr, "Clients")

}
function Play(Obj, Song) {
  if (Playing) {
    Playing.pause();
  }
    if (Playing == Canciones[Song].Player) {
        Playing.pause()
        $(Obj).html("<i class='fa fa-play'></i>")
        Playing = null;
    } else {
        Playing = Canciones[Song].Player;
        Playing.play();
        $(Obj).html("<i class='fa fa-stop'></i>")

    }
        Playing.onended = function() {
          CheckPlay();
        }
    CheckPlay();
}

function Remove(Obj, Song) {
    if (Canciones[Song].Player == Playing) {
        Playing.pause()
        $(Obj).html("<i class='fa fa-play'></i>")
        Playing = null;
    }
    Canciones[Song] = null;
    ARRAYTable("#songlist",Canciones, Arr, "Clients")
    CheckPlay();
}
function CheckPlay() {
if(Playing) {
$.each(Canciones, function(I, Song) {
  if (Song.Player == Playing) {
    $('#BUTT_'+I).html("<i class='fa fa-stop'></i>")
  } else {
    $('#BUTT_'+I).html("<i class='fa fa-play'></i>")
  }
})
}
}
function base64ToBlob(base64, mime) 
{
    mime = mime || '';
    var sliceSize = 1024;
    var byteChars = window.atob(base64);
    var byteArrays = [];

    for (var offset = 0, len = byteChars.length; offset < len; offset += sliceSize) {
        var slice = byteChars.slice(offset, offset + sliceSize);

        var byteNumbers = new Array(slice.length);
        for (var i = 0; i < slice.length; i++) {
            byteNumbers[i] = slice.charCodeAt(i);
        }

        var byteArray = new Uint8Array(byteNumbers);

        byteArrays.push(byteArray);
    }

    return new Blob(byteArrays, {type: mime});
}
function CreateBase(id) {

   var file = Files[id];
   var reader = new FileReader();
   reader.onloadend = function(){
      Canciones[id]['BASE'] = reader.result;
      SignSong();
   }
   reader.readAsDataURL(file)
}
$(document).ready(function() {
    $('#Songs').change(function (){
      var file = document.getElementById("Songs").files[0];  
      var URL = window.URL.createObjectURL(file);
        ID3.loadTags(URL, function() {
          if (!Canciones[file.size] || Canciones[file.size] == null) {
                var tags = ID3.getAllTags(URL);
                Canciones[file.size] = {}
                SCount++;
                Canciones[file.size]['Player'] = document.createElement("AUDIO");
                Canciones[file.size]['Player'].setAttribute("src", URL);
                Canciones[file.size]['Player'].oncanplaythrough = function() {
                
                var seconds = Canciones[file.size]['Player'].duration;
                var Minutes = Math.floor(seconds/60);
                var Left = Math.floor(seconds-(Minutes*60));
                
                if (Left.length < 2) {
                  Left = "0" + Left; 
                }
                console.log(tags)
                Canciones[file.size]['Num'] = SCount;
                Canciones[file.size]['title'] = tags.title;
                Canciones[file.size]['album'] = tags.album;
                Canciones[file.size]['artist'] = tags.artist;
                Canciones[file.size]['duration'] = Minutes +":"+ Left;
                Canciones[file.size]['FILE'] = URL;
                Files[file.size] = file;
                CreateBase(file.size);
                ARRAYTable("#songlist",Canciones, Arr, "Clients")
                CheckPlay();

                };
              }
        });
    })
var colors = ['#e729a5',
'#cf2494',
'#b82084',
'#a11c73',
'#8a1863',
'#5c1042',
'#450c31',
'#2e0821',
'#170410',
'#000000']
var TakenColor = colors[Math.floor(Math.random() * colors.length)];
$('#AlbumArt').css('background-color', TakenColor);
Album['COLOR'] = TakenColor;
$('#AddMusic').click(function(){ $('#Songs').trigger('click'); });

$('#AlbumArt').click(function(){ $('[name="AlbumImg"]').trigger('click'); });
})
  $('#AlbumName').on('keyup', function (event) {
    var Name = $(this).val();
    var Words = Name.split(" ");
    var Characters = "";
    $.each(Words, function(index) {
      Characters += Words[index].charAt(0);
    })
    if (!IMGSet) {
    $('#AlbumArt').html(Characters.toUpperCase())
    Album['ACRONYM'] = Characters.toUpperCase();
    }
  }) 

  document.getElementById('getval').addEventListener('change', readURL, true);

function readURL(){
   var file = document.getElementById("getval").files[0];
   var reader = new FileReader();
   reader.onloadend = function(){
      var img = document.createElement('img');
      img.onload = function () { 
        if (img.height == img.width) {
        $('#AlbumArt').html('');
        document.getElementById('AlbumArt').style.backgroundImage = "url(" + reader.result + ")";
        Album['IMAGE'] = reader.result;  
        IMGSet = true;
        } else {
          Notify("error", "La imagen del Album debe ser proporcional, es decir cuadrada.")
        }
      };
      img.src=reader.result;


   }
   if(file){
      reader.readAsDataURL(file);
    }else{
      IMGSet = false;
    }
}
function SignSong() {
             var data1 = new FormData($('input[name^="file"]'));
                $.each($('input[name^="file"]')[0].files, function(i, file) {
                data1.append(i, file);
                });


       xhr=new XMLHttpRequest();
       xhr.addEventListener("load", function(){
        console.log(xhr.responseText)
       }, false);
       xhr.open('POST',"/inc/Functions/Song");
        xhr.send(data1);


   // $.ajax({
   //      type:"POST",
   //      url: "/inc/Functions/Song",
   //      data: data,
   //      success: function(response){
   //        console.log(response);
   //      }
   //  });



  //Generating custom FormData HTML5  

}
</script>