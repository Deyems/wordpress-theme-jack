<?php

require "blocks/enqueue.php";
//Hooks
add_action('enqueue_block_editor_assets', 'r_enqueue_editor_block_assets');