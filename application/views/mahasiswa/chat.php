<div class="container-fluid">
    <div class="bg">
      <div class="message">
        
      </div>
        
        <input class="textarea type-message" name="chat_message" type="text" placeholder="Type here!"/>
        <div class="emojis"><i class="fa fa-wechat"></i></div>
    </div>

   <div class="bg-user">
     <table class="chat-status">
     <?php foreach ($chat as $user) { ?>
       <tr>
         <td><span class="glyphicon glyphicon-user"></span></td>
         <td><a href="#" class="user-chat" style="color: #000;" data-id="<?php echo $user['user_id'] ?>"><?php echo $user['nama_mhs'] ?></a></td>
         <td><span class="label label-default">offline</span></td>
       </tr>
      <?php } ?>
     </table>
    
     
     <input class="chat-user" type="text" placeholder="Search"/><div class="emojis2"><i class="fa fa-search"></i></div>
   </div>
</div>
<script>
 $(function(){

  var get_chat_message = function()
  {

    $.ajax({
          type : "GET",
          url : "<?php echo base_url('mahasiswa/get_message_chat') ?>",
          success : function(data)
          {
              $('.message').html(data);        
          },
    });

  }
  setInterval(get_chat_message, 500);

  $(document).on('click', '.user-chat', function(){
      var id=$(this).attr("data-id");
      console.log(id);
      $('.bg').show();
  });

  $('.textarea').bind("enterKey",function(e){
      
      var message = $('.textarea').val();
      $('.textarea').val('');
      /*alert(message);*/

      $.ajax({
          type: "POST",
          url:"<?php echo base_url('mahasiswa/send_chat'); ?>",
          data: {
              pesan:message
          },
      })

  });

  $('.textarea').keyup(function(e){
      if(e.keyCode == 13)
      {
          $(this).trigger("enterKey");
      }
  });

 }); 
</script>