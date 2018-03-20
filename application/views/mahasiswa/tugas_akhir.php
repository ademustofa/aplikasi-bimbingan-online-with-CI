
<div class="container-fluid">
<div class="jumbotron">
<?php if ($status['status_ppi'] == 'belum'): ?>
  <h4 class="bounceInDown" style="text-align: center;">Maaf! anda belum bisa beraktifitas di menu Tugas Akhir karena status PPI anda belum Selesai</h4>
<?php elseif ($status['status_ppi'] == 'selesai'): ?>
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
    <li>Pembimbing 1 TA anda adalah : <strong><?php echo ($dosen['pembimbing1']); ?></strong></li>
    <li>Pembimbing 2 TA anda adalah : <strong><?php echo ($dosen['pembimbing2']); ?></strong></li>
  </ul>
  </div>
  &nbsp
    <br>
    <?php echo $this->session->flashdata('message'); ?>
    
    <button class=" btn btn-info" data-toggle="modal" href="#myModal"><span class="glyphicon glyphicon-upload"></span>  Upload laporan</button>
    <hr>
    <br>
    <?php if (empty($docs)): ?>
      <h3 style="text-align: center;">Tak ada File Tugas Akhir yang diupload</h3>
    <?php elseif (!empty($docs)): ?>
      <div class="table-responsive">          
          <table class="table">
            <thead>
              <tr>
                <th>Nama Sub</th>
                <th>Pembimbing 1</th>
                <th>Pembimbing 2</th>
                <th>Submission</th>
                <th>Status 1</th>
                <th>Status 2</th>
                <th>File Revisi Pem 1</th>
                <th>File Revisi Pem 2</th>
                <th>Edit Submission</th>
                
              </tr>
            </thead>
            <tbody>
            <?php foreach ($docs as $doc) { ?>
                <tr>
                <td><?php echo $doc['nama_doc']; ?></td>
                <td><?php echo $doc['pembimbing1'] ?></td>
                <td><?php echo $doc['pembimbing2'] ?></td>
                <td><a href="<?php echo base_url('assets/pdfjs/web/uploads/'.$doc['submission']); ?>" class="btn btn-success" target="_blank"> View</a></td>

                    <?php if ($doc['status1'] == 'draft'): ?>
                      <td><span class="label label-default">Draft</span></td>
                    <?php elseif($doc['status1'] == 'revisi' ): ?>
                      <td><span class="label label-warning">Revisi <span class="glyphicon glyphicon-remove"></span></span></td>
                    <?php elseif($doc['status1'] == 'selesai' ): ?>
                      <td><span class="label label-success">Selesai <span class="glyphicon glyphicon-ok"></span></span></td>
                    <?php endif; ?>

                    <?php if ($doc['status2'] == 'draft'): ?>
                      <td><span class="label label-default">Draft</span></td>
                    <?php elseif($doc['status2'] == 'revisi' ): ?>
                      <td><span class="label label-warning">Revisi <span class="glyphicon glyphicon-remove"></span></span></td>
                    <?php elseif($doc['status2'] == 'selesai' ): ?>
                      <td><span class="label label-success">Selesai <span class="glyphicon glyphicon-ok"></span></span></td>
                    <?php endif; ?>

                    <?php if (empty($doc['revisi1'])): ?>
                      <td>File tidak ada</td>
                    <?php elseif (!empty($doc['revisi1'])): ?>
                      <td><a href="<?php echo base_url('assets/pdfjs/web/uploads/'.$doc['revisi1']); ?>" class="btn btn-default">Download</a></td>
                    <?php endif; ?>

                    <?php if (empty($doc['revisi2'])): ?>
                      <td>File tidak ada</td>
                    <?php elseif (!empty($doc['revisi2'])): ?>
                      <td><a href="<?php echo base_url('assets/pdfjs/web/uploads/'.$doc['revisi2']); ?>" class="btn btn-default">Download</a></td>
                    <?php endif; ?>

                <td><button class="btn btn-info edit" data-id="<?php echo $doc['id'] ?>"><i class="fa fa-pencil"></i> Edit</button></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
          </div>
    <?php endif ?>
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
                           <?php echo form_open_multipart('mahasiswa/do_post_doc',array(
                                'method' => 'POST',
                                'class'  => 'form-horizontal'
                            )); ?>

                                <div class="form-group" hidden>
                                    <label for="Pembimbing1" class="col-md-3 control-label">Tipe Document</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="doc_type" value="TA">
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
                                    <label for="Pembimbing1" class="col-md-3 control-label">Pebimbing 1</label>
                                    <div class="col-md-8">
                                        <select class="form-control" id="sel1" name="pembimbing1">
                                           <?php foreach ($options as $dosen) { ?>
                                               <option value="<?php echo $dosen['id'] ?>"><?php echo $dosen['nama_dsn'] ?></option>
                                           <?php } ?>
                                          </select>
                                        <!-- <?php echo form_error('pembimbing1'); ?> -->
                                    </div>
                                </div>
                                    
                                <div class="form-group">
                                    <label for="Pembimbing2" class="col-md-3 control-label">Pembimbing 2</label>
                                    <div class="col-md-8">
                                       <select class="form-control" id="sel1" name="pembimbing2">
                                            <?php foreach ($options as $dosen) { ?>
                                               <option value="<?php echo $dosen['id'] ?>"><?php echo $dosen['nama_dsn'] ?></option>
                                           <?php } ?>
                                          </select>
                                        <!-- <?php echo form_error('pembimbing2'); ?> -->
                                    </div>
                                </div>
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

       <div id="edit-sub" class="modal fade" role="dialog">
            <div class="modal-dialog">
        
              <!--Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Edit Submission</h4>
                </div>
                <div class="modal-body" style="text-align: center;">
                <?php echo form_open_multipart('mahasiswa/edit_submission/',array(
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
    $(document).on('click','.edit',function(){
      var id=$(this).attr("data-id");
      console.log(id);

      $.ajax({
                url : "<?php echo base_url('mahasiswa/update_submission/') ?>" + id,
                type : "GET",
                success : function(data)
                {
                  var res = $.parseJSON(data);
                   
                    console.log(res);
                    $('[name="id"]').val(res.id);
                   
                    $('#edit-sub').modal('show'); // tampilin modal
  
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