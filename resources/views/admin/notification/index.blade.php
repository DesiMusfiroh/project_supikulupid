<li class="dropdown dropdown-list-toggle"><a href="#" id="notif_dropdown" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
    <div class="dropdown-menu dropdown-list dropdown-menu-right">
        <div class="dropdown-header">Notifikasi
        </div>
        <div class="dropdown-list-content dropdown-list-icons" id="notif-box">

        </div>
        <div class="dropdown-footer text-center">
        <a href="#">Lihat Semua <i class="fas fa-chevron-right"></i></a>
        </div>
    </div>     
</li>
          
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
  $('#notif_dropdown').click(function() {
      jQuery.ajax({
          url : '/getnotificationadmin/',
          type : "GET",
          dataType : "json",
          success: function(data){
              console.log("data ===" + data);
              $('.dropdown-list-content').empty();
              jQuery.each(data, function(key,value){
                    $('.dropdown-list-content').append('<a href="#" class="dropdown-item dropdown-item-unread">' +
                        '<div class="dropdown-item-icon bg-primary text-white"> ' +
                        '<img src="../images/'+ value[3]+'" />'
                        '</div> ' +
                        '<div class="dropdown-item-desc">' +
                        value[4] +
                        '<div class="time text-primary">'+ value[2] +'</div>' +
                        '</div>' +
                    '</a>');
              });
          }
      });
  }); 

</script>