<?php

    $user = $vars['user'];

    if ($user) {
?>
    <div class='section_content padded'>
    <div class='input'>
        <label><?php echo elgg_echo('user:name:label'); ?>:</label><br />
        <?php

            echo elgg_view('input/text',array('internalname' => 'name', 'trackDirty' => true, 'value' => $user->name));
            echo elgg_view('input/hidden',array('internalname' => 'guid', 'value' => $user->guid));
        ?>
    </div>

    <div class='input'>
        <label><?php echo elgg_echo('user:password:label'); ?>:</label><br />
        <?php
            echo elgg_view('input/password',array('internalname' => 'password', 'trackDirty' => true));
        ?>
        <div class='help'><?php echo elgg_echo('user:password:help'); ?></div>
    </div>
    <div class='input'>
        <label>
        <?php echo elgg_echo('user:password2:label'); ?>:</label><br /> <?php
            echo elgg_view('input/password',array('internalname' => 'password2', 'trackDirty' => true));
        ?>
    </div>

    <div class='input'>
        <label><?php echo elgg_echo('email:address:label'); ?>:</label><br />
        <?php
            echo elgg_view('input/email',array('internalname' => 'email', 'value' => $user->email));
        ?>
    </div>

    <div class='input'>
        <label><?php echo elgg_echo('user:phone:label'); ?>:</label><br />
        <?php
            echo elgg_view('input/text',array('internalname' => 'phone', 'value' => $user->phone_number));
        ?>
    </div>

    <div class='input'>

        <label><?php echo elgg_echo('user:language:label'); ?>:</label><br />
        <?php
            $value = $CONFIG->language;
            if ($user->language)
                $value = $user->language;

            echo elgg_view("input/pulldown", array('internalname' => 'language', 'value' => $value, 'options_values' => get_installed_translations(true)));

         ?>

    </div>

    <?php if ($user instanceof Organization) { ?>

    <div class='input'>

        <label><?php echo elgg_echo('user:notification:label'); ?>:</label><br />

        <div class='help'><?php echo elgg_echo('user:notification:freq'); ?>:
        <?php
            echo elgg_view("input/pulldown", array('internalname' => 'notify_days', 'value' => $user->notify_days, 'options_values' =>
                get_notification_frequencies()
            ));

         ?></div>

    </div>

    <?php } ?>

    <?php echo elgg_view('input/hidden', array('internalname' => 'from', 'value' => get_input('from'))); ?>

    <?php echo elgg_view('input/submit', array('value' => elgg_echo('savechanges'), 'trackDirty' => true)); ?>

    </div>


<?php } ?>