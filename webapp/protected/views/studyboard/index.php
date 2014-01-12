<section class="detailMain">
    <div class="wrapper">
        <div class="detailMainGreen">
            <h3 class="mainheader">
                <div class="toolpopup"><img src="/img/dashboard/file_edit2.png" style="margin:-3px 5px;">Click on title to edit</div>
                <input value="<?php echo $studyboard->title ?>" type="text" style="background:url('/img/dashboard/file_edit.png') no-repeat scroll 100% center / 4% 100% rgba(0, 0, 0, 0);" class="project-header"/><img class="loadclass" src="/img/dashboard/loadimage.gif"/>
            </h3>
        </div>
    </div>
</section>
<section class="middle">
    <div class="wrapper">
        <div class="middleMain">

                <?php
            if(isset(Yii::app()->session['msg']) && !empty(Yii::app()->session['msg']))
            {
                ?>

                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong><p class="text-center"><?php echo Yii::app()->session['msg'];
                        unset(Yii::app()->session['msg']);
                        ?><p></strong>
                </div>


            <?php
            }
            ?>

            <div class="dashNewStdy">
                <div class="detailMainContentMainBtn">
                    <a href="/studyboard/addProjectsToStudyBoard"><img src="/img/dashboard/btnAdd.png" alt="Add project to study board" /><span>Add project to study board</span></a>
                </div>
            </div>

            <div class="dashBoxMainCntr">
                <div class="dashBoxMainLft">
                    <?php $ctr = 0; ?>

                    <?php foreach ($projects as $p) { ?>
                        <?php if ($ctr%3 == 0) { ?>
                            <div class="dashBoxContnr">
                        <?php } ?>

                        <?php $ctr++; ?>

                        <div class="dashBox">

                            <div class="dashBoxMain">
                                <div class="dashBoxMainDiv dashBoxMain<?php if(($ctr%6) == 0){echo 6;}else{echo $ctr%6;} ?>">
                                    <h3><?php echo CHtml::link($p->title, array('project/index', 'id' => $p->id)) ?></h3>
                                    <?php /* <h3><a href="index.php?r=project/index&id=<?php echo $p->id ?>"><?php echo $p->title ?></h3> */ ?>

                                </div>
                                <div class="dashBoxMainFtr">
                                    <a href="project/index/<?php echo $p->id ?>/#discussion">
                                        <div class="dashBoxMainFtrBox">
                                            <img src="/img/dashboard/dashIcon1.png" alt="Discussion" />
                                            <!--<div class="dashBoxMainFtrBoxIcon">89</div>-->
                                        </div>
                                    </a>
                                    <a href="project/index/<?php echo $p->id ?>/#tasks">
                                        <div class="dashBoxMainFtrBox">
                                            <img src="/img/dashboard/dashIcon2.png" alt="Tasks" />
                                            <!--<div class="dashBoxMainFtrBoxIcon">36</div>-->
                                        </div>
                                    </a>
                                    <a href="project/index/<?php echo $p->id ?>/#files">
                                        <div class="dashBoxMainFtrBox dashBoxMainFtrBoxLst">
                                            <img src="/img/dashboard/dashIcon3.png" alt="Files" />
                                            <!--<div class="dashBoxMainFtrBoxIcon">65</div>-->
                                        </div>
                                    </a>

                                </div>
                            </div>
                        </div>

                        <?php if ($ctr%3 == 0) { ?>
                            </div>
                        <?php } ?>

                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">New Studyboard</h4>
            </div>
            <form class="form-horizontal" action="/studyboard/create" method="post">
                <div class="modal-body">
                    <fieldset>
                        <input type="hidden" name="studyboardId" value="<?php echo $studyboardId; ?>" />
                        <!-- Text input-->
                        <div class="form-group">
                            <div class="col-md-11">
                                <input id="title" name="title" type="text" placeholder="Enter a title for this Studyboard" class="form-control input-md" required="">
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Create">
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-------------------------Success / Failure Notification ---------------------------------------->

<!------------------------------------------------------------------------------------------------->

<script>
    jQuery(document).ready(function(){
        $('.project-header').attr('readonly','readonly');

        jQuery('.project-header').click(function(){
            jQuery(this).addClass("edit-project-header");
            jQuery(this).removeAttr("readonly");
            jQuery('.toolpopup').addClass('hiddenalert');
        });

        jQuery('.project-header').focus(function(){
            jQuery('.toolpopup').addClass('hiddenalert');

        });

        $('.project-header').blur(function(){
           $('.toolpopup').removeClass('hiddenalert');
           var node="<?php echo $studyboard->id;?>"
           var title=$(this).val();
            $(this).removeClass("edit-project-header");
            $(this).attr('readonly','readonly');
            if(title==""){
                title="Untitled Project";
            }

            $.ajax({
                data:"node="+node+"&title="+title,
                url:'/studyboard/updateTitle',
                type:'POST',
                beforeSend:function(){
                    $('.loadclass').css('display','block');
                },
                success:function(){},
                complete:function(){
                    $('.loadclass').css('display','none');
                },
            });


        });
    });


</script>