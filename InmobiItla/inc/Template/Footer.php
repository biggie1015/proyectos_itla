<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="#">Dimas Ariel Development</a>.</strong> Todos los derechos reservados.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Usuarios Disponibles</h3>
        <ul class="control-sidebar-menu">

        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- jQuery 2.2.0 --><!-- REQUIRED JS SCRIPTS -->

<script src="/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script src="/plugins/jQueryUI/jquery-ui.min.js"></script>

<script src="/plugins/JSONTable.js"></script>
<script src="/plugins/SQLArray.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/bootstrap/js/bootstrap.min.js"></script>

<script src="../../plugins/input-mask/jquery.inputmask.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="../../plugins/noty/packaged/jquery.noty.packaged.js"></script>
<script src="../../plugins/ID3Reader/ID3Reader.js"></script>
<script src="../../plugins/jquery.form.min.js"></script>
<!-- AdminLTE App -->

<script src="/dist/js/app.min.js"></script>
  <script type="text/javascript">
        var CID = 0;
        var aUID = 1;
        var Sixe = 0;
        
          function Notify(type, text, stimeout) {
            stimeout = stimeout || 3000
            var n = noty({
                text        : text,
                type        : type,
                dismissQueue: true,
                layout      : 'topRight',
                closeWith   : ['click'],
                theme       : 'relax',
                maxVisible  : 10,
                timeout : stimeout
            });
        }
  $('select').change(function () {
    var Extension = $(this).attr("renovateby");
    var TriggerDefine = $(this).attr("Trigger");
    if (this.value == "" || !this.value) {
    $('[name="'+Extension+'_new"]').attr("disabled", false);
    $('[name="'+Extension+'_btn"]').show              ();
          if(TriggerDefine != "") {
          onTriggerDown(this.value, TriggerDefine);
          console.log(TriggerDefine); 
      } 
    } else {
    $('[name="'+Extension+'_new"]').attr("disabled", true);
    $('[name="'+Extension+'_btn"]').hide();
      if( TriggerDefine != "") {
          onTriggerDown(this.value, TriggerDefine);
          console.log(TriggerDefine); 
        }
    }
  });
  function onTriggerDown(value, selector) {
    var Triggered = $(selector)
    
        $('[renovateby="'+Triggered.attr("name").replace("_new", "")+'"]').html("");
        $('[renovateby="'+Triggered.attr("name").replace("_new", "")+'"]').attr("disabled", true);
        $('[renovateby="'+Triggered.attr("name").replace("_new", "")+'"]').val("");
        Triggered.attr("disabled", true);
    if (value && value != "") {
          var optionVal = Triggered.attr("OptionVal");
          var optionDisplay = Triggered.attr("OptionDisplay")
          console.log("/inc/Functions/"+Triggered.attr("DataRecieve")+"?id="+value);
          $('[renovateby="'+Triggered.attr("name").replace("_new", "")+'"]').append("<option value=''>- Nuevo -</option>")

          $.getJSON("/inc/Functions/"+Triggered.attr("DataRecieve")+"?id="+value, function(data) {
            $.each(data, function(index) {
              var Info = data[index]
                  $('[renovateby="'+Triggered.attr("name").replace("_new", "")+'"]').append("<option value='"+Info[optionVal]+"'>"+Info[optionDisplay]+"</option>")
            })
            Triggered.attr("disabled", false);
            $('[renovateby="'+Triggered.attr("name").replace("_new", "")+'"]').attr("disabled", false);
          }) 
    } else {
        $('[renovateby="'+Triggered.attr("name").replace("_new", "")+'"]').html("");
        $('[renovateby="'+Triggered.attr("name").replace("_new", "")+'"]').attr("disabled", true);
        $('[renovateby="'+Triggered.attr("name").replace("_new", "")+'"]').val("");
        Triggered.attr("disabled", true);
    }
  }



