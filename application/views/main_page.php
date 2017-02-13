<!--  PAPER WRAP -->
  <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <div class="wrap-fluid">
        <div class="container-fluid paper-wrap bevel tlbr">
            <!-- CONTENT -->
            <!--TITLE -->
            <div class="row">
                <div id="paper-top">
                    <div class="col-sm-3">
                        <h2 class="tittle-content-header">
                            <i class="icon-window"></i>
                            <span>Dashboard</span>
                        </h2>

                    </div>

                    <div class="col-sm-7">
                        <div class="devider-vertical visible-lg"></div>
                        <div class="tittle-middle-header">

                            <div class="alert">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <span class="tittle-alert entypo-info-circled"></span>
                                Hello,&nbsp;
                                <strong><?php echo $name; ?>!</strong>&nbsp;&nbsp;Welcome!
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-2">
                        <div class="devider-vertical visible-lg"></div>
                    </div>
                </div>
            </div>
            <!--/ TITLE -->
            <div class="content-wrap">
                <div class="row">
                    <div class="col-sm-6">
                      <!--  START Shift Progress -->
                      <div class="nest" style="padding-bottom:20px">
                          <div class="title-alt">
                              <h6>Shift Progress</h6>
                          </div>
                          <div class="well">
                            <ul class="steps">
                              <li class="step step--incomplete step--active" id="timein">
                                <span class="step__icon entypo-login"></span>
                                <span class="step__label">Login</span>
                                <span class="step__label time_log time_login"><?php _ec(_ar($time_record['time_timein'])); ?></span>
                              </li>
                              <li class="step step--incomplete step--inactive" id="breakout">
                                <span class="step__icon entypo-clock"></span>
                                <span class="step__label">Break</span>
                                <span class="step__label time_log time_break"><?php _ec(_ar($time_record['time_breakout'])); ?></span>
                              </li>
                              <li class="step step--incomplete step--inactive" id="breakin">
                                <span class="step__icon entypo-back-in-time"></span>
                                <span class="step__label">Back</span>
                                <span class="step__label time_log time_back"><?php _ec(_ar($time_record['time_breakin'])); ?></span>
                              </li>
                              <li class="step step--incomplete step--inactive" id="timeout">
                                <span class="step__icon entypo-logout"></span>
                                <span class="step__label">Logout</span>
                                <span class="step__label time_log time_logout"><?php _ec(_ar($time_record['time_timeout'])); ?></span>
                              </li>
                            </ul>
                          </div>
                      </div>
                      <!--  END Shift Progress -->
                      <!--  START IT Ticket Form -->
                      <?php echo form_open('it_ticket', array ('id'=>'it_ticket_form')); ?>
                      <div class="nest">
                          <div class="title-alt">
                              <h6>IT TICKET</h6>
                          </div>
                          <?php
                            if (isset($form_error)) {
                          ?>
                          <div class="well">
                            <div class="alert alert-warning">
                              <button data-dismiss="alert" class="close" type="button">×</button>
                              <?php 
                                foreach ($form_error as $k => $v) {
                                  echo '*'.$v.'<br/>';
                                }
                              ?>
                            </div>
                          </div>
                          <?php }    
                            if (isset($it_ticket_result)) {
                          ?>
                            <div class="well">
                              <div class="alert alert-danger">
                                <button data-dismiss="alert" class="close" type="button">×</button>
                                <span class="entypo-attention"></span>
                                <?php echo $it_ticket_result; ?>
                              </div>
                            </div>
                            <?php } ?>
                          <div class="well">
                            <div class="col-sm-12 input-group">
                              <span class="input-group-addon"><i class="icon-document-edit"></i></span>
                              <input type="text" name="task" class="form-control" placeholder="Task done" required="required">
                            </div>
                          </div>
                          <div class="well">
                            <div class="row">
                              <div class="col-sm-6">
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="icon-warning"></i></span>
                                  <select name="problem_type" class="select2_single form-control" style="width:100%;">
                                    <option value=""></option>
                                    <?php _print_opt($tp); ?>
                                  </select>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="input-group" style="width: 100%;">
                                  <select name="problem_specific" class="select2_group form-control" style="width:100%;">
                                    <option value=""></option>
                                    <?php _print_optgrp($ps); ?>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- END of form row = type of problem -->
                          <div class="well">
                            <div class="row">
                              <div class="col-sm-6">
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="icon-user"></i></span>
                                  <input type="text" name="agent" class="form-control" placeholder="Assisted who?">
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="input-group" style="width: 100%;">
                                  <select name="account" class="select_assisted form-control" style="width:100%;" >
                                    <option value=""></option>
                                    <?php _print_opt($acc); ?>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- END of form = Name of assisted -->
                          <!--  START Time -->
                          <div class="well">
                            <div class="row">
                              <div class="col-sm-6">
                                <div class="input-group">
                                  <span class="input-group-addon"><span class="entypo-clock"></span></span>
                                  <input type="text" name="time_start" id="timepick_start" class="form-control" placeholder="Time started" required="required">
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="input-group">
                                  <span class="input-group-addon"><span class="entypo-clock"></span></span>
                                  <input type="text" name="time_end" id="timepick_end" class="form-control" placeholder="Time finished" required="required">
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- END of Time -->
                          <div class="well">
                            <div class="col-sm-12 input-group">
                              <span class="input-group-addon"><i class="fontawesome-comment-alt"></i></span>
                              <input type="text" name="comment" class="form-control" placeholder="Comments">
                            </div>
                          </div>
                          <div class="well">
                            <div class="col-sm-12 input-group">
                              <button class="btn btn-app">
                                <i class="icon icon-thumbs-up"></i> SUBMIT
                              </button>
                            </div>
                          </div>
                        </div>
                        <?php echo form_close(); ?>
                      <!--  END IT Ticket Form -->
                    </div>
                    <div class="col-sm-6">
                      <div class="nest">
                          <div class="title-alt">
                              <h6>LOGS</h6>
                          </div>
                          <div class="well">
                            <div class="table-responsive">
                            <table class="table table-logs table-hover table-striped table-condensed">
                                <tbody>
                                  <?php foreach ($it_ticket_logs as $key => $value) { ?>
                                    <tr>
                                        <td><span class="log-time"><?php echo $value['time_started'].' - '.$value['time_finished']; ?></span></td>
                                        <td>
                                            <div class="log-content-wrap">
                                                <span class="task-done"><?php echo $value['task']; ?></span><br/>
                                                <span><?php echo $value['agent_assisted'].' -- '.$value['accName']; ?></span>
                                                <h5><small><?php echo $value['ptName'].' | '.$value['psName']; ?></small></h5>
                                            </div>
                                        </td>
                                        <td><i class="pull-right fa fa-edit logs-edit"></i></td>
                                    </tr>
                                  <?php } ?>
                                </tbody>
                            </table>
                          </div>
                      </div>
                    </div>
                </div>
                <!-- /END OF CONTENT -->
            </div>
        </div>
    </div>
    </div>
    <!--  END OF PAPER WRAP -->
    <!--<div id="overlay">
      <div id="screen"></div>
      <div id="dialog-anchor" class="dialog modal">
        <div class="label-dialog"><i class="icon-anchor"></i></div>
        <div class="body-dialog">
          <p>The Anchor dialog is <span>modal</span>. You must click on the check mark to acknowledge and clear it.</p>
        </div>
        <div class="ok-dialog"><i class="icon-ok-sign"></i></div>
      </div>
    </div>-->