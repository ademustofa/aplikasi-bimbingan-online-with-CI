
<div class="container-fluid">
<div class="jumbotron">
   <a href="#demo" class="btn btn-info" data-toggle="collapse"><i class="fa fa-warning"></i> Catatan Penting</a>
   <br>
  <div id="demo" class="collapse">
  <br>
    <ul>
    <li>Tipe file harus berupa PDF</li>
    <li>Format file : NAMA_NIM_BAB. Contoh ADE_MUSTOFA_1403001_BAB1.pdf</li>
    <li>Format file revisi :  _NAMA_NIM_BAB_revisi_1.pdf, untuk nomor revisi bisa disesuaikan dengan progres laporan yang telah direvisi</li>
    <li>
      <td><span class="label label-warning">Revisi <span class="glyphicon glyphicon-remove"></span></span></td>
        Menandakan Bahwa File tersebut direvisi
    </li>
    <li>
      <td><span class="label label-success">Selesai <span class="glyphicon glyphicon-ok"></span></span></td>
        Menandakan Bahwa File tersebut dtelah selesai
    </li>
    <li>Pembimbing PPI anda adalah : <strong><?php echo ($dosen['nama_dsn']); ?></strong></li>
  </ul>
  </div>
    &nbsp
    <br>
    <?php echo $this->session->flashdata('message'); ?>
    <button class=" btn btn-info" data-toggle="modal" href="#myModal"><span class="glyphicon glyphicon-upload"></span>  Upload laporan</button>
    <br>
    <hr>
    <?php if (empty($docs_ppi)): ?>
      <h4 style="text-align: center;">Tidak ada file PPI yang diupload</h4>
    <?php elseif (!empty($docs_ppi)):  ?>
      <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th>Nama Submission</th>
        <th>Pembimbing</th>
        <th>Submission</th>
        <th>Status</th>
        <th>File Revisi</th>
        <th>Edit Submission</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($docs_ppi as $doc) {
        /*echo "<pre>";
        var_dump($doc);
        echo "</pre>";*/

     ?>
        <tr>
        <td><?php echo $doc['nama_doc']; ?></td>
        <td><?php echo $doc['nama_dsn'] ?></td>
        <td><a href="<?php echo base_url('assets/pdfjs/web/uploads/'.$doc['submission']); ?>" target="_blank"><?php echo $doc['submission']; ?></a></td>

        <?php if ($doc['status_doc'] == 'draft'): ?>
          <td><span class="label label-default">Draft</span></td>
        <?php elseif($doc['status_doc'] == 'revisi' ): ?>
          <td><span class="label label-warning">Revisi <span class="glyphicon glyphicon-remove"></span></span></td>
        <?php elseif($doc['status_doc'] == 'selesai' ): ?>
          <td><span class="label label-success">Selesai <span class="glyphicon glyphicon-ok"></span></span></td>
        <?php endif; ?>

        <?php if (empty($doc['revisi_sub'])): ?>
          <td>File tidak ada</td>
        <?php elseif (!empty($doc['revisi_sub'])): ?>
          <!-- <td><?php echo $doc['revisi_sub'] ?></td> -->
        <td><a href="<?php echo base_url('assets/pdfjs/web/uploads/'.$doc['revisi_sub']); ?>" class="btn btn-default">Download</a></td>
                    <?php endif; ?>
        <td><button class="btn btn-info edit-ppi" data-id="<?php echo $doc['id'] ?>"><i class="fa fa-pencil"></i> Edit</button></td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
  </div>
    <?php endif ?>
</div>
</div>

<!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Form Upload laporan</h4>
                  </div>
                  <div class="modal-body">
                     <!-- start form -->
                           <?php echo form_open_multipart('mahasiswa/do_post_doc_ppi',array(
                                'method' => 'POST',
                                'class'  => 'form-horizontal'
                            )); ?>

                                <div class="form-group" hidden>
                                    <label for="Pembimbing1" class="col-md-3 control-label">Pebimbing 1</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="doc_type" value="PPI">
                                        <!-- <?php echo form_error('pembimbing1'); ?> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="sel1" class="col-md-3 control-label">Nama</label>
                                     <div class="col-md-8">
                                          <select class="form-control" id="sel1" name="nama">
                                            <option>BAB I</option>
                                            <option>BAB II</option>
                                            <option>BAB III</option>
                                            <option>BAB IV</option>
                                            <option>BAB V</option>
                                          </select>
                                     </div>
                                     <!-- <?php echo form_error('nama'); ?> -->
                                </div>    

                                <div class="form-group">
                                    <label for="Pembimbing1" class="col-md-3 control-label">Pebimbing</label>
                                    <div class="col-md-8">
                                        <select class="form-control" id="sel1" name="pembimbing">
                                           <?php foreach ($options as $dosen) { ?>
                                               <option value="<?php echo $dosen['id'] ?>"><?php echo $dosen['nama_dsn'] ?></option>
                                           <?php } ?>
                                          </select>
                                        <!-- <?php echo form_error('pembimbing1'); ?> -->
                                    </div>
                                </div>
                               <!--      
                                                               <div class="form-group">
                               <label for="Pembimbing2" class="col-md-3 control-label">Pembimbing 2</label>
                               <div class="col-md-8">
                                  <select class="form-control" id="sel1" name="pembimbing2">
                                       <?php foreach ($options as $dosen) { ?>
                                          <option value="<?php echo $dosen['id'] ?>"><?php echo $dosen['username'] ?></option>
                                      <?php } ?>
                                     </select>
                                   <?php echo form_error('pembimbing2'); ?>
                               </div>
                                                               </div> -->
                                <div class="form-group">
                                    <label for="lastname" class="col-md-3 control-label">Submission</label>
                                    <div class="col-md-8 col-md-offset-3">
                                        <input type="file" name="userfile">
                                    </div>
                                </div>
                                    

                                <div class="form-group">
                                    <!-- Button -->                                        
                                    <div class="col-md-offset-3 col-md-8">
                                        <button type="submit" class="btn btn-default">Submit</button> 
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                        <!-- end form -->         
                  </div>
                </div>

              </div>
            </div>
            <!-- end modal -->

            <div id="edit-subppi" class="modal fade" role="dialog">
            <div class="modal-dialog">
        
              <!--Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Edit Submission</h4>
                </div>
                <div class="modal-body" style="text-align: center;">
                <?php echo form_open_multipart('mahasiswa/edit_submission_ppi/',array(
                                'method' => 'POST',
                                'class'  => 'form-horizontal'
                            )); ?>
                    <input type="hidden" name="id" >
                    <div class="form-group">
                      <label for="lastname" class="col-md-3 control-label">Submission</label>
                      <div class="col-md-8 col-md-offset-3">
                        <input type="file" name="userfile">
                      </div>
                    </div>

                    <div class="form-group">                            
                        <div class="">
                          <button type="submit" class="btn btn-default">Submit</button> 
                        </div>
                    </div>
                <?php echo form_close(); ?>       
                </div>
                <div class="modal-footer">
              
                </div>
              </div>
        
            </div>
          </div>

<script type="text/javascript">
    $(document).on('click','.edit-ppi',function(){
      var id=$(this).attr("data-id");
      console.log(id);

      $.ajax({
                url : "<?php echo base_url('mahasiswa/update_sub_ppi/') ?>" + id,
                type : "GET",
                success : function(data)
                {
                  var res = $.parseJSON(data);
                   
                    console.log(res);
                    $('[name="id"]').val(res.id);
                   
                    $('#edit-subppi').modal('show'); // tampilin modal
  
                },
                error : function(jqXHR, textStatus, errorThrown)
                {
                  console.log(textStatus);
                  console.log(jqXHR);
                  console.log(errorThrown);
                    swal("Error!", "Error getting data.", "error"); // tampil sweet alert error
                }
            });
    });
 </script>