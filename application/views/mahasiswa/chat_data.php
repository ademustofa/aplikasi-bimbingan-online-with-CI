<ol class="chat">

          <?php foreach ($message as $konten) { ?>

          <?php if ($konten['create_by'] == $id2 && $konten['send_to'] == $id): ?>
            <li class="other">
              <div class="msg">
                <p class="self-konten"><?php echo $konten['chat_content']; ?></p>
                <time class="self-time"><?php echo $konten['created_at']; ?></time>
              </div>
          </li>
          <?php elseif ($konten['create_by'] == $id && $konten['send_to'] == $id2): ?>
           <li class="self">
              <div class="msg">
                <p class="self-konten"><?php echo $konten['chat_content']; ?></p>
                <time class="self-time"><?php echo $konten['created_at']; ?></time>
              </div>
          </li>
          <?php endif ?>
           
          <?php } ?>

</ol>