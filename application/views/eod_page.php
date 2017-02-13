<!--  PAPER WRAP -->
<?php echo form_open('submit_eod'); ?>
<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
<div class="wrap-fluid">
  <div class="container-fluid paper-wrap bevel tlbr">
    <div class="row">
      <div id="paper-top">
        <div class="col-sm-3">
          <h2 class="tittle-content-header">
            <i class="icon-window"></i>
            <span>END OF DAY</span>
          </h2>
        </div>
        <div class="col-sm-7">
          <div class="devider-vertical visible-lg"></div>
          <div class="tittle-middle-header">
            <div class="alert">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <span class="tittle-alert entypo-info-circled"></span>
              Hello,&nbsp;
              <strong><?php echo $name; ?>!</strong>&nbsp;&nbsp;Please submit your EOD! 
            </div>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="devider-vertical visible-lg"></div>
        </div>
      </div>
    </div>  
    <div class="content-wrap">
      <div class="nest" style="margin-top:10px; padding-top: 10px;">
        <div class="row">
          <div class="col-sm-12">
            <div class="well profile">
              <div class="col-sm-12">
                <div class="col-xs-12 col-sm-4 text-center">
                  <ul class="list-group">
                    <li class="list-group-item text-left">
                      <span class="entypo-alert"></span>&nbsp;&nbsp;Dispute during shift (based on schedule)
                    </li>
                    <li class="list-group-item intolerable text-right">
                      <span class="pull-left">
                        <strong>Late</strong>
                      </span>2 mins.
                      <div class="text-left" style="color: #656565; padding-top:5px;">
                      <span>Reason:</span>
                      <textarea style="max-width: 100%; width: 100%;" required="required"></textarea>
                      </div>
                    </li>
                    <li class="list-group-item tolerable text-right">
                      <span class="pull-left">
                        <strong>Early-in</strong>
                      </span>8 mins.
                    </li>
                    <li class="list-group-item tolerable text-right">
                      <span class="pull-left">
                        <strong>Over-time</strong>
                      </span>13 mins.
                    </li>
                  </ul>
                  <hr>
                </div>
                <div class="col-xs-12 col-sm-8 profile-name">
                  <h2>EOD Report 
                    <span class="pull-right social-profile">
                      <button value="submit" class="eod_btn noselect" title="I'm good to go!">Submit EOD</button>
                    </span>
                  </h2>
                  <hr>
                  <table class="dl-horizontal-profile">
                    <tbody>
                      <tr>
                        <td><strong>Date</strong></td>
                        <td>&nbsp;:&nbsp;&nbsp;</td>
                        <td>
                          <?php 
                            echo _format_time($time_record['time_timein'], 'F d, Y');
                          ?>
                        </td>
                      </tr>
                      <tr>
                        <td><strong>Shift</strong></td>
                        <td>&nbsp;:&nbsp;&nbsp;</td>
                        <td>
                          <?php 
                            echo '2:00 pm - 11:00 pm';
                          ?>
                        </td>
                      </tr>
                      <tr>
                        <td><strong>Time in</strong></td>
                        <td>&nbsp;:&nbsp;&nbsp;</td>
                        <td>
                          <?php 
                            echo _format_time($time_record['time_timein']);
                          ?>
                        </td>
                      </tr>
                      <tr>
                        <td><strong>Time out</strong></td>
                        <td>&nbsp;:&nbsp;&nbsp;</td>
                        <td>
                          <?php 
                            echo _format_time($time_record['time_timeout']);
                          ?>
                        </td>
                      </tr>
                      <tr>
                        <td><strong>Daily Routine</strong></td>
                        <td>&nbsp;:&nbsp;&nbsp;</td>
                        <td>Watch movies, Play Dota or Mobile legend, Listening to music, Sleep, <sub>assist</sub></td>
                      </tr>
                    </tbody>
                  </table>
                  <hr>
                  <h5>
                  <span class="fontawesome-tasks"></span>&nbsp;&nbsp;Tasks done</h5>
                  <div class="table-responsive">
                    <table class="table table-logs table-hover table-striped table-condensed">
                      <tbody>
                        <?php 
                          $it_ticket_logs = _format_task_done($it_ticket_logs);
                          foreach ($it_ticket_logs as $itl_key => $itl_val) {
                            echo '<tr>
                              <th colspan="2">'.$itl_key.'</th>
                            </tr>';

                            foreach ($itl_val as $itlv_key => $itlv_val) {
                              echo '<tr>
                                <td><span class="log-time">'.$itlv_val['time_started'].' - <br/>'.$itlv_val['time_finished'].'</span></td>
                                <td>'.$itlv_val['task'].'</td>
                              </tr>';
                            }
                          } 
                        ?>
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo form_close(); ?>