$(document).ready(function () {

$("[CheckDown='true']").on("keyup", checkInput) 
$("[CheckDown='true']").on("keydown", checkInput)
$("[CheckDown='true']").on("blur", checkInput)  
function checkInput(event) {
    var input = $(this);
    var key   = event.keyCode ? event.keyCode : event.which;
    var key   = event.keyCode ? event.keyCode : event.which;
if (!( [8, 9, 13, 27, 46, 110, 190].indexOf(key) !== -1 ||
         (key == 65 && ( event.ctrlKey || event.metaKey  ) ) || 
         (key >= 35 && key <= 40) ||
         (key >= 48 && key <= 57 && !(event.shiftKey || event.altKey)) ||
         (key >= 96 && key <= 105)
       )) event.preventDefault();
    input.val(input.val().replace(/[^\d]+/g,''));
    if(input.attr("Percent")) {
      input = $('[name="'+input.attr("Percent")+'"]');
    } 
    
    if (input.attr("isPercent") == "true") {
      if (input.val().length > 2 && key != 8) {
        
        event.preventDefault()
      }
      if(parseInt(input.val()) >= 100 || input.val().length > 3) {
        input.val(100);
      }
      if (input.attr("pTo") && input.attr("pFrom")) {
      var ValuePercent = $('[name="'+input.attr("pFrom")+'"]').val() || input.attr("pFrom");
      var InputAffected = $('[name="'+input.attr("pTo")+'"]')
      InputAffected.val(parseInt(input.val()) * parseInt(ValuePercent) / 100) 
      }
    }
}
    $('[name$="_btn"]').click(function(event) {
    var input = $(this).attr("name").replace("_btn", "_new"); 

    console.log(input);
    var to = input.replace("_new", "");
    input = "[name='"+input+"']"
    var Name = $(input).val();
    console.log(Name)
    var In = $(input);
    var butt = $(this);
    var selectName = to.replace("mbt_","").substring(0, to.replace("mbt_","").length-1) + "_id";
    var select = $('[renovateby="'+to+'"]');
    var Optional = $('[name="'+$(input).attr("InfoData")+'"]').val() || "non"
    $.get("/inc/Autos/AutoCreate?base="+to+"&val="+$(input).val()+"&optional="+Optional, function(response) {
      select.append("<option value='"+response+"'>"+Name+"</option>")
      select.val(response);
      In.attr("disabled", true);
      butt.hide();
      In.val("");
      onTriggerDown(select.val(), select.attr("Trigger"));
    })
  });
$('form[method="POST"]').ajaxForm(function(response) {
  Notify("success", "Registro Exitoso.")
  console.log(response);
  $("input").val("");
}); 
})
$( "#client_name" ).on("keyup", function() {
  var Master = $(this).prop('id');
  $.each($('input'), function() {
    if ($(this).prop('id') != Master) {
    $(this).val('');
    }
  })
})
    $( "#client_name" ).autocomplete({
      minLength: 0,
      source: function(request, response) {
        $.getJSON('/inc/Functions/GetClients.php?criteria='+request.term, { q: request.term }, function(result) {
              response($.map(result, function(item) {
                return item;
            }));
        })},
      focus: function( event, ui ) {
        $( "#client_name" ).val( ui.item.Name );
        return false;
      },
      select: function( event, ui ) {
        $( "#client_name" ).val( ui.item.Name );
        $( "#client-id" ).val( ui.item.client_id );
        $.each(ui.item, function(index, value) {
          $('[name="'+index+'"]').val(value);
        })
       // $( "#project-description" ).html( ui.item.desc );
        //$( "#project-icon" ).attr( "src", "images/" + ui.item.icon );
 
        return false;
      }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
      console.log(item);
      return $( "<li class='completeresult'>" )
        .append( "" + item.Name + "<br>" + item.Mail + "" )
        .appendTo( ul );
    };
	

    $("#search").on("click", function() {

    })

  </script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
