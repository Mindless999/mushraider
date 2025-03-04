<header>
    <h1><i class="fa fa-calendar"></i> <?php echo __('Edit event');?> <?php echo __('the');?> <?php echo $this->Former->date($eventDate, 'jour');?></h1>
</header>

<?php echo $this->Form->create('Event', array('url' => '/events/edit/'.$this->data['Event']['id'], 'enctype' => 'multipart/form-data'));?>
    <h3><?php echo __('General informations');?></h3>
    <div class="row">
        <div class="span5">
            <div class="form-group">
                <label><?php echo __('Event date');?></label>
                <div class="input-append">
                    <?php echo $this->Form->input('Event.date', array('type' => 'text', 'value' => $this->Former->date($eventDate, 'jour'), 'label' => false, 'placeholder' => __('dd/mm/yyyy'), 'div' => false, 'class' => 'input-medium datepicker'));?>
                    <span class="add-on"><span class="fa fa-calendar"></span></span>
                </div>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('Event.title', array('type' => 'text', 'label' => __('Event title'), 'maxlength' => 50, 'class' => 'span4'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('Event.game_id', array('type' => 'select', 'required' => true, 'label' => __('Game'), 'options' => $gamesList, 'data-error' => __('An error occur while loading'), 'empty' => '', 'class' => 'span4'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('Event.dungeon_id', array('type' => 'select', 'data-selected' => $this->data['Event']['dungeon_id'], 'required' => true, 'label' => __('Dungeon'), 'empty' => __('Select a game first'), 'class' => 'span4'));?>
            </div>
        </div>
        <div class="span6">
            <div class="form-group">
                <?php echo $this->Form->input('Event.description', array('type' => 'textarea', 'label' => __('Event description'), 'class' => 'span5 wysiwyg', 'data-height' => 150));?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="span5">
            <h3><?php echo __('Roles');?></h3>
            <?php if(!empty($rolesList)):?>
                <?php foreach($rolesList as $roleId => $roleTitle):?>
                    <?php $currentRole = Set::extract('/EventsRole[raids_role_id='.$roleId.']/count', $this->data);?>                    
                    <?php $count = !empty($currentRole)?$currentRole[0]:0;?>
                    <div class="form-group form-roles">
                        <?php echo $this->Form->input('Event.roles.'.$roleId, array('type' => 'text', 'value' => $count, 'label' => __('Number of').' '.$roleTitle, 'class' => 'span1', 'pattern' => '[0-9]{1,3}'));?>
                    </div>
                <?php endforeach;?>
            <?php endif;?>
            <div class="form-group form-roles">
                <?php echo $this->Form->input('Event.character_level', array('type' => 'text', 'required' => true, 'label' => __('Character minimum level'), 'class' => 'span1', 'maxlength' => 5));?>
            </div>
        </div>
        <div class="span6">
            <h3><?php echo __('Event time');?></h3>
            <div class="form-group">
                <?php echo $this->Form->input('Event.time_invitation', array('type' => 'time', 'timeFormat' => 24, 'interval' => 15, 'required' => true, 'label' => __('Invitations start'), 'class' => 'span2'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('Event.time_start', array('type' => 'time', 'timeFormat' => 24, 'interval' => 15, 'required' => true, 'label' => __('Event start'), 'class' => 'span2'));?>
            </div>
            <div class="form-group">
                <label><?php echo __('Registration end date (optional)');?></label>
                <div class="input-append">
                    <?php echo $this->Form->input('Event.time_inscription', array('type' => 'text', 'value' => $this->Former->date($this->data['Event']['time_inscription'], 'jour'), 'label' => false, 'placeholder' => __('dd/mm/yyyy'), 'div' => false, 'class' => 'input-medium datepicker', 'data-date' => $this->Former->date($eventDate, 'jour')));?>
                    <span class="add-on"><span class="fa fa-calendar"></span></span>
                </div>
            </div>
        </div>
    </div>

    <hr />

    <div class="row">
        <div class="span3">
            <div class="form-group">
                <?php echo $this->Form->input('Event.open', array('type' => 'checkbox', 'label' => __('open event')));?>
                <div class="hint"><?php echo __('No validation is required to participate to this event');?></div>
            </div>
        </div>
        <div class="span5 pull-right">
            <div class="form-group">
                <?php echo $this->Form->input('Event.id', array('type' => 'hidden'));?>
                <div class="text-right">
                    <?php echo $this->Form->submit(__('Update event'), array('class' => 'btn btn-warning btn-large'));?>
                </div>

                <?php if(Configure::read('Config.notifications')->enabled):?>
                    <div class="notifyEdition">
                        <?php echo $this->Form->input('Event.notify', array('type' => 'checkbox', 'label' => __('Notify registered users about the changes')));?>
                    </div>
                <?php endif;?>
            </div>
        </div>
    <div class="clearfix"></div>
<?php echo $this->Form->end();?